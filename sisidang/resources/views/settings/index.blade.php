@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800">
            <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-800">
                <h1 class="text-xl font-semibold text-slate-900 dark:text-white">Pengaturan</h1>
            </div>

            <div class="p-6 space-y-6">
                <!-- Theme Settings -->
                <div>
                    <h3 class="text-lg font-medium text-slate-900 dark:text-white mb-4">Tema</h3>
                    <div class="flex gap-4">
                        <form action="{{ route('settings.theme') }}" method="POST" class="flex-1">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="theme" value="light">
                            <button type="submit" class="w-full p-4 border-2 border-slate-200 dark:border-slate-700 rounded-xl hover:border-blue-500 dark:hover:border-blue-500 transition-colors {{ session('theme') == 'light' ? 'border-blue-500' : '' }}">
                                <div class="flex flex-col items-center gap-2">
                                    <svg class="w-8 h-8 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    </svg>
                                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Light</span>
                                </div>
                            </button>
                        </form>
                        <form action="{{ route('settings.theme') }}" method="POST" class="flex-1">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="theme" value="dark">
                            <button type="submit" class="w-full p-4 border-2 border-slate-200 dark:border-slate-700 rounded-xl hover:border-blue-500 dark:hover:border-blue-500 transition-colors {{ session('theme') == 'dark' ? 'border-blue-500' : '' }}">
                                <div class="flex flex-col items-center gap-2">
                                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                                    </svg>
                                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Dark</span>
                                </div>
                            </button>
                        </form>
                        <form action="{{ route('settings.theme') }}" method="POST" class="flex-1">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="theme" value="system">
                            <button type="submit" class="w-full p-4 border-2 border-slate-200 dark:border-slate-700 rounded-xl hover:border-blue-500 dark:hover:border-blue-500 transition-colors {{ session('theme') == 'system' || !session('theme') ? 'border-blue-500' : '' }}">
                                <div class="flex flex-col items-center gap-2">
                                    <svg class="w-8 h-8 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">System</span>
                                </div>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- App Info -->
                <div class="pt-6 border-t border-slate-200 dark:border-slate-800">
                    <h3 class="text-lg font-medium text-slate-900 dark:text-white mb-4">Informasi Aplikasi</h3>
                    <div class="bg-slate-50 dark:bg-slate-800/50 rounded-xl p-4 space-y-2">
                        <div class="flex justify-between">
                            <span class="text-sm text-slate-500 dark:text-slate-400">Versi</span>
                            <span class="text-sm text-slate-900 dark:text-white">1.0.0</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-slate-500 dark:text-slate-400">Laravel</span>
                            <span class="text-sm text-slate-900 dark:text-white">11.x</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
