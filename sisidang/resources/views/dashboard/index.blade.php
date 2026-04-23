@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900 dark:text-white">Dashboard</h1>
        <p class="text-slate-500 dark:text-slate-400 mt-2">Selamat datang di Sistem Informasi Sidang</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white dark:bg-slate-800 rounded-lg p-6 shadow-sm border border-slate-200 dark:border-slate-700">
            <div class="flex items-center">
                <div class="p-3 bg-blue-600 rounded-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-slate-500 dark:text-slate-400">Total Jadwal</p>
                    <p class="text-2xl font-bold text-slate-900 dark:text-white">0</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 rounded-lg p-6 shadow-sm border border-slate-200 dark:border-slate-700">
            <div class="flex items-center">
                <div class="p-3 bg-green-600 rounded-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-slate-500 dark:text-slate-400">Selesai</p>
                    <p class="text-2xl font-bold text-slate-900 dark:text-white">0</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 rounded-lg p-6 shadow-sm border border-slate-200 dark:border-slate-700">
            <div class="flex items-center">
                <div class="p-3 bg-yellow-600 rounded-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-slate-500 dark:text-slate-400">Dalam Proses</p>
                    <p class="text-2xl font-bold text-slate-900 dark:text-white">0</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 rounded-lg p-6 shadow-sm border border-slate-200 dark:border-slate-700">
            <div class="flex items-center">
                <div class="p-3 bg-red-600 rounded-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-slate-500 dark:text-slate-400">Dibatalkan</p>
                    <p class="text-2xl font-bold text-slate-900 dark:text-white">0</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white dark:bg-slate-800 rounded-lg p-6 shadow-sm border border-slate-200 dark:border-slate-700">
            <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-4">Jadwal Terbaru</h2>
            <div class="text-slate-500 dark:text-slate-400">
                <p>Belum ada jadwal sidang</p>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 rounded-lg p-6 shadow-sm border border-slate-200 dark:border-slate-700">
            <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-4">Notifikasi</h2>
            <div class="text-slate-500 dark:text-slate-400">
                <p>Belum ada notifikasi</p>
            </div>
        </div>
    </div>
</div>
@endsection
