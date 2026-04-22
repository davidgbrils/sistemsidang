<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\JadwalSidang;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportController extends Controller
{
    public function excel(): View
    {
        return view('import.excel');
    }

    public function importExcel(Request $request): RedirectResponse
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls|max:5120',
            'type' => 'required|in:mahasiswa,dosen,jadwal',
        ]);

        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file->getPathname());
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        array_shift($rows);

        $type = $request->type;
        $imported = 0;
        $errors = [];

        DB::beginTransaction();
        try {
            foreach ($rows as $index => $row) {
                if (empty(array_filter($row))) continue;

                try {
                    match ($type) {
                        'mahasiswa' => $this->importMahasiswa($row),
                        'dosen' => $this->importDosen($row),
                        'jadwal' => $this->importJadwal($row),
                    };
                    $imported++;
                } catch (\Exception $e) {
                    $errors[] = "Row " . ($index + 2) . ": " . $e->getMessage();
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Import gagal: ' . $e->getMessage());
        }

        if (empty($errors)) {
            return redirect()->route('mahasiswa.index')
                ->with('success', "Berhasil import {$imported} data {$type}");
        }

        return back()->with('warning', "Berhasil import {$imported} data. Beberapa error: " . implode('; ', $errors));
    }

    private function importMahasiswa(array $row): void
    {
        if (empty($row[0]) || empty($row[1])) {
            throw new \Exception('NIM dan Nama wajib diisi');
        }

        Mahasiswa::updateOrCreate(
            ['nim' => $row[0]],
            [
                'nama' => $row[1],
                'email' => $row[2] ?? $row[0] . '@student.unila.ac.id',
                'prodi' => $row[3] ?? 'Informatika',
                'semester' => $row[4] ?? 1,
                'telepon' => $row[5] ?? null,
                'status' => $row[6] ?? 'aktif',
            ]
        );
    }

    private function importDosen(array $row): void
    {
        if (empty($row[0]) || empty($row[1])) {
            throw new \Exception('NIP dan Nama wajib diisi');
        }

        Dosen::updateOrCreate(
            ['nip' => $row[0]],
            [
                'nama' => $row[1],
                'email' => $row[2] ?? $row[0] . '@unila.ac.id',
                'jabatan' => $row[3] ?? 'dosen',
                'telepon' => $row[4] ?? null,
            ]
        );
    }

    private function importJadwal(array $row): void
    {
        if (empty($row[0]) || empty($row[1]) || empty($row[2])) {
            throw new \Exception('Tanggal, jam mulai, dan ruang wajib diisi');
        }

        $nim = $row[0];
        $mahasiswa = Mahasiswa::where('nim', $nim)->first();
        if (!$mahasiswa) {
            throw new \Exception("Mahasiswa dengan NIM {$nim} tidak ditemukan");
        }

        $jadwal = JadwalSidang::create([
            'mahasiswa_id' => $mahasiswa->id,
            'penguji1_id' => $row[3] ?? 1,
            'penguji2_id' => $row[4] ?? 1,
            'pembimbing_id' => $row[5] ?? 1,
            'tanggal' => $row[1],
            'jam_mulai' => $row[2],
            'jam_selesai' => $row[6] ?? $row[2],
            'ruang' => $row[7] ?? 'RuangSidang',
            'status' => $row[8] ?? 'terjadwal',
            'created_by' => auth()->id(),
        ]);
    }

    public function template(string $type)
    {
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $templates = [
            'mahasiswa' => ['NIM', 'Nama', 'Email', 'Prodi', 'Semester', 'Telepon', 'Status'],
            'dosen' => ['NIP', 'Nama', 'Email', 'Jabatan', 'Telepon'],
            'jadwal' => ['NIM_Mahasiswa', 'Tanggal', 'Jam_Mulai', 'Penguji1_ID', 'Penguji2_ID', 'Pembimbing_ID', 'Jam_Selesai', 'Ruang', 'Status'],
        ];

        if (!isset($templates[$type])) {
            abort(404);
        }

        $sheet->fromArray($templates[$type], null, 'A1');

        foreach (range('A', $sheet->getHighestColumn()) as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $filename = "template_{$type}.xlsx";
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"{$filename}\"");
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }
}