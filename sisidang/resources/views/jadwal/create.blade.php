@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-white">Tambah Jadwal Sidang</h2>
            <p class="text-gray-400 mt-1 text-sm">Buat jadwal sidang baru.</p>
        </div>
    </div>

    <div class="bg-[#131623] border border-gray-800 rounded-2xl shadow-xl p-6">
        <form action="{{ route('jadwal.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Mahasiswa</label>
                    <select name="mahasiswa_id" class="w-full bg-[#0D1117] border border-gray-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-[#2188FF]">
                        <option value="">Pilih Mahasiswa</option>
                        @foreach($mahasiswas as $m)
                        <option value="{{ $m->id }}">{{ $m->nama }} ({{ $m->nim }})</option>
                        @endforeach
                    </select>
                    @error('mahasiswa_id')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Ruang</label>
                    <input type="text" name="ruang" class="w-full bg-[#0D1117] border border-gray-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-[#2188FF]" placeholder="Ruang Sidang">
                    @error('ruang')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Penguji 1</label>
                    <select name="penguji1_id" class="w-full bg-[#0D1117] border border-gray-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-[#2188FF]">
                        <option value="">Pilih Penguji 1</option>
                        @foreach($dosens as $d)
                        <option value="{{ $d->id }}">{{ $d->nama }}</option>
                        @endforeach
                    </select>
                    @error('penguji1_id')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Penguji 2</label>
                    <select name="penguji2_id" class="w-full bg-[#0D1117] border border-gray-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-[#2188FF]">
                        <option value="">Pilih Penguji 2</option>
                        @foreach($dosens as $d)
                        <option value="{{ $d->id }}">{{ $d->nama }}</option>
                        @endforeach
                    </select>
                    @error('penguji2_id')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Pembimbing</label>
                    <select name="pembimbing_id" class="w-full bg-[#0D1117] border border-gray-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-[#2188FF]">
                        <option value="">Pilih Pembimbing</option>
                        @foreach($dosens as $d)
                        <option value="{{ $d->id }}">{{ $d->nama }}</option>
                        @endforeach
                    </select>
                    @error('pembimbing_id')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Tanggal</label>
                    <input type="date" name="tanggal" class="w-full bg-[#0D1117] border border-gray-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-[#2188FF]">
                    @error('tanggal')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Jam Mulai</label>
                    <input type="time" name="jam_mulai" class="w-full bg-[#0D1117] border border-gray-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-[#2188FF]">
                    @error('jam_mulai')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Jam Selesai</label>
                    <input type="time" name="jam_selesai" class="w-full bg-[#0D1117] border border-gray-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-[#2188FF]">
                    @error('jam_selesai')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end space-x-3 pt-4">
                <a href="{{ route('jadwal.index') }}" class="px-6 py-2 bg-[#131623] hover:bg-gray-800 border border-gray-700 text-sm font-medium rounded-xl text-gray-300 transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 bg-[#2188FF] hover:bg-blue-600 text-sm font-medium rounded-xl text-white transition-colors shadow-lg shadow-blue-500/20">
                    Simpan Jadwal
                </button>
            </div>
        </form>
    </div>
</div>
@endsection