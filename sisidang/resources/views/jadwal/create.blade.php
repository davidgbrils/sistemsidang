@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Tambah Jadwal Sidang</h2>
            <p class="text-slate-500 dark:text-gray-400 mt-1 text-sm">Buat jadwal sidang baru.</p>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-xl p-6">
        <form action="{{ route('jadwal.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <x-input-label for="mahasiswa_id" :value="__('Mahasiswa')" class="mb-2 dark:text-gray-300" />
                    <x-select-input name="mahasiswa_id" id="mahasiswa_id" class="w-full px-4 py-3 rounded-xl">
                        <option value="">Pilih Mahasiswa</option>
                        @foreach($mahasiswas as $m)
                        <option value="{{ $m->id }}">{{ $m->nama }} ({{ $m->nim }})</option>
                        @endforeach
                    </x-select-input>
                    @error('mahasiswa_id')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <x-input-label for="ruang" :value="__('Ruang')" class="mb-2 dark:text-gray-300" />
                    <x-text-input type="text" name="ruang" id="ruang" class="w-full px-4 py-3 rounded-xl" placeholder="Ruang Sidang" />
                    @error('ruang')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <x-input-label for="penguji1_id" :value="__('Penguji 1')" class="mb-2 dark:text-gray-300" />
                    <x-select-input name="penguji1_id" id="penguji1_id" class="w-full px-4 py-3 rounded-xl">
                        <option value="">Pilih Penguji 1</option>
                        @foreach($dosens as $d)
                        <option value="{{ $d->id }}">{{ $d->nama }}</option>
                        @endforeach
                    </x-select-input>
                    @error('penguji1_id')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <x-input-label for="penguji2_id" :value="__('Penguji 2')" class="mb-2 dark:text-gray-300" />
                    <x-select-input name="penguji2_id" id="penguji2_id" class="w-full px-4 py-3 rounded-xl">
                        <option value="">Pilih Penguji 2</option>
                        @foreach($dosens as $d)
                        <option value="{{ $d->id }}">{{ $d->nama }}</option>
                        @endforeach
                    </x-select-input>
                    @error('penguji2_id')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <x-input-label for="pembimbing_id" :value="__('Pembimbing')" class="mb-2 dark:text-gray-300" />
                    <x-select-input name="pembimbing_id" id="pembimbing_id" class="w-full px-4 py-3 rounded-xl">
                        <option value="">Pilih Pembimbing</option>
                        @foreach($dosens as $d)
                        <option value="{{ $d->id }}">{{ $d->nama }}</option>
                        @endforeach
                    </x-select-input>
                    @error('pembimbing_id')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <x-input-label for="tanggal" :value="__('Tanggal')" class="mb-2 dark:text-gray-300" />
                    <x-text-input type="date" name="tanggal" id="tanggal" class="w-full px-4 py-3 rounded-xl" />
                    @error('tanggal')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <x-input-label for="jam_mulai" :value="__('Jam Mulai')" class="mb-2 dark:text-gray-300" />
                    <x-text-input type="time" name="jam_mulai" id="jam_mulai" class="w-full px-4 py-3 rounded-xl" />
                    @error('jam_mulai')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <x-input-label for="jam_selesai" :value="__('Jam Selesai')" class="mb-2 dark:text-gray-300" />
                    <x-text-input type="time" name="jam_selesai" id="jam_selesai" class="w-full px-4 py-3 rounded-xl" />
                    @error('jam_selesai')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end space-x-3 pt-4">
                <a href="{{ route('jadwal.index') }}" class="px-6 py-2 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 border border-slate-200 dark:border-slate-700 text-sm font-medium rounded-xl text-slate-600 dark:text-gray-300 transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 bg-blue-600 dark:bg-[#2188FF] hover:bg-blue-700 dark:hover:bg-blue-600 text-sm font-medium rounded-xl text-white transition-colors shadow-lg shadow-blue-500/20">
                    Simpan Jadwal
                </button>
            </div>
        </form>
    </div>
</div>
@endsection