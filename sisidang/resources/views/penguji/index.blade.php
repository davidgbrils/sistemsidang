@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Ganti Penguji</h2>
            <p class="text-slate-500 dark:text-gray-400 mt-1 text-sm">Pengajuan penggantian penguji sidang.</p>
        </div>
    </div>

    @if (session('success'))
        <div class="bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-100 dark:border-emerald-500/20 text-emerald-600 dark:text-emerald-400 px-4 py-3 rounded-xl text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50 dark:bg-slate-950/50 border-b border-slate-200 dark:border-slate-800">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-gray-400 uppercase tracking-wider">Mahasiswa</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-gray-400 uppercase tracking-wider">Penguji Lama</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-gray-400 uppercase tracking-wider">Penguji Baru</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-gray-400 uppercase tracking-wider">Alasan</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                        @role('admin|kaprodi')
                        <th class="px-6 py-4 text-right text-xs font-medium text-slate-500 dark:text-gray-400 uppercase tracking-wider">Aksi</th>
                        @endrole
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800/50">
                    @forelse($gantis as $p)
                    <tr class="hover:bg-slate-50 dark:hover:bg-gray-800/20 transition-colors">
                        <td class="px-6 py-4">
                            <p class="text-sm text-slate-900 dark:text-white font-medium">{{ $p->jadwal->mahasiswa->nama ?? '-' }}</p>
                            <p class="text-[10px] text-slate-500 dark:text-gray-500">Oleh: {{ $p->requester->name ?? '-' }}</p>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600 dark:text-gray-300">{{ $p->pengujiLama->nama ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600 dark:text-gray-300">{{ $p->pengujiBaru->nama ?? '-' }}</td>
                        <td class="px-6 py-4 text-slate-500 dark:text-gray-400 text-sm">
                            <span title="{{ $p->alasan }}">{{ Str::limit($p->alasan, 30) }}</span>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $statusClass = match($p->status) {
                                    'pending' => 'bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400 border-amber-100 dark:border-amber-500/20',
                                    'approved' => 'bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border-emerald-100 dark:border-emerald-500/20',
                                    'declined', 'rejected' => 'bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-400 border-red-100 dark:border-red-500/20',
                                    default => 'bg-slate-50 dark:bg-slate-500/10 text-slate-600 dark:text-slate-400 border-slate-100 dark:border-slate-500/20'
                                };
                            @endphp
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider border {{ $statusClass }}">
                                {{ $p->status }}
                            </span>
                        </td>
                        @role('admin|kaprodi')
                        <td class="px-6 py-4 text-right">
                            @if($p->status === 'pending')
                            <div class="flex justify-end space-x-2">
                                <form action="{{ route('penguji.approve', $p) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:underline">Setuju</button>
                                </form>
                                
                                <button type="button" 
                                    @click="$dispatch('open-modal', 'reject-modal-{{ $p->id }}')"
                                    class="text-xs font-bold text-red-600 dark:text-red-400 hover:underline">
                                    Tolak
                                </button>
                            </div>

                            <x-modal name="reject-modal-{{ $p->id }}" focusable>
                                <form method="post" action="{{ route('penguji.reject', $p) }}" class="p-6 text-left">
                                    @csrf
                                    <h2 class="text-lg font-medium text-slate-900 dark:text-white">
                                        Alasan Penolakan
                                    </h2>
                                    <p class="mt-1 text-sm text-slate-600 dark:text-gray-400">
                                        Silakan berikan alasan mengapa pengajuan ini ditolak.
                                    </p>
                                    <div class="mt-6">
                                        <x-text-input name="alasan_penolakan" type="text" class="mt-1 block w-full" placeholder="Alasan..." required />
                                    </div>
                                    <div class="mt-6 flex justify-end">
                                        <x-secondary-button x-on:click="$dispatch('close')">
                                            Batal
                                        </x-secondary-button>
                                        <x-danger-button class="ms-3">
                                            Tolak Pengajuan
                                        </x-danger-button>
                                    </div>
                                </form>
                            </x-modal>
                            @endif
                        </td>
                        @endrole
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-slate-500 dark:text-gray-500">
                            Tidak ada pengajuan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($gantis->hasPages())
        <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/50">
            {{ $gantis->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
