@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-white">Data Mahasiswa</h2>
            <p class="text-gray-400 mt-1 text-sm">Kelola data mahasiswa.</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('mahasiswa.export') }}" class="px-4 py-2 bg-[#131623] hover:bg-gray-800 border border-gray-700 text-sm font-medium rounded-xl text-gray-300 transition-colors flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                <span>Export</span>
            </a>
            <a href="{{ route('mahasiswa.create') }}" class="px-4 py-2 bg-[#2188FF] hover:bg-blue-600 text-sm font-medium rounded-xl text-white transition-colors shadow-lg shadow-blue-500/20 flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>Tambah</span>
            </a>
        </div>
    </div>

    <div class="bg-[#131623] border border-gray-800 rounded-2xl shadow-xl p-6">
        <form method="GET" class="flex flex-wrap gap-4 mb-4">
            <input type="text" name="search" value="{{ request('search') }}" class="bg-[#0D1117] border border-gray-700 rounded-xl px-4 py-2 text-white focus:outline-none focus:border-[#2188FF]" placeholder="Cari NIM/Nama...">
            <select name="prodi" class="bg-[#0D1117] border border-gray-700 rounded-xl px-4 py-2 text-white focus:outline-none focus:border-[#2188FF]">
                <option value="">Semua Prodi</option>
                @foreach($prodis as $prodi)
                <option value="{{ $prodi }}" {{ request('prodi') == $prodi ? 'selected' : '' }}>{{ $prodi }}</option>
                @endforeach
            </select>
            <select name="status" class="bg-[#0D1117] border border-gray-700 rounded-xl px-4 py-2 text-white focus:outline-none focus:border-[#2188FF]">
                <option value="">Semua Status</option>
                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                <option value="lulus" {{ request('status') == 'lulus' ? 'selected' : '' }}>Lulus</option>
            </select>
            <button type="submit" class="px-4 py-2 bg-[#2188FF] text-white rounded-xl">Cari</button>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-[#0D1117]/50 border-b border-gray-800">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">NIM</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">Nama</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">Email</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">Prodi</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">Semester</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">Status</th>
                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-400 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800/50">
                    @forelse($mahasiswas as $m)
                    <tr class="hover:bg-gray-800/20">
                        <td class="px-4 py-3 text-white font-mono">{{ $m->nim }}</td>
                        <td class="px-4 py-3 text-white">{{ $m->nama }}</td>
                        <td class="px-4 py-3 text-gray-400">{{ $m->email }}</td>
                        <td class="px-4 py-3 text-gray-300">{{ $m->prodi }}</td>
                        <td class="px-4 py-3 text-gray-300">{{ $m->semester }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 rounded text-xs font-medium {{ $m->status === 'aktif' ? 'bg-emerald-500/10 text-emerald-400' : 'bg-gray-500/10 text-gray-400' }}">
                                {{ ucfirst($m->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <a href="{{ route('mahasiswa.show', $m) }}" class="text-gray-400 hover:text-white">Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 py-8 text-center text-gray-500">Tidak ada data.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($mahasiswas->hasPages())
        <div class="mt-4">{{ $mahasiswas->links() }}</div>
        @endif
    </div>
</div>
@endsection