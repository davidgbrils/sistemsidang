<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use PhpOffice\PhpSpreadsheet\IOFactory;

class MahasiswaController extends Controller
{
    public function index(Request $request): View
    {
        $query = Mahasiswa::query();

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nim', 'like', "%{$search}%")
                    ->orWhere('prodi', 'like', "%{$search}%");
            });
        }

        if ($request->has('prodi') && $request->prodi) {
            $query->where('prodi', $request->prodi);
        }

        if ($request->has('_status') && $request->status) {
            $query->where('status', $request->status);
        }

        $mahasiswas = $query->orderBy('nama')->paginate(15);
        $prodis = Mahasiswa::distinct()->pluck('prodi')->filter();

        return view('mahasiswa.index', compact('mahasiswas', 'prodis'));
    }

    public function create(): View
    {
        return view('mahasiswa.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nim' => 'required|string|unique:mahasiswas,nim|max:20',
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:mahasiswas,email',
            'prodi' => 'required|string|max:50',
            'semester' => 'required|integer|min:1|max:14',
            'telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif,lulus',
        ]);

        Mahasiswa::create($validated);

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    public function show(Mahasiswa $mahasiswa): View
    {
        $mahasiswa->load(['jadwalSidang' => function ($q) {
            $q->orderBy('tanggal', 'desc');
        }]);

        return view('mahasiswa.show', compact('mahasiswa'));
    }

    public function edit(Mahasiswa $mahasiswa): View
    {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa): RedirectResponse
    {
        $validated = $request->validate([
            'nim' => ['required', 'string', 'max:20', Rule::unique('mahasiswas')->ignore($mahasiswa->id)],
            'nama' => 'required|string|max:100',
            'email' => ['required', 'email', Rule::unique('mahasiswas')->ignore($mahasiswa->id)],
            'prodi' => 'required|string|max:50',
            'semester' => 'required|integer|min:1|max:14',
            'telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif,lulus',
        ]);

        $mahasiswa->update($validated);

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui');
    }

    public function destroy(Mahasiswa $mahasiswa): RedirectResponse
    {
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus');
    }

    public function export()
    {
        $mahasiswas = Mahasiswa::orderBy('nama')->get();
        
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        $headers = ['No', 'NIM', 'Nama', 'Email', 'Prodi', 'Semester', 'Telepon', 'Status'];
        $sheet->fromArray($headers, null, 'A1');
        
        $no = 1;
        $row = 2;
        foreach ($mahasiswas as $m) {
            $sheet->fromArray([
                $no++,
                $m->nim,
                $m->nama,
                $m->email,
                $m->prodi,
                $m->semester,
                $m->telepon,
                $m->status
            ], null, "A{$row}");
            $row++;
        }
        
        foreach (range('A', 'H') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        
        $filename = 'data_mahasiswa_' . date('Y-m-d') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"{$filename}\"");
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }
}