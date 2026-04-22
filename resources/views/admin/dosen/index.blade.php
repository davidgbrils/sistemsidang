@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-white">Data Dosen</h1>
        <div class="flex gap-4">
            <form method="GET" class="flex gap-2">
                <input type="text" 
                       name="search" 
                       value="{{ $search ?? '' }}"
                       placeholder="Cari dosen..." 
                       class="px-4 py-2 bg-slate-800 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Cari
                </button>
            </form>
            <a href="{{ route('dosen.create') }}" 
               class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                Tambah Dosen
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
        {{ session('error') }}
    </div>
    @endif

    <div class="bg-slate-800 rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-slate-600">
            <thead class="bg-slate-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-300 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-300 uppercase tracking-wider">NIP</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-300 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-300 uppercase tracking-wider">Jabatan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-300 uppercase tracking-wider">Prodi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-300 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-300 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-slate-800 divide-y divide-slate-600">
                @forelse ($dosen as $index => $item)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-300">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-300">{{ $item->nip }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-300">{{ $item->nama }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-300">{{ $item->jabatan }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-300">{{ $item->prodi }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $item->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('dosen.edit', $item) }}" 
                           class="text-amber-400 hover:text-amber-300 mr-3">
                            Edit
                        </a>
                        <form x-data="{ showDeleteModal: false }" 
                              @submit.prevent="showDeleteModal = true" 
                              method="POST"
                              action="{{ route('dosen.destroy', $item) }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" 
                                    @click="showDeleteModal = true"
                                    class="text-red-400 hover:text-red-300">
                                Hapus
                            </button>
                            
                            <div x-show="showDeleteModal" 
                                 x-cloak
                                 class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                                <div class="bg-slate-800 p-6 rounded-lg max-w-md w-full mx-4">
                                    <h3 class="text-lg font-medium text-white mb-4">Konfirmasi Hapus</h3>
                                    <p class="text-slate-300 mb-6">Apakah Anda yakin ingin menghapus data dosen ini?</p>
                                    <div class="flex justify-end gap-3">
                                        <button type="button" 
                                                @click="showDeleteModal = false"
                                                class="px-4 py-2 bg-slate-600 text-white rounded-lg hover:bg-slate-700">
                                            Batal
                                        </button>
                                        <button type="submit" 
                                                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                                            Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-slate-400">
                        Tidak ada data dosen
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $dosen->links() }}
    </div>
</div>
@endsection
