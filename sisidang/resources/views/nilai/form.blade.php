@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-white">Input Nilai Sidang</h2>
            <p class="text-gray-400 mt-1 text-sm">Nilai untuk {{ $jadwal->mahasiswa->nama ?? '-' }}</p>
        </div>
        <a href="{{ route('nilai.index') }}" class="px-4 py-2 bg-[#131623] hover:bg-gray-800 border border-gray-700 text-sm font-medium rounded-xl text-gray-300 transition-colors">
            Kembali
        </a>
    </div>

    <div class="bg-[#131623] border border-gray-800 rounded-2xl shadow-xl p-6">
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
            <div>
                <p class="text-sm text-gray-400">Mahasiswa</p>
                <p class="text-white font-medium">{{ $jadwal->mahasiswa->nama ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-400">NIM</p>
                <p class="text-white">{{ $jadwal->mahasiswa->nim ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-400">Penguji 1</p>
                <p class="text-white">{{ $jadwal->penguji1->nama ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-400">Penguji 2</p>
                <p class="text-white">{{ $jadwal->penguji2->nama ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-400">Pembimbing</p>
                <p class="text-white">{{ $jadwal->pembimbing->nama ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-400">Tanggal</p>
                <p class="text-white">{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d M Y') }}</p>
            </div>
        </div>

        <form action="{{ route('nilai.store', $jadwal) }}" method="POST" class="space-y-6">
            @csrf
            <h3 class="text-lg font-bold text-white pt-4 border-t border-gray-800">Nilai dari Dosen</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach([$jadwal->penguji1, $jadwal->penguji2, $jadwal->pembimbing] as $dosen)
                @if($dosen)
                <div class="bg-[#0D1117] border border-gray-700 rounded-xl p-4">
                    <p class="text-sm font-medium text-white mb-3">{{ $dosen->nama }}</p>
                    @php $existing = $existingNilai[$dosen->id] ?? null; @endphp
                    <div class="space-y-3">
                        <div>
                            <label class="block text-xs text-gray-400 mb-1">Nilai Angka (0-100)</label>
                            <input type="number" name="nilai[{{ $dosen->id }}][nilai_angka]" value="{{ $existing->nilai_angka ?? '' }}" min="0" max="100" class="w-full bg-[#131623] border border-gray-600 rounded-lg px-3 py-2 text-white focus:outline-none focus:border-[#2188FF]">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-400 mb-1">Nilai Huruf</label>
                            <select name="nilai[{{ $dosen->id }}][nilai_huruf]" class="w-full bg-[#131623] border border-gray-600 rounded-lg px-3 py-2 text-white focus:outline-none focus:border-[#2188FF]">
                                <option value="">Pilih</option>
                                @foreach(['A', 'AB', 'B', 'BC', 'C', 'D', 'E'] as $huruf)
                                <option value="{{ $huruf }}" {{ ($existing->nilai_huruf ?? '') === $huruf ? 'selected' : '' }}>{{ $huruf }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs text-gray-400 mb-1">Keterangan</label>
                            <textarea name="nilai[{{ $dosen->id }}][keterangan]" rows="2" class="w-full bg-[#131623] border border-gray-600 rounded-lg px-3 py-2 text-white focus:outline-none focus:border-[#2188FF]">{{ $existing->keterangan ?? '' }}</textarea>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>

            <div class="flex justify-end pt-4 border-t border-gray-800">
                <button type="submit" class="px-6 py-2 bg-[#2188FF] hover:bg-blue-600 text-sm font-medium rounded-xl text-white transition-colors">
                    Simpan Nilai
                </button>
            </div>
        </form>
    </div>
</div>
@endsection