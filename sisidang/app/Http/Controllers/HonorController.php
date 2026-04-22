<?php

namespace App\Http\Controllers;

use App\Models\HonorRekap;
use App\Models\JadwalSidang;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class HonorController extends Controller
{
    public function rekap(Request $request): View
    {
        $query = JadwalSidang::with(['mahasiswa', 'penguji1', 'penguji2', 'pembimbing'])
            ->where('status', 'selesai');

        if ($request->has('bulan') && $request->bulan) {
            $query->whereRaw("DATE_FORMAT(tanggal, '%Y-%m') = ?", [$request->bulan]);
        }

        if ($request->has('dosen_id') && $request->dosen_id) {
            $query->where(function ($q) use ($request) {
                $q->where('penguji1_id', $request->dosen_id)
                    ->orWhere('penguji2_id', $request->dosen_id)
                    ->orWhere('pembimbing_id', $request->dosen_id);
            });
        }

        $jadwals = $query->orderBy('tanggal', 'desc')->get();

        $honorPerDosen = $jadwals->groupBy(function ($j) {
            return $j->penguji1_id;
        })->map(function ($items, $dosenId) {
            $dosen = Dosen::find($dosenId);
            return [
                'dosen' => $dosen,
                'total_sidang' => $items->count(),
                'total_honor' => $items->count() * 250000,
            ];
        });

        return view('honor.rekap', compact('jadwals', 'honorPerDosen'));
    }

    public function export(Request $request): RedirectResponse
    {
        $query = JadwalSidang::with(['mahasiswa', 'penguji1', 'penguji2', 'pembimbing'])
            ->where('status', 'selesai');

        if ($request->has('bulan') && $request->bulan) {
            $query->whereRaw("DATE_FORMAT(tanggal, '%Y-%m') = ?", [$request->bulan]);
        }

        $jadwals = $query->orderBy('tanggal', 'desc')->get();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        $headers = ['No', 'Tanggal', 'NIM', 'Nama Mahasiswa', 'Penguji 1', 'Penguji 2', 'Pembimbing', 'Ruang', 'Honor'];
        $sheet->fromArray($headers, null, 'A1');
        
        $no = 1;
        $row = 2;
        $honorPerSidang = 250000;
        
        foreach ($jadwals as $j) {
            $sheet->fromArray([
                $no++,
                $j->tanggal,
                $j->mahasiswa->nim ?? '-',
                $j->mahasiswa->nama ?? '-',
                $j->penguji1->nama ?? '-',
                $j->penguji2->nama ?? '-',
                $j->pembimbing->nama ?? '-',
                $j->ruang,
                $honorPerSidang
            ], null, "A{$row}");
            $row++;
        }
        
        $sheet->setCellValue("A{$row}", 'Total');
        $sheet->setCellValue("H{$row}", $jadwals->count());
        $sheet->setCellValue("I{$row}", $jadwals->count() * $honorPerSidang);
        
        foreach (range('A', 'I') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        
        $filename = 'rekap_honor_' . ($request->bulan ?? date('Y-m')) . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"{$filename}\"");
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }

    public function create(): View
    {
        $dosens = Dosen::orderBy('nama')->get();
        $bulan = date('Y-m');
        
        return view('honor.create', compact('dosens', 'bulan'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'dosen_id' => 'required|exists:dosens,id',
            'bulan' => 'required|date_format:Y-m',
            'jumlah_sidang' => 'required|integer|min:1',
            'total_honor' => 'required|numeric|min:0',
            'status_pembayaran' => 'required|in:belum,lunas',
        ]);

        HonorRekap::create($request->all());

        return redirect()->route('honor.rekap')->with('success', 'Rekap honor berhasil disimpan');
    }
}