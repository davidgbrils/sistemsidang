@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Data Mahasiswa</h2>
            <p class="text-slate-500 dark:text-gray-400 mt-1 text-sm">Kelola data mahasiswa.</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('mahasiswa.export') }}" class="px-4 py-2 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 border border-slate-200 dark:border-slate-700 text-sm font-medium rounded-xl text-slate-600 dark:text-gray-300 transition-colors flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                <span>Export</span>
            </a>
            <a href="{{ route('mahasiswa.create') }}" class="px-4 py-2 bg-blue-600 dark:bg-[#2188FF] hover:bg-blue-700 dark:hover:bg-blue-600 text-sm font-medium rounded-xl text-white transition-colors shadow-lg shadow-blue-500/20 flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>Tambah</span>
            </a>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-xl p-6">
        <form method="GET" class="flex flex-wrap gap-4 mb-4">
            <x-text-input type="text" name="search" value="{{ request('search') }}" class="px-4 py-2 rounded-xl" placeholder="Cari NIM/Nama..." />
            <x-select-input name="prodi" class="px-4 py-2 rounded-xl">
                <option value="">Semua Prodi</option>
                @foreach($prodis as $prodi)
                <option value="{{ $prodi }}" {{ request('prodi') == $prodi ? 'selected' : '' }}>{{ $prodi }}</option>
                @endforeach
            </x-select-input>
            <x-select-input name="status" class="px-4 py-2 rounded-xl">
                <option value="">Semua Status</option>
                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                <option value="lulus" {{ request('status') == 'lulus' ? 'selected' : '' }}>Lulus</option>
            </x-select-input>
            <button type="submit" class="px-6 py-2 bg-blue-600 dark:bg-[#2188FF] hover:bg-blue-700 dark:hover:bg-blue-600 text-sm font-medium rounded-xl text-white transition-colors">Cari</button>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50 dark:bg-slate-950/50 border-b border-slate-200 dark:border-slate-800">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-gray-400 uppercase tracking-wider">NIM</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-gray-400 uppercase tracking-wider">Nama</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-gray-400 uppercase tracking-wider">Email</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-gray-400 uppercase tracking-wider">Prodi</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-gray-400 uppercase tracking-wider">Semester</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-4 py-3 text-right text-xs font-medium text-slate-500 dark:text-gray-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800/50">
                    @forelse($mahasiswas as $m)
                    <tr class="hover:bg-slate-50 dark:hover:bg-gray-800/20 transition-colors">
                        <td class="px-4 py-3 text-slate-900 dark:text-white font-mono">{{ $m->nim }}</td>
                        <td class="px-4 py-3 text-slate-900 dark:text-white font-medium">{{ $m->nama }}</td>
                        <td class="px-4 py-3 text-slate-500 dark:text-gray-400">{{ $m->email }}</td>
                        <td class="px-4 py-3 text-slate-600 dark:text-gray-300">{{ $m->prodi }}</td>
                        <td class="px-4 py-3 text-slate-600 dark:text-gray-300">{{ $m->semester }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 rounded text-xs font-medium {{ $m->status === 'aktif' ? 'bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-100 dark:border-emerald-500/20' : 'bg-slate-50 dark:bg-slate-500/10 text-slate-600 dark:text-slate-400 border border-slate-100 dark:border-slate-500/20' }}">
                                {{ ucfirst($m->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <a href="{{ route('mahasiswa.show', $m) }}" class="text-blue-600 dark:text-[#2188FF] hover:text-blue-700 dark:hover:text-blue-400 font-medium transition-colors">Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 py-8 text-center text-slate-500 dark:text-gray-500">Tidak ada data.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($mahasiswas->hasPages())
        <div class="mt-4 px-4 py-3 border-t border-slate-200 dark:border-slate-800">
            {{ $mahasiswas->links() }}
        </div>
        @endif
    </div>
</div>
@endsection