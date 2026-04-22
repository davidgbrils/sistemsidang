@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-white">Ganti Penguji</h2>
            <p class="text-gray-400 mt-1 text-sm">Pengajuan penggantian penguji sidang.</p>
        </div>
        <a href="{{ route('penguji.history') }}" class="px-4 py-2 bg-[#131623] hover:bg-gray-800 border border-gray-700 text-sm font-medium rounded-xl text-gray-300 transition-colors">
            Riwayat
        </a>
    </div>

    <div class="bg-[#131623] border border-gray-800 rounded-2xl shadow-xl overflow-hidden">
        <table class="w-full">
            <thead class="bg-[#0D1117]/50 border-b border-gray-800">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Mahasiswa</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Penguji Lama</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Penguji Baru</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Alasan</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Status</th>
                    <th class="px-6 py-4 text-right text-xs font-medium text-gray-400 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800/50">
                @forelse($penguji as $p)
                <tr class="hover:bg-gray-800/20">
                    <td class="px-6 py-4">
                        <p class="text-sm text-white font-medium">{{ $p->jadwal->mahasiswa->nama ?? '-' }}</p>
                    </td>
                    <td class="px-6 py-4 text-gray-300">{{ $p->pengujiLama->nama ?? '-' }}</td>
                    <td class="px-6 py-4 text-gray-300">{{ $p->pengujiBaru->nama ?? '-' }}</td>
                    <td class="px-6 py-4 text-gray-400 text-sm">{{ Str::limit($p->alasan, 50) }}</td>
                    <td class="px-6 py-4">
                        @php
                            $statusClass = match($p->status) {
                                'pending' => 'bg-amber-500/10 text-amber-400',
                                'approved' => 'bg-emerald-500/10 text-emerald-400',
                                'rejected' => 'bg-red-500/10 text-red-400',
                                default => 'bg-gray-500/10 text-gray-400'
                            };
                        @endphp
                        <span class="px-3 py-1 rounded-full text-xs font-medium {{ $statusClass }}">
                            {{ ucfirst($p->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        @if($p->status === 'pending')
                        <form action="{{ route('penguji.approve', $p) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-emerald-400 hover:text-emerald-300 mr-2">Setuju</button>
                        </form>
                        <form action="{{ route('penguji.reject', $p) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-red-400 hover:text-red-300">Tolak</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                        Tidak ada pengajuan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection