@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $title }}</h2>
            <p class="text-slate-500 dark:text-gray-400 mt-1 text-sm">Lengkapi informasi detail dosen di bawah ini.</p>
        </div>
        <a href="{{ route('dosen.index') }}" class="text-slate-500 hover:text-slate-700 dark:text-gray-400 dark:hover:text-white transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </a>
    </div>

    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-xl p-8">
        <form action="{{ $route }}" method="POST" class="space-y-6">
            @csrf
            @if($method === 'PUT')
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- NIP -->
                <div>
                    <x-input-label for="nip" :value="__('NIP')" class="mb-2 dark:text-gray-300" />
                    <x-text-input id="nip" name="nip" type="text" class="w-full px-4 py-3 rounded-xl dark:bg-slate-800 dark:border-slate-700" 
                        :value="old('nip', $dosen->nip)" placeholder="Masukkan NIP..." required />
                    <x-input-error :messages="$errors->get('nip')" class="mt-2" />
                </div>

                <!-- Nama -->
                <div>
                    <x-input-label for="nama" :value="__('Nama Lengkap')" class="mb-2 dark:text-gray-300" />
                    <x-text-input id="nama" name="nama" type="text" class="w-full px-4 py-3 rounded-xl dark:bg-slate-800 dark:border-slate-700" 
                        :value="old('nama', $dosen->nama)" placeholder="Masukkan Nama Lengkap..." required />
                    <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Alamat Email')" class="mb-2 dark:text-gray-300" />
                    <x-text-input id="email" name="email" type="email" class="w-full px-4 py-3 rounded-xl dark:bg-slate-800 dark:border-slate-700" 
                        :value="old('email', $dosen->email)" placeholder="contoh@univ.ac.id" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Jabatan -->
                <div>
                    <x-input-label for="jabatan" :value="__('Jabatan Akademik')" class="mb-2 dark:text-gray-300" />
                    <x-text-input id="jabatan" name="jabatan" type="text" class="w-full px-4 py-3 rounded-xl dark:bg-slate-800 dark:border-slate-700" 
                        :value="old('jabatan', $dosen->jabatan)" placeholder="Lektor Kepala / Asisten Ahli..." required />
                    <x-input-error :messages="$errors->get('jabatan')" class="mt-2" />
                </div>

                <!-- Prodi -->
                <div>
                    <x-input-label for="prodi" :value="__('Program Studi')" class="mb-2 dark:text-gray-300" />
                    <x-select-input id="prodi" name="prodi" class="w-full px-4 py-3 rounded-xl dark:bg-slate-800 dark:border-slate-700" required>
                        <option value="">Pilih Program Studi</option>
                        <option value="Informatika" {{ old('prodi', $dosen->prodi) === 'Informatika' ? 'selected' : '' }}>Informatika</option>
                        <option value="Sistem Informasi" {{ old('prodi', $dosen->prodi) === 'Sistem Informasi' ? 'selected' : '' }}>Sistem Informasi</option>
                        <option value="Teknik Elektro" {{ old('prodi', $dosen->prodi) === 'Teknik Elektro' ? 'selected' : '' }}>Teknik Elektro</option>
                    </x-select-input>
                    <x-input-error :messages="$errors->get('prodi')" class="mt-2" />
                </div>

                <!-- Status Aktif -->
                <div class="flex items-center space-x-3 pt-8">
                    <input type="checkbox" id="is_active" name="is_active" value="1" 
                        class="w-5 h-5 rounded border-slate-300 dark:border-slate-700 text-blue-600 focus:ring-blue-500 bg-white dark:bg-slate-800"
                        {{ old('is_active', $dosen->is_active ?? true) ? 'checked' : '' }}>
                    <x-input-label for="is_active" :value="__('Status Akun Aktif')" class="dark:text-gray-300" />
                </div>
            </div>

            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-slate-100 dark:border-slate-800">
                <a href="{{ route('dosen.index') }}" class="px-6 py-2.5 text-sm font-medium text-slate-600 dark:text-gray-400 hover:text-slate-900 dark:hover:text-white transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-8 py-2.5 bg-blue-600 dark:bg-[#2188FF] hover:bg-blue-700 dark:hover:bg-blue-600 text-sm font-bold text-white rounded-xl shadow-lg shadow-blue-500/20 transition-all">
                    Simpan Data Dosen
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
