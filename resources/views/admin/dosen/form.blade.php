@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl font-bold text-white mb-6">
        {{ $dosen->exists ? 'Edit Dosen' : 'Tambah Dosen' }}
    </h1>

    <form method="POST" action="{{ $dosen->exists ? route('dosen.update', $dosen) : route('dosen.store') }}">
        @csrf
        @if($dosen->exists)
        @method('PUT')
        @endif

        <div class="bg-slate-800 rounded-lg p-6 space-y-6">
            <div>
                <label for="nip" class="block text-sm font-medium text-slate-300 mb-2">
                    NIP <span class="text-red-400">*</span>
                </label>
                <input type="text" 
                       id="nip" 
                       name="nip" 
                       value="{{ old('nip', $dosen->nip ?? '') }}"
                       class="w-full px-4 py-2 bg-slate-800 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('nip')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="nama" class="block text-sm font-medium text-slate-300 mb-2">
                    Nama <span class="text-red-400">*</span>
                </label>
                <input type="text" 
                       id="nama" 
                       name="nama" 
                       value="{{ old('nama', $dosen->nama ?? '') }}"
                       class="w-full px-4 py-2 bg-slate-800 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('nama')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-slate-300 mb-2">
                    Email <span class="text-red-400">*</span>
                </label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="{{ old('email', $dosen->email ?? '') }}"
                       class="w-full px-4 py-2 bg-slate-800 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('email')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="jabatan" class="block text-sm font-medium text-slate-300 mb-2">
                    Jabatan <span class="text-red-400">*</span>
                </label>
                <input type="text" 
                       id="jabatan" 
                       name="jabatan" 
                       value="{{ old('jabatan', $dosen->jabatan ?? '') }}"
                       class="w-full px-4 py-2 bg-slate-800 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('jabatan')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="prodi" class="block text-sm font-medium text-slate-300 mb-2">
                    Prodi <span class="text-red-400">*</span>
                </label>
                <select id="prodi" 
                        name="prodi" 
                        class="w-full px-4 py-2 bg-slate-800 border border-slate-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Pilih Prodi</option>
                    <option value="Informatika" {{ old('prodi', $dosen->prodi ?? '') == 'Informatika' ? 'selected' : '' }}>
                        Informatika
                    </option>
                    <option value="Sistem Informasi" {{ old('prodi', $dosen->prodi ?? '') == 'Sistem Informasi' ? 'selected' : '' }}>
                        Sistem Informasi
                    </option>
                    <option value="Teknik Elektro" {{ old('prodi', $dosen->prodi ?? '') == 'Teknik Elektro' ? 'selected' : '' }}>
                        Teknik Elektro
                    </option>
                </select>
                @error('prodi')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="flex items-center">
                    <input type="checkbox" 
                           name="is_active" 
                           value="1" 
                           {{ old('is_active', $dosen->is_active ?? 1) ? 'checked' : '' }}
                           class="h-4 w-4 bg-slate-800 border border-slate-600 rounded text-blue-600 focus:ring-blue-500">
                    <span class="ml-2 text-sm text-slate-300">Aktif</span>
                </label>
            </div>

            <div class="flex gap-4 pt-4">
                <button type="submit" 
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    {{ $dosen->exists ? 'Update' : 'Simpan' }}
                </button>
                <a href="{{ route('dosen.index') }}" 
                   class="px-6 py-2 bg-slate-600 text-white rounded-lg hover:bg-slate-700 transition-colors">
                    Batal
                </a>
            </div>
        </div>
    </form>
</div>
@endsection
