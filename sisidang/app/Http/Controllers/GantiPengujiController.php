<?php

namespace App\Http\Controllers;

use App\Models\GantiPenguji;
use App\Models\JadwalSidang;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class GantiPengujiController extends Controller
{
    public function index(Request $request): View
    {
        $query = GantiPenguji::with(['jadwal.mahasiswa', 'pengujiLama', 'pengujiBaru', 'requester']);

        // Non-admin roles (except kaprodi and staff_ften) should only see their own requests
        if (!auth()->user()->hasAnyRole(['admin', 'kaprodi', 'staff_ften'])) {
            $query->where('requested_by', auth()->id());
        }

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $gantis = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('penguji.index', compact('gantis'));
    }

    public function ganti(JadwalSidang $jadwal): View
    {
        $jadwal->load(['mahasiswa', 'penguji1', 'penguji2', 'pembimbing']);
        $dosens = Dosen::where('is_active', true)->orderBy('nama')->get();

        return view('penguji.form', compact('jadwal', 'dosens'));
    }

    public function store(Request $request, JadwalSidang $jadwal): RedirectResponse
    {
        $request->validate([
            'penguji_lama' => 'required|in:penguji1,penguji2',
            'penguji_baru_id' => 'required|exists:dosens,id',
            'alasan' => 'required|string|min:10',
        ]);

        $pengujiId = $request->penguji_lama === 'penguji1' ? $jadwal->penguji1_id : $jadwal->penguji2_id;

        GantiPenguji::create([
            'jadwal_id' => $jadwal->id,
            'penguji_lama_id' => $pengujiId,
            'penguji_baru_id' => $request->penguji_baru_id,
            'alasan' => $request->alasan,
            'status' => 'pending',
            'requested_by' => auth()->id(),
            'requested_at' => now(),
        ]);

        return redirect()->route('penguji.ganti')->with('success', 'Pengajuan penggantian berhasil dikirim');
    }

    public function approve(GantiPenguji $ganti): RedirectResponse
    {
        $jadwal = $ganti->jadwal;

        if ($jadwal->penguji1_id == $ganti->penguji_lama_id) {
            $jadwal->update(['penguji1_id' => $ganti->penguji_baru_id]);
        } elseif ($jadwal->penguji2_id == $ganti->penguji_lama_id) {
            $jadwal->update(['penguji2_id' => $ganti->penguji_baru_id]);
        }

        $ganti->update([
            'status' => 'approved',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
        ]);

        return redirect()->route('penguji.ganti')->with('success', 'Penggantian penguji disetujui');
    }

    public function reject(Request $request, GantiPenguji $ganti): RedirectResponse
    {
        $request->validate([
            'alasan_penolakan' => 'required|string|min:5',
        ]);

        $ganti->update([
            'status' => 'declined',
            'approved_by' => auth()->id(),
            'alasan_penolakan' => $request->alasan_penolakan,
            'approved_at' => now(),
        ]);

        return redirect()->route('penguji.ganti')->with('success', 'Penggantian penguji ditolak');
    }

    public function history(): View
    {
        $gantis = GantiPenguji::with(['jadwal.mahasiswa', 'pengujiLama', 'pengujiBaru'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('penguji.history', compact('gantis'));
    }
}