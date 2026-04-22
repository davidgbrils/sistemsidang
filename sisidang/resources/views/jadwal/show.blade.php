@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-white">Detail Jadwal Sidang</h2>
            <p class="text-gray-400 mt-1 text-sm">Informasi lengkap jadwal sidang.</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('jadwal.index') }}" class="px-4 py-2 bg-[#131623] hover:bg-gray-800 border border-gray-700 text-sm font-medium rounded-xl text-gray-300 transition-colors">
                Kembali
            </a>
            <a href="{{ route('jadwal.edit', $jadwal) }}" class="px-4 py-2 bg-[#2188FF] hover:bg-blue-600 text-sm font-medium rounded-xl text-white transition-colors">
                Edit
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-[#131623] border border-gray-800 rounded-2xl shadow-xl p-6">
            <h3 class="text-lg font-bold text-white mb-4">Informasi Sidang</h3>
            <div class="space-y-4">
                <div class="flex justify-between py-2 border-b border-gray-800">
                    <span class="text-gray-400">Mahasiswa</span>
                    <span class="text-white font-medium">{{ $jadwal->mahasiswa->nama ?? '-' }}</span>
                </div>
                <div class="flex justify-between py-2 border-b border-gray-800">
                    <span class="text-gray-400">NIM</span>
                    <span class="text-white">{{ $jadwal->mahasiswa->nim ?? '-' }}</span>
                </div>
                <div class="flex justify-between py-2 border-b border-gray-800">
                    <span class="text-gray-400">Tanggal</span>
                    <span class="text-white">{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d M Y') }}</span>
                </div>
                <div class="flex justify-between py-2 border-b border-gray-800">
                    <span class="text-gray-400">Jam</span>
                    <span class="text-white">{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }} WIB</span>
                </div>
                <div class="flex justify-between py-2 border-b border-gray-800">
                    <span class="text-gray-400">Ruang</span>
                    <span class="text-white">{{ $jadwal->ruang }}</span>
                </div>
                <div class="flex justify-between py-2">
                    <span class="text-gray-400">Status</span>
                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-blue-500/10 text-blue-400 border border-blue-500/20">
                        {{ ucfirst($jadwal->status) }}
                    </span>
                </div>
            </div>
        </div>

        <div class="bg-[#131623] border border-gray-800 rounded-2xl shadow-xl p-6">
            <h3 class="text-lg font-bold text-white mb-4">Dosen Penguji</h3>
            <div class="space-y-4">
                <div class="flex justify-between py-2 border-b border-gray-800">
                    <span class="text-gray-400">Penguji 1</span>
                    <span class="text-white font-medium">{{ $jadwal->penguji1->nama ?? '-' }}</span>
                </div>
                <div class="flex justify-between py-2 border-b border-gray-800">
                    <span class="text-gray-400">Penguji 2</span>
                    <span class="text-white font-medium">{{ $jadwal->penguji2->nama ?? '-' }}</span>
                </div>
                <div class="flex justify-between py-2">
                    <span class="text-gray-400">Pembimbing</span>
                    <span class="text-white font-medium">{{ $jadwal->pembimbing->nama ?? '-' }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-[#131623] border border-gray-800 rounded-2xl shadow-xl p-6">
        <h3 class="text-lg font-bold text-white mb-4">Nilai Sidang</h3>
        @if($jadwal->nilai->count() > 0)
        <table class="w-full">
            <thead class="border-b border-gray-800">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-400">Dosen</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-400">Nilai Angka</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-400">Nilai Huruf</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-400">Keterangan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800">
                @foreach($jadwal->nilai as $nilai)
                <tr>
                    <td class="px-4 py-3 text-gray-300">{{ $nilai->dosen->nama ?? '-' }}</td>
                    <td class="px-4 py-3 text-white font-medium">{{ $nilai->nilai_angka }}</td>
                    <td class="px-4 py-3 text-white">{{ $nilai->nilai_huruf }}</td>
                    <td class="px-4 py-3 text-gray-400">{{ $nilai->keterangan ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p class="text-gray-500 text-center py-4">Belum ada nilai yang diinput.</p>
        @endif
    </div>

    <form action="{{ route('jadwal.destroy', $jadwal) }}" method="POST" onsubmit="return confirm('Yakin hapus jadwal ini?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="px-4 py-2 bg-red-500/10 hover:bg-red-500/20 border border-red-500/30 text-red-400 text-sm font-medium rounded-xl transition-colors">
            Hapus Jadwal
        </button>
    </form>
</div>
@endsection