@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-white">Formulir Sidang</h2>
            <p class="text-gray-400 mt-1 text-sm">Kelola formulir absensi, rekap, dan revisi.</p>
        </div>
    </div>

    <div class="bg-[#131623] border border-gray-800 rounded-2xl shadow-xl overflow-hidden">
        <table class="w-full">
            <thead class="bg-[#0D1117]/50 border-b border-gray-800">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Tanggal</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Mahasiswa</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Status</th>
                    <th class="px-6 py-4 text-right text-xs font-medium text-gray-400 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800/50">
                @forelse($jadwals as $jadwal)
                <tr class="hover:bg-gray-800/20">
                    <td class="px-6 py-4">
                        <p class="text-sm text-white">{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d M Y') }}</p>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-sm text-white font-medium">{{ $jadwal->mahasiswa->nama ?? '-' }}</p>
                        <p class="text-xs text-gray-500">{{ $jadwal->mahasiswa->nim ?? '-' }}</p>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-blue-500/10 text-blue-400 border border-blue-500/20">
                            {{ ucfirst($jadwal->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('formulir.show', $jadwal) }}" class="text-[#2188FF] hover:text-blue-400">Lihat</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                        Tidak ada jadwal.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection