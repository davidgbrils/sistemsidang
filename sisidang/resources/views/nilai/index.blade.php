@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Input Nilai Sidang</h2>
            <p class="text-slate-500 dark:text-gray-400 mt-1 text-sm">Input nilai untuk mahasiswa sidang.</p>
        </div>
        <a href="{{ route('nilai.rekap') }}" class="px-4 py-2 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 border border-slate-200 dark:border-slate-700 text-sm font-medium rounded-xl text-slate-600 dark:text-gray-300 transition-colors">
            Rekap Nilai
        </a>
    </div>

    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50 dark:bg-slate-950/50 border-b border-slate-200 dark:border-slate-800">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-gray-400 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-gray-400 uppercase tracking-wider">Mahasiswa</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-gray-400 uppercase tracking-wider">Penguji 1</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-gray-400 uppercase tracking-wider">Penguji 2</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-medium text-slate-500 dark:text-gray-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800/50">
                    @forelse($jadwals as $jadwal)
                    <tr class="hover:bg-slate-50 dark:hover:bg-gray-800/20 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <p class="text-sm font-medium text-slate-900 dark:text-white">{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d M Y') }}</p>
                            <p class="text-xs text-slate-500 dark:text-gray-500">{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-slate-900 dark:text-white font-medium">{{ $jadwal->mahasiswa->nama ?? '-' }}</p>
                            <p class="text-xs text-slate-500 dark:text-gray-500">{{ $jadwal->mahasiswa->nim ?? '-' }}</p>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600 dark:text-gray-300">{{ $jadwal->penguji1->nama ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600 dark:text-gray-300">{{ $jadwal->penguji2->nama ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-medium border 
                                {{ $jadwal->status === 'selesai' ? 'bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border-emerald-100 dark:border-emerald-500/20' : 'bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 border-blue-100 dark:border-blue-500/20' }}">
                                {{ ucfirst($jadwal->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('nilai.form', $jadwal) }}" class="text-blue-600 dark:text-[#2188FF] hover:text-blue-700 dark:hover:text-blue-400 font-medium">
                                Input Nilai
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-slate-500 dark:text-gray-500">
                            Tidak ada jadwal sidang.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($jadwals->hasPages())
        <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/50">
            {{ $jadwals->links() }}
        </div>
        @endif
    </div>
</div>
@endsection