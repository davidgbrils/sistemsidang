@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-white">Jadwal Sidang</h2>
            <p class="text-gray-400 mt-1 text-sm">Kelola jadwal sidang mahasiswa.</p>
        </div>
        @can('jadwal.create')
        <a href="{{ route('jadwal.create') }}" class="px-4 py-2 bg-[#2188FF] hover:bg-blue-600 text-sm font-medium rounded-xl text-white transition-colors shadow-lg shadow-blue-500/20 flex items-center space-x-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>Tambah Jadwal</span>
        </a>
        @endcan
    </div>

    <div class="bg-[#131623] border border-gray-800 rounded-2xl shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-[#0D1117]/50 border-b border-gray-800">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Mahasiswa</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Penguji 1</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Penguji 2</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Ruang</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-medium text-gray-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800/50">
                    @forelse($jadwals as $jadwal)
                    <tr class="hover:bg-gray-800/20 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center space-x-2">
                                <div class="w-10 h-10 bg-blue-500/10 rounded-lg border border-blue-500/20 flex flex-col items-center justify-center">
                                    <span class="text-xs text-blue-400 font-bold">{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d') }}</span>
                                    <span class="text-[8px] text-gray-400 uppercase">{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('M') }}</span>
                                </div>
                                <div>
                                    <p class="text-sm text-white font-medium">{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</p>
                                    <p class="text-xs text-gray-500">WIB</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-white font-medium">{{ $jadwal->mahasiswa->nama ?? '-' }}</p>
                            <p class="text-xs text-gray-500">{{ $jadwal->mahasiswa->nim ?? '-' }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-300">{{ $jadwal->penguji1->nama ?? '-' }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-300">{{ $jadwal->penguji2->nama ?? '-' }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-300">{{ $jadwal->ruang }}</p>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $statusClasses = [
                                    'terjadwal' => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
                                    'selesai' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
                                    'batal' => 'bg-red-500/10 text-red-400 border-red-500/20',
                                ];
                                $statusLabels = [
                                    'terjadwal' => 'Terjadwal',
                                    'selesai' => 'Selesai',
                                    'batal' => 'Batal',
                                ];
                            @endphp
                            <span class="px-3 py-1 rounded-full text-xs font-medium border {{ $statusClasses[$jadwal->status] ?? 'bg-gray-500/10 text-gray-400 border-gray-500/20' }}">
                                {{ $statusLabels[$jadwal->status] ?? $jadwal->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('jadwal.show', $jadwal) }}" class="text-gray-400 hover:text-white transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                            <p>Belum ada jadwal sidang.</p>
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