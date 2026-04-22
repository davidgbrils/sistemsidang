<?php

namespace App\Http\Controllers;

use App\Models\NilaiSidang;
use App\Models\JadwalSidang;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class NilaiSidangController extends Controller
{
    public function index(Request $request): View
    {
        $query = JadwalSidang::with(['mahasiswa', 'penguji1', 'penguji2']);

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->whereHas('mahasiswa', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nim', 'like', "%{$search}%");
            });
        }

        $jadwals = $query->orderBy('tanggal', 'desc')->paginate(15);

        return view('nilai.index', compact('jadwals'));
    }

    public function nilai(JadwalSidang $jadwal): View
    {
        $jadwal->load(['mahasiswa', 'penguji1', 'penguji2', 'pembimbing', 'nilai']);

        $existingNilai = $jadwal->nilai->keyBy('dosen_id');

        return view('nilai.form', compact('jadwal', 'existingNilai'));
    }

    public function store(Request $request, JadwalSidang $jadwal): RedirectResponse
    {
        $validated = $request->validate([
            'nilai.*.nilai_angka' => 'required|numeric|min:0|max:100',
            'nilai.*.nilai_huruf' => 'required|string|max:2',
            'nilai.*.keterangan' => 'nullable|string',
        ]);

        foreach ($validated['nilai'] as $dosenId => $data) {
            NilaiSidang::updateOrCreate(
                [
                    'jadwal_id' => $jadwal->id,
                    'dosen_id' => $dosenId,
                ],
                [
                    'nilai_angka' => $data['nilai_angka'],
                    'nilai_huruf' => $data['nilai_huruf'],
                    'keterangan' => $data['keterangan'] ?? null,
                ]
            );
        }

        $allSubmitted = $jadwal->nilai()->count() >= 3;
        if ($allSubmitted) {
            $jadwal->update(['status' => 'selesai']);
        }

        return redirect()->route('nilai.index')->with('success', 'Nilai berhasil disimpan');
    }

    public function rekap(): View
    {
        $jadwals = JadwalSidang::with(['mahasiswa', 'nilai'])
            ->where('status', 'selesai')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('nilai.rekap', compact('jadwals'));
    }
}