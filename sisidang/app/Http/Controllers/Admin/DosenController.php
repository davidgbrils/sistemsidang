<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DosenRequest;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class DosenController extends Controller
{
    /**
     * Display a listing of the lecturers.
     */
    public function index(Request $request): View
    {
        $query = Dosen::with('user');

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nip', 'like', "%{$search}%")
                    ->orWhere('prodi', 'like', "%{$search}%");
            });
        }

        $dosen = $query->orderBy('nama')->paginate(10)->withQueryString();

        return view('admin.dosen.index', compact('dosen'));
    }

    /**
     * Show the form for creating a new lecturer.
     */
    public function create(): View
    {
        return view('admin.dosen.form', [
            'dosen' => new Dosen(),
            'title' => 'Tambah Dosen',
            'route' => route('dosen.store'),
            'method' => 'POST'
        ]);
    }

    /**
     * Store a newly created lecturer in storage.
     */
    public function store(DosenRequest $request): RedirectResponse
    {
        try {
            Dosen::create($request->validated());
            return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Error creating dosen: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Gagal menambahkan data: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified lecturer.
     */
    public function edit(Dosen $dosen): View
    {
        return view('admin.dosen.form', [
            'dosen' => $dosen,
            'title' => 'Edit Dosen',
            'route' => route('dosen.update', $dosen),
            'method' => 'PUT'
        ]);
    }

    /**
     * Update the specified lecturer in storage.
     */
    public function update(DosenRequest $request, Dosen $dosen): RedirectResponse
    {
        try {
            $dosen->update($request->validated());
            return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Error updating dosen: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified lecturer from storage.
     */
    public function destroy(Dosen $dosen): RedirectResponse
    {
        try {
            $dosen->delete();
            return back()->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Error deleting dosen: ' . $e->getMessage());
            return back()->with('error', 'Gagal menghapus data.');
        }
    }
}
