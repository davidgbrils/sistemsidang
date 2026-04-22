<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DosenRequest;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DosenController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        
        $dosen = Dosen::with('user')
            ->when($search, function ($query) use ($search) {
                return $query->where('nip', 'like', "%{$search}%")
                           ->orWhere('nama', 'like', "%{$search}%")
                           ->orWhere('email', 'like', "%{$search}%")
                           ->orWhere('jabatan', 'like', "%{$search}%")
                           ->orWhere('prodi', 'like', "%{$search}%");
            })
            ->paginate(10);
        
        return view('admin.dosen.index', compact('dosen', 'search'));
    }

    public function create()
    {
        return view('admin.dosen.form');
    }

    public function store(DosenRequest $request)
    {
        try {
            DB::beginTransaction();
            
            $dosen = Dosen::create($request->validated());
            
            DB::commit();
            
            return back()->with('success', 'Data dosen berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Data dosen gagal ditambahkan: ' . $e->getMessage());
        }
    }

    public function edit(Dosen $dosen)
    {
        return view('admin.dosen.form', compact('dosen'));
    }

    public function update(DosenRequest $request, Dosen $dosen)
    {
        try {
            DB::beginTransaction();
            
            $dosen->update($request->validated());
            
            DB::commit();
            
            return back()->with('success', 'Data dosen berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Data dosen gagal diperbarui: ' . $e->getMessage());
        }
    }

    public function destroy(Dosen $dosen)
    {
        try {
            DB::beginTransaction();
            
            $dosen->delete();
            
            DB::commit();
            
            return back()->with('success', 'Data dosen berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Data dosen gagal dihapus: ' . $e->getMessage());
        }
    }
}
