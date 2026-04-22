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
            'nilai' => 'required|array',
            'nilai.*.komponen_presentasi' => 'required|numeric|min:0|max:100',
            'nilai.*.komponen_penguasaan' => 'required|numeric|min:0|max:100',
            'nilai.*.komponen_penulisan' => 'required|numeric|min:0|max:100',
            'nilai.*.komponen_sikap' => 'required|numeric|min:0|max:100',
        ]);

        foreach ($validated['nilai'] as $dosenId => $data) {
            $total = ($data['komponen_presentasi'] + $data['komponen_penguasaan'] + $data['komponen_penulisan'] + $data['komponen_sikap']) / 4;
            
            $grade = match (true) {
                $total >= 85 => 'A',
                $total >= 80 => 'AB',
                $total >= 75 => 'B',
                $total >= 70 => 'BC',
                $total >= 60 => 'C',
                $total >= 50 => 'D',
                default => 'E',
            };

            NilaiSidang::updateOrCreate(
                [
                    'jadwal_id' => $jadwal->id,
                    'dosen_id' => $dosenId,
                ],
                [
                    'komponen_presentasi' => $data['komponen_presentasi'],
                    'komponen_penguasaan' => $data['komponen_penguasaan'],
                    'komponen_penulisan' => $data['komponen_penulisan'],
                    'komponen_sikap' => $data['komponen_sikap'],
                    'total_nilai' => round($total, 2),
                    'grade' => $grade,
                    'submitted_at' => now(),
                ]
            );
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