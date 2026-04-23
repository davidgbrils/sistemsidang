@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Rekap Honor</h2>
            <p class="text-slate-500 dark:text-gray-400 mt-1 text-sm">Rekap honor penguji dan pembimbing.</p>
        </div>
        <a href="{{ route('honor.export', ['bulan' => request('bulan')]) }}" class="px-4 py-2 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 border border-slate-200 dark:border-slate-700 text-sm font-medium rounded-xl text-slate-600 dark:text-gray-300 transition-colors flex items-center space-x-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
            <span>Export</span>
        </a>
    </div>

    <form method="GET" class="flex flex-wrap gap-4">
        <input type="month" name="bulan" value="{{ request('bulan') }}" class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2 text-slate-900 dark:text-white focus:outline-none focus:border-blue-500">
        <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl">Filter</button>
    </form>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($honorPerDosen as $data)
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-xl p-6">
            <p class="text-sm text-slate-500 dark:text-gray-400">Dosen</p>
            <p class="text-lg font-bold text-slate-900 dark:text-white">{{ $data['dosen']->nama ?? '-' }}</p>
            <div class="mt-4 space-y-2">
                <div class="flex justify-between">
                    <span class="text-slate-500 dark:text-gray-400">Total Sidang</span>
                    <span class="text-slate-900 dark:text-white">{{ $data['total_sidang'] }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500 dark:text-gray-400">Honor/Sidang</span>
                    <span class="text-slate-900 dark:text-white">Rp 250.000</span>
                </div>
                <div class="flex justify-between pt-2 border-t border-slate-200 dark:border-slate-800">
                    <span class="text-slate-700 dark:text-gray-300 font-medium">Total Honor</span>
                    <span class="text-slate-900 dark:text-white font-bold">Rp {{ number_format($data['total_honor'], 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-xl overflow-hidden">
        <table class="w-full">
            <thead class="bg-slate-50 dark:bg-slate-950/50 border-b border-slate-200 dark:border-slate-800">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-gray-400 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-gray-400 uppercase tracking-wider">Mahasiswa</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-gray-400 uppercase tracking-wider">Penguji 1</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-gray-400 uppercase tracking-wider">Penguji 2</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-gray-400 uppercase tracking-wider">Ruang</th>
                    <th class="px-6 py-4 text-right text-xs font-medium text-slate-500 dark:text-gray-400 uppercase tracking-wider">Honor</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800/50">
                @forelse($jadwals as $j)
                <tr class="hover:bg-slate-50 dark:hover:bg-gray-800/20 transition-colors">
                    <td class="px-6 py-4 text-sm text-slate-900 dark:text-white">{{ \Carbon\Carbon::parse($j->tanggal)->format('d M Y') }}</td>
                    <td class="px-6 py-4">
                        <p class="text-sm text-slate-900 dark:text-white">{{ $j->mahasiswa->nama ?? '-' }}</p>
                        <p class="text-xs text-slate-500 dark:text-gray-500">{{ $j->mahasiswa->nim ?? '-' }}</p>
                    </td>
                    <td class="px-6 py-4 text-slate-600 dark:text-gray-300">{{ $j->penguji1->nama ?? '-' }}</td>
                    <td class="px-6 py-4 text-slate-600 dark:text-gray-300">{{ $j->penguji2->nama ?? '-' }}</td>
                    <td class="px-6 py-4 text-slate-600 dark:text-gray-300">{{ $j->ruang }}</td>
                    <td class="px-6 py-4 text-right text-slate-900 dark:text-white font-medium">Rp 250.000</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-slate-500 dark:text-gray-500">
                        Tidak ada data.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection