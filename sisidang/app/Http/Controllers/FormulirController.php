<?php

namespace App\Http\Controllers;

use App\Models\FormulirSidang;
use App\Models\JadwalSidang;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class FormulirController extends Controller
{
    public function index(Request $request): View
    {
        $query = JadwalSidang::with(['mahasiswa']);
        
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $jadwals = $query->orderBy('tanggal', 'desc')->paginate(15);

        return view('formulir.index', compact('jadwals'));
    }

    public function show(JadwalSidang $jadwal): View
    {
        $jadwal->load(['mahasiswa', 'penguji1', 'penguji2', 'pembimbing', 'formulir' => function ($q) {
            $q->orderBy('tipe');
        }]);

        return view('formulir.show', compact('jadwal'));
    }

    public function create(JadwalSidang $jadwal, string $tipe): View
    {
        $jadwal->load(['mahasiswa', 'penguji1', 'penguji2']);
        
        $existing = $jadwal->formulir()->where('tipe', $tipe)->first();

        return view('formulir.create', compact('jadwal', 'tipe', 'existing'));
    }

    public function store(Request $request, JadwalSidang $jadwal, string $tipe): RedirectResponse
    {
        $validTipes = ['absensi', 'rekap', 'revisi', 'nilai_akhir'];
        if (!in_array($tipe, $validTipes)) {
            return back()->with('error', 'Tipe formulir tidak valid');
        }

        $request->validate([
            'data' => 'required|array',
        ]);

        $data = $request->input('data');
        
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('formulir/' . $jadwal->id, 'public');
        }

        FormulirSidang::updateOrCreate(
            [
                'jadwal_id' => $jadwal->id,
                'dosen_id' => auth()->id(),
                'tipe' => $tipe,
            ],
            [
                'data' => $data,
                'file_path' => $filePath,
                'submitted_at' => now(),
            ]
        );

        return redirect()->route('formulir.index')->with('success', 'Formulir berhasil disimpan');
    }

    public function download(JadwalSidang $jadwal, string $tipe)
    {
        $formulir = $jadwal->formulir()->where('tipe', $tipe)->first();
        
        if (!$formulir || !$formulir->file_path) {
            return back()->with('error', 'File tidak ditemukan');
        }

        return response()->download(storage_path('app/public/' . $formulir->file_path));
    }

    public function rekap(JadwalSidang $jadwal): View
    {
        $jadwal->load([
            'mahasiswa',
            'penguji1', 
            'penguji2',
            'pembimbing',
            'formulir' => function ($q) {
                $q->orderBy('tipe');
            }
        ]);

        return view('formulir.rekap', compact('jadwal'));
    }
}