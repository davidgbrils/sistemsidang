@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800">
            <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between">
                <h1 class="text-xl font-semibold text-slate-900 dark:text-white">Notifikasi</h1>
                @if($notifications->count() > 0)
                <form action="{{ route('notifications.read-all') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-sm text-blue-600 dark:text-blue-500 hover:text-blue-800 dark:hover:text-blue-400">
                        Tandai semua dibaca
                    </button>
                </form>
                @endif
            </div>

            <div class="divide-y divide-slate-200 dark:divide-slate-800">
                @forelse($notifications as $notification)
                <div class="px-6 py-4 flex items-start gap-4 {{ $notification->read_at ? 'opacity-60' : '' }}">
                    <div class="flex-shrink-0 mt-1">
                        @if($notification->read_at)
                        <span class="w-2 h-2 bg-slate-300 dark:bg-slate-600 rounded-full block"></span>
                        @else
                        <span class="w-2 h-2 bg-blue-500 rounded-full block"></span>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm text-slate-900 dark:text-white">{{ $notification->data['message'] ?? 'Notifikasi' }}</p>
                        @if(isset($notification->data['action_url']))
                        <a href="{{ $notification->data['action_url'] }}" class="text-sm text-blue-600 dark:text-blue-500 hover:text-blue-800 dark:hover:text-blue-400 mt-1 inline-block">
                            Lihat detail →
                        </a>
                        @endif
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                    </div>
                    <div class="flex-shrink-0 flex items-center gap-2">
                        @if(!$notification->read_at)
                        <form action="{{ route('notifications.read', $notification->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="text-xs text-slate-500 hover:text-slate-700 dark:hover:text-slate-300">
                                Baca
                            </button>
                        </form>
                        @endif
                        <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs text-red-500 hover:text-red-700 dark:hover:text-red-400">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="px-6 py-12 text-center">
                    <svg class="w-12 h-12 mx-auto text-slate-300 dark:text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <p class="text-slate-500 dark:text-slate-400">Tidak ada notifikasi</p>
                </div>
                @endforelse
            </div>

            @if($notifications->hasPages())
            <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-800">
                {{ $notifications->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
