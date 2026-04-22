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
            ->paginate(15);

        return view('jadwal.index', compact('jadwals'));
    }

    public function create(): View
    {
        $mahasiswas = Mahasiswa::where('status', '!=', 'lulus')->where('status', '!=', 'tidak_lulus')->orderBy('nama')->get();
        
        // For dosen users, only show themselves as pembimbing option
        if (auth()->user()->role === 'dosen') {
            $dosens = Dosen::where('id', auth()->user()->dosen->id)->where('is_active', true)->get();
        } else {
            $dosens = Dosen::where('is_active', true)->orderBy('nama')->get();
        }

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
            'jam_selesai' => 'required',
            'ruang' => 'required|string|max:50',
        ]);

        // For dosen users, ensure they can only create schedules where they are the pembimbing
        if (auth()->user()->role === 'dosen') {
            if ($validated['pembimbing_id'] != auth()->user()->dosen->id) {
                return back()->with('error', 'Anda hanya dapat membuat jadwal dimana Anda sebagai pembimbing');
            }
        }

        $validated['created_by'] = auth()->id();
        $validated['status'] = 'draft';

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
        // Check if user can edit this jadwal
        if (auth()->user()->role === 'dosen' && $jadwal->pembimbing_id != auth()->user()->dosen->id) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit jadwal ini');
        }

        $mahasiswas = Mahasiswa::orderBy('nama')->get();
        
        // For dosen users, only show themselves as pembimbing option
        if (auth()->user()->role === 'dosen') {
            $dosens = Dosen::where('id', auth()->user()->dosen->id)->where('is_active', true)->get();
        } else {
            $dosens = Dosen::where('is_active', true)->orderBy('nama')->get();
        }

        return view('jadwal.edit', compact('jadwal', 'mahasiswas', 'dosens'));
    }

    public function update(Request $request, JadwalSidang $jadwal): RedirectResponse
    {
        // Check if user can update this jadwal
        if (auth()->user()->role === 'dosen' && $jadwal->pembimbing_id != auth()->user()->dosen->id) {
            return back()->with('error', 'Anda tidak memiliki izin untuk mengupdate jadwal ini');
        }

        $validated = $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'penguji1_id' => 'required|exists:dosens,id',
            'penguji2_id' => 'required|exists:dosens,id',
            'pembimbing_id' => 'required|exists:dosens,id',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'ruang' => 'required|string|max:50',
            'status' => 'required|in:draft,published,selesai,dibatalkan',
        ]);

        // For dosen users, ensure they can only update schedules where they are the pembimbing
        if (auth()->user()->role === 'dosen') {
            if ($validated['pembimbing_id'] != auth()->user()->dosen->id) {
                return back()->with('error', 'Anda hanya dapat mengupdate jadwal dimana Anda sebagai pembimbing');
            }
        }

        $jadwal->update($validated);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui');
    }

    public function destroy(JadwalSidang $jadwal): RedirectResponse
    {
        // Check if user can delete this jadwal
        if (auth()->user()->role === 'dosen' && $jadwal->pembimbing_id != auth()->user()->dosen->id) {
            return back()->with('error', 'Anda tidak memiliki izin untuk menghapus jadwal ini');
        }

        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus');
    }

    public function publish(JadwalSidang $jadwal): RedirectResponse
    {
        // Check if user can publish this jadwal
        if (auth()->user()->role === 'dosen' && $jadwal->pembimbing_id != auth()->user()->dosen->id) {
            return back()->with('error', 'Anda tidak memiliki izin untuk mempublish jadwal ini');
        }

        $jadwal->update(['status' => 'published']);
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dipublish');
    }
}
