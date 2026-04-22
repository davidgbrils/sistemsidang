@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-white">Input Nilai Sidang</h2>
            <p class="text-gray-400 mt-1 text-sm">Input nilai untuk mahasiswa sidang.</p>
        </div>
        <a href="{{ route('nilai.rekap') }}" class="px-4 py-2 bg-[#131623] hover:bg-gray-800 border border-gray-700 text-sm font-medium rounded-xl text-gray-300 transition-colors">
            Rekap Nilai
        </a>
    </div>

    <div class="bg-[#131623] border border-gray-800 rounded-2xl shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-[#0D1117]/50 border-b border-gray-800">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Tanggal</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Mahasiswa</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Penguji 1</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Penguji 2</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-medium text-gray-400 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800/50">
                    @forelse($jadwals as $jadwal)
                    <tr class="hover:bg-gray-800/20">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <p class="text-sm text-white">{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d M Y') }}</p>
                            <p class="text-xs text-gray-500">{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-white font-medium">{{ $jadwal->mahasiswa->nama ?? '-' }}</p>
                            <p class="text-xs text-gray-500">{{ $jadwal->mahasiswa->nim ?? '-' }}</p>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-300">{{ $jadwal->penguji1->nama ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-300">{{ $jadwal->penguji2->nama ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-medium border 
                                {{ $jadwal->status === 'selesai' ? 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20' : 'bg-blue-500/10 text-blue-400 border-blue-500/20' }}">
                                {{ ucfirst($jadwal->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('nilai.form', $jadwal) }}" class="text-[#2188FF] hover:text-blue-400 font-medium">
                                Input Nilai
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                            Tidak ada jadwal sidang.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($jadwals->hasPages())
        <div class="px-6 py-4 border-t border-gray-800">
            {{ $jadwals->links() }}
        </div>
        @endif
    </div>
</div>
@endsection