@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-white">Rekap Honor</h2>
            <p class="text-gray-400 mt-1 text-sm">Rekap honor penguji dan pembimbing.</p>
        </div>
        <a href="{{ route('honor.export', ['bulan' => request('bulan')]) }}" class="px-4 py-2 bg-[#131623] hover:bg-gray-800 border border-gray-700 text-sm font-medium rounded-xl text-gray-300 transition-colors flex items-center space-x-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
            <span>Export</span>
        </a>
    </div>

    <form method="GET" class="flex flex-wrap gap-4">
        <input type="month" name="bulan" value="{{ request('bulan') }}" class="bg-[#0D1117] border border-gray-700 rounded-xl px-4 py-2 text-white focus:outline-none focus:border-[#2188FF]">
        <button type="submit" class="px-4 py-2 bg-[#2188FF] text-white rounded-xl">Filter</button>
    </form>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($honorPerDosen as $data)
        <div class="bg-[#131623] border border-gray-800 rounded-2xl shadow-xl p-6">
            <p class="text-sm text-gray-400">Dosen</p>
            <p class="text-lg font-bold text-white">{{ $data['dosen']->nama ?? '-' }}</p>
            <div class="mt-4 space-y-2">
                <div class="flex justify-between">
                    <span class="text-gray-400">Total Sidang</span>
                    <span class="text-white">{{ $data['total_sidang'] }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Honor/Sidang</span>
                    <span class="text-white">Rp 250.000</span>
                </div>
                <div class="flex justify-between pt-2 border-t border-gray-800">
                    <span class="text-gray-300 font-medium">Total Honor</span>
                    <span class="text-white font-bold">Rp {{ number_format($data['total_honor'], 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="bg-[#131623] border border-gray-800 rounded-2xl shadow-xl overflow-hidden">
        <table class="w-full">
            <thead class="bg-[#0D1117]/50 border-b border-gray-800">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Tanggal</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Mahasiswa</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Penguji 1</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Penguji 2</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Ruang</th>
                    <th class="px-6 py-4 text-right text-xs font-medium text-gray-400 uppercase">Honor</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800/50">
                @forelse($jadwals as $j)
                <tr class="hover:bg-gray-800/20">
                    <td class="px-6 py-4 text-sm text-white">{{ \Carbon\Carbon::parse($j->tanggal)->format('d M Y') }}</td>
                    <td class="px-6 py-4">
                        <p class="text-sm text-white">{{ $j->mahasiswa->nama ?? '-' }}</p>
                        <p class="text-xs text-gray-500">{{ $j->mahasiswa->nim ?? '-' }}</p>
                    </td>
                    <td class="px-6 py-4 text-gray-300">{{ $j->penguji1->nama ?? '-' }}</td>
                    <td class="px-6 py-4 text-gray-300">{{ $j->penguji2->nama ?? '-' }}</td>
                    <td class="px-6 py-4 text-gray-300">{{ $j->ruang }}</td>
                    <td class="px-6 py-4 text-right text-white font-medium">Rp 250.000</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                        Tidak ada data.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection