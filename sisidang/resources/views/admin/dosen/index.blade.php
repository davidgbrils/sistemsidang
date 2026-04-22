@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Manajemen Data Dosen</h2>
            <p class="text-slate-500 dark:text-gray-400 mt-1 text-sm">Kelola informasi dosen penguji dan pembimbing.</p>
        </div>
        
        <div class="flex items-center space-x-3">
            <form action="{{ route('dosen.index') }}" method="GET" class="relative group">
                <input type="text" name="search" value="{{ request('search') }}" 
                    class="pl-10 pr-4 py-2 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 transition-all w-64 text-slate-900 dark:text-white"
                    placeholder="Cari NIP atau Nama...">
                <div class="absolute left-3 top-2.5 text-slate-400 group-hover:text-blue-500 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
            </form>

            <a href="{{ route('dosen.create') }}" class="px-4 py-2 bg-blue-600 dark:bg-[#2188FF] hover:bg-blue-700 dark:hover:bg-blue-600 text-sm font-medium rounded-xl text-white transition-colors shadow-lg shadow-blue-500/20 flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>Tambah Dosen</span>
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-100 dark:border-emerald-500/20 text-emerald-600 dark:text-emerald-400 px-4 py-3 rounded-xl text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50 dark:bg-slate-950/50 border-b border-slate-200 dark:border-slate-800">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-gray-400 uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-gray-400 uppercase tracking-wider">NIP</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-gray-400 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-gray-400 uppercase tracking-wider">Jabatan</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-gray-400 uppercase tracking-wider">Prodi</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-medium text-slate-500 dark:text-gray-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800/50">
                    @forelse($dosen as $index => $item)
                    <tr class="hover:bg-slate-50 dark:hover:bg-gray-800/20 transition-colors">
                        <td class="px-6 py-4 text-sm text-slate-500 dark:text-gray-400">{{ $dosen->firstItem() + $index }}</td>
                        <td class="px-6 py-4 text-sm font-mono text-slate-900 dark:text-white">{{ $item->nip }}</td>
                        <td class="px-6 py-4">
                            <p class="text-sm font-medium text-slate-900 dark:text-white">{{ $item->nama }}</p>
                            <p class="text-xs text-slate-500 dark:text-gray-500">{{ $item->email }}</p>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600 dark:text-gray-300">{{ $item->jabatan }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600 dark:text-gray-300">{{ $item->prodi }}</td>
                        <td class="px-6 py-4">
                            @if($item->is_active)
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-100 dark:border-emerald-500/20">Aktif</span>
                            @else
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-400 border border-red-100 dark:border-red-500/20">Nonaktif</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right whitespace-nowrap">
                            <div class="flex justify-end space-x-2" x-data="{}">
                                <a href="{{ route('dosen.edit', $item) }}" class="p-2 text-amber-500 hover:bg-amber-50 dark:hover:bg-amber-500/10 rounded-lg transition-colors" title="Edit Data">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>

                                <form action="{{ route('dosen.destroy', $item) }}" method="POST" class="inline" id="delete-form-{{ $item->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" @click="$dispatch('open-modal', 'confirm-delete-{{ $item->id }}')" 
                                        class="p-2 text-red-500 hover:bg-red-50 dark:hover:bg-red-500/10 rounded-lg transition-colors" title="Hapus Data">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>

                                <x-modal name="confirm-delete-{{ $item->id }}" focusable>
                                    <div class="p-6">
                                        <h2 class="text-lg font-medium text-slate-900 dark:text-white">
                                            Konfirmasi Hapus
                                        </h2>
                                        <p class="mt-1 text-sm text-slate-600 dark:text-gray-400">
                                            Apakah Anda yakin ingin menghapus data dosen <strong>{{ $item->nama }}</strong>? Tindakan ini dapat dibatalkan melalui fitur restore jika diperlukan.
                                        </p>
                                        <div class="mt-6 flex justify-end">
                                            <x-secondary-button x-on:click="$dispatch('close')">
                                                Batal
                                            </x-secondary-button>
                                            <form action="{{ route('dosen.destroy', $item) }}" method="POST" class="ms-3">
                                                @csrf
                                                @method('DELETE')
                                                <x-danger-button>
                                                    Hapus Sekarang
                                                </x-danger-button>
                                            </form>
                                        </div>
                                    </div>
                                </x-modal>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-slate-500 dark:text-gray-500">
                            Tidak ada data dosen ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/50">
            {{ $dosen->links() }}
        </div>
    </div>
</div>
@endsection
