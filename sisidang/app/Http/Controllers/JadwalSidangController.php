<?php

namespace App\Http\Controllers;

use App\Models\JadwalSidang;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class JadwalSidangController extends Controller
{
    public function index(): View
    {
        $jadwals = JadwalSidang::with(['mahasiswa', 'penguji1', 'penguji2', 'pembimbing'])
            ->orderBy('tanggal', 'desc')
            ->orderBy('jam_mulai', 'desc')
            ->get();

        return view('jadwal.index', compact('jadwals'));
    }

    public function create(): View
    {
        $mahasiswas = Mahasiswa::orderBy('nama')->get();
        $dosens = Dosen::orderBy('nama')->get();

        return view('jadwal.create', compact('mahasiswas', 'dosens'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'penguji1_id' => 'required|exists:dosens,id',
            'penguji2_id' => 'required|exists:dosens,id',
            'pembimbing_id' => 'required|exists:dosens,id',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'ruang' => 'required|string|max:50',
        ]);

        $validated['created_by'] = auth()->id();
        $validated['status'] = 'terjadwal';

        JadwalSidang::create($validated);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal sidang berhasil dibuat');
    }

    public function show(JadwalSidang $jadwal): View
    {
        $jadwal->load(['mahasiswa', 'penguji1', 'penguji2', 'pembimbing', 'nilai', 'formulir']);

        return view('jadwal.show', compact('jadwal'));
    }

    public function edit(JadwalSidang $jadwal): View
    {
        $mahasiswas = Mahasiswa::orderBy('nama')->get();
        $dosens = Dosen::orderBy('nama')->get();

        return view('jadwal.edit', compact('jadwal', 'mahasiswas', 'dosens'));
    }

    public function update(Request $request, JadwalSidang $jadwal): RedirectResponse
    {
        $validated = $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'penguji1_id' => 'required|exists:dosens,id',
            'penguji2_id' => 'required|exists:dosens,id',
            'pembimbing_id' => 'required|exists:dosens,id',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'ruang' => 'required|string|max:50',
            'status' => 'required|in:terjadwal,selesai,batal',
        ]);

        $jadwal->update($validated);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui');
    }

    public function destroy(JadwalSidang $jadwal): RedirectResponse
    {
        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus');
    }
}