@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Request Ganti Penguji</h2>
            <p class="text-slate-500 dark:text-gray-400 mt-1 text-sm">Ajukan penggantian penguji untuk sidang mahasiswa: <strong>{{ $jadwal->mahasiswa->nama }}</strong></p>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-xl p-6">
        <form action="{{ route('penguji.store', $jadwal) }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Info Sidang -->
                <div class="md:col-span-2 bg-slate-50 dark:bg-slate-950/50 p-4 rounded-xl border border-slate-200 dark:border-slate-800">
                    <h3 class="text-sm font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-3">Detail Sidang</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm">
                        <div>
                            <p class="text-slate-500 dark:text-gray-400">Mahasiswa</p>
                            <p class="font-medium text-slate-900 dark:text-white">{{ $jadwal->mahasiswa->nama }} ({{ $jadwal->mahasiswa->nim }})</p>
                        </div>
                        <div>
                            <p class="text-slate-500 dark:text-gray-400">Tanggal & Waktu</p>
                            <p class="font-medium text-slate-900 dark:text-white">{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d M Y') }} | {{ $jadwal->jam_mulai }} WIB</p>
                        </div>
                        <div>
                            <p class="text-slate-500 dark:text-gray-400">Ruang</p>
                            <p class="font-medium text-slate-900 dark:text-white">{{ $jadwal->ruang }}</p>
                        </div>
                    </div>
                </div>

                <!-- Penguji yang akan diganti -->
                <div>
                    <x-input-label for="penguji_lama" :value="__('Penguji yang diganti')" class="mb-2 dark:text-gray-300" />
                    <x-select-input name="penguji_lama" id="penguji_lama" class="w-full px-4 py-3 rounded-xl" required>
                        <option value="">Pilih Penguji</option>
                        @php
                            $isPenguji1 = Auth::user()->hasRole('dosen') && Auth::user()->dosen && Auth::user()->dosen->id == $jadwal->penguji1_id;
                            $isPenguji2 = Auth::user()->hasRole('dosen') && Auth::user()->dosen && Auth::user()->dosen->id == $jadwal->penguji2_id;
                            $isAdmin = Auth::user()->hasAnyRole(['admin', 'kaprodi', 'staff_ften']);
                        @endphp
                        
                        @if($isAdmin || $isPenguji1)
                        <option value="penguji1" {{ $isPenguji1 ? 'selected' : '' }}>Penguji 1: {{ $jadwal->penguji1->nama }}</option>
                        @endif
                        
                        @if($isAdmin || $isPenguji2)
                        <option value="penguji2" {{ $isPenguji2 ? 'selected' : '' }}>Penguji 2: {{ $jadwal->penguji2->nama }}</option>
                        @endif
                    </x-select-input>
                    <x-input-error :messages="$errors->get('penguji_lama')" class="mt-2" />
                </div>

                <!-- Penguji Baru -->
                <div>
                    <x-input-label for="penguji_baru_id" :value="__('Calon Penguji Pengganti')" class="mb-2 dark:text-gray-300" />
                    <x-select-input name="penguji_baru_id" id="penguji_baru_id" class="w-full px-4 py-3 rounded-xl" required>
                        <option value="">Pilih Dosen Pengganti</option>
                        @foreach($dosens as $d)
                            @if($d->id != $jadwal->penguji1_id && $d->id != $jadwal->penguji2_id && $d->id != $jadwal->pembimbing_id)
                            <option value="{{ $d->id }}">{{ $d->nama }}</option>
                            @endif
                        @endforeach
                    </x-select-input>
                    <x-input-error :messages="$errors->get('penguji_baru_id')" class="mt-2" />
                    <p class="mt-1 text-[10px] text-slate-500 italic">*Dosen pembimbing dan penguji aktif saat ini tidak muncul dalam pilihan.</p>
                </div>

                <!-- Alasan -->
                <div class="md:col-span-2">
                    <x-input-label for="alasan" :value="__('Alasan Penggantian')" class="mb-2 dark:text-gray-300" />
                    <textarea id="alasan" name="alasan" rows="4" 
                        class="w-full border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 focus:border-blue-500 dark:focus:border-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 rounded-xl shadow-sm placeholder-slate-400 dark:placeholder-slate-500"
                        placeholder="Berikan alasan yang jelas mengapa diperlukan penggantian penguji..." required>{{ old('alasan') }}</textarea>
                    <x-input-error :messages="$errors->get('alasan')" class="mt-2" />
                </div>
            </div>

            <div class="flex justify-end space-x-3 pt-4">
                <a href="{{ route('jadwal.index') }}" class="px-6 py-2 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 border border-slate-200 dark:border-slate-700 text-sm font-medium rounded-xl text-slate-600 dark:text-gray-300 transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 bg-amber-600 hover:bg-amber-700 text-sm font-medium rounded-xl text-white transition-colors shadow-lg shadow-amber-500/20">
                    Kirim Pengajuan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
