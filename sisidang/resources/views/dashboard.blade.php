@extends('layouts.app')

@section('content')
<div class="space-y-6">
    
    <!-- Welcome Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Selamat Datang, {{ Auth::user()->name }} 👋</h2>
            <p class="text-slate-500 dark:text-gray-400 mt-1 text-sm">Berikut adalah ringkasan aktivitas sidang Anda hari ini.</p>
        </div>
        <div class="hidden sm:flex space-x-3">
            <button class="px-4 py-2 bg-white dark:bg-slate-900 hover:bg-slate-50 dark:hover:bg-gray-800 border border-slate-200 dark:border-gray-700 text-sm font-medium rounded-xl text-slate-600 dark:text-gray-300 transition-colors shadow-sm">
                Unduh Laporan
            </button>
            <button class="px-4 py-2 bg-blue-600 dark:bg-[#2188FF] hover:bg-blue-700 dark:hover:bg-blue-600 text-sm font-medium rounded-xl text-white transition-colors shadow-lg shadow-blue-500/20 flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>Jadwal Baru</span>
            </button>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
        <!-- Stat 1 -->
        <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-200 dark:border-gray-800 shadow-sm dark:shadow-xl relative overflow-hidden group transition-colors">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                <svg class="w-16 h-16 text-blue-600 dark:text-[#2188FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <div class="relative z-10">
                <p class="text-sm font-medium text-slate-500 dark:text-gray-400 uppercase tracking-wider">Total Sidang</p>
                <div class="mt-2 flex items-baseline space-x-2">
                    <p class="text-4xl font-bold text-slate-900 dark:text-white">24</p>
                    <span class="text-sm font-medium text-emerald-600 dark:text-emerald-400 flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                        12%
                    </span>
                </div>
            </div>
        </div>

        <!-- Stat 2 -->
        <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-200 dark:border-gray-800 shadow-sm dark:shadow-xl relative overflow-hidden group transition-colors">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                <svg class="w-16 h-16 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138z"/></svg>
            </div>
            <div class="relative z-10">
                <p class="text-sm font-medium text-slate-500 dark:text-gray-400 uppercase tracking-wider">Menunggu Nilai</p>
                <div class="mt-2 flex items-baseline space-x-2">
                    <p class="text-4xl font-bold text-slate-900 dark:text-white">5</p>
                    <span class="text-sm font-medium text-red-600 dark:text-red-400 flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Segera
                    </span>
                </div>
            </div>
        </div>

        <!-- Stat 3 -->
        <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-200 dark:border-gray-800 shadow-sm dark:shadow-xl relative overflow-hidden group transition-colors">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                <svg class="w-16 h-16 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
            <div class="relative z-10">
                <p class="text-sm font-medium text-slate-500 dark:text-gray-400 uppercase tracking-wider">Mahasiswa Bimbingan</p>
                <div class="mt-2 flex items-baseline space-x-2">
                    <p class="text-4xl font-bold text-slate-900 dark:text-white">12</p>
                </div>
            </div>
        </div>

        <!-- Stat 4 -->
        <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-200 dark:border-gray-800 shadow-sm dark:shadow-xl relative overflow-hidden group transition-colors">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                <svg class="w-16 h-16 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
            <div class="relative z-10">
                <p class="text-sm font-medium text-slate-500 dark:text-gray-400 uppercase tracking-wider">Estimasi Honor</p>
                <div class="mt-2 flex items-baseline space-x-2">
                    <p class="text-3xl font-bold text-slate-900 dark:text-white">Rp 1.2M</p>
                    <span class="text-xs text-slate-400 dark:text-gray-500">Bulan Ini</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Upcoming Schedule -->
        <div class="lg:col-span-2 bg-white dark:bg-slate-900 border border-slate-200 dark:border-gray-800 rounded-2xl shadow-sm dark:shadow-xl transition-colors">
            <div class="p-6 border-b border-slate-200 dark:border-gray-800 flex justify-between items-center">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Jadwal Sidang Mendatang</h3>
                <a href="#" class="text-sm text-blue-600 dark:text-[#2188FF] hover:text-blue-700 dark:hover:text-blue-400 font-medium">Lihat Semua</a>
            </div>
            <div class="p-0">
                <ul class="divide-y divide-slate-100 dark:divide-gray-800/50">
                    <li class="p-6 hover:bg-slate-50 dark:hover:bg-gray-800/20 transition-colors">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-blue-50 dark:bg-blue-500/10 rounded-xl border border-blue-100 dark:border-blue-500/20 flex flex-col items-center justify-center">
                                    <span class="text-xs text-blue-600 dark:text-blue-400 font-bold">25</span>
                                    <span class="text-[10px] text-slate-400 dark:text-gray-400 uppercase">Okt</span>
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-slate-900 dark:text-white">Ahmad Fauzi</h4>
                                    <p class="text-xs text-slate-500 dark:text-gray-400 mt-1">Implementasi AI pada Sistem Akademik</p>
                                    <div class="flex items-center mt-2 space-x-3 text-xs text-slate-400 dark:text-gray-500">
                                        <span class="flex items-center"><svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> 09:00 - 10:30 WIB</span>
                                        <span class="flex items-center"><svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg> Ruang R.2.4</span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="px-3 py-1 rounded-full text-xs font-medium bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-100 dark:border-emerald-500/20">Terkonfirmasi</span>
                            </div>
                        </div>
                    </li>
                    <li class="p-6 hover:bg-slate-50 dark:hover:bg-gray-800/20 transition-colors">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-slate-100 dark:bg-gray-800 rounded-xl border border-slate-200 dark:border-gray-700 flex flex-col items-center justify-center">
                                    <span class="text-xs text-slate-600 dark:text-white font-bold">28</span>
                                    <span class="text-[10px] text-slate-400 dark:text-gray-400 uppercase">Okt</span>
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-slate-900 dark:text-white">Budi Santoso</h4>
                                    <p class="text-xs text-slate-500 dark:text-gray-400 mt-1">Analisis Jaringan Saraf Tiruan</p>
                                    <div class="flex items-center mt-2 space-x-3 text-xs text-slate-400 dark:text-gray-500">
                                        <span class="flex items-center"><svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> 13:00 - 14:30 WIB</span>
                                        <span class="flex items-center"><svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg> Zoom Meeting</span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="px-3 py-1 rounded-full text-xs font-medium bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-100 dark:border-amber-500/20">Menunggu</span>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-gray-800 rounded-2xl shadow-sm dark:shadow-xl overflow-hidden flex flex-col transition-colors">
            <div class="p-6 border-b border-slate-200 dark:border-gray-800">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Aktivitas Terkini</h3>
            </div>
            <div class="p-6 flex-1 overflow-y-auto">
                <div class="relative pl-4 border-l border-slate-200 dark:border-gray-800 space-y-6">
                    <div class="relative">
                        <div class="absolute -left-[21px] w-2 h-2 bg-blue-600 dark:bg-[#2188FF] rounded-full ring-4 ring-white dark:ring-slate-900"></div>
                        <p class="text-sm text-slate-900 dark:text-white font-medium">Nilai Sidang Disubmit</p>
                        <p class="text-xs text-slate-500 dark:text-gray-400 mt-1">Anda memberikan nilai A untuk Ahmad Fauzi.</p>
                        <p class="text-[10px] text-slate-400 dark:text-gray-500 mt-2">2 Jam yang lalu</p>
                    </div>
                    <div class="relative">
                        <div class="absolute -left-[21px] w-2 h-2 bg-purple-500 rounded-full ring-4 ring-white dark:ring-slate-900"></div>
                        <p class="text-sm text-slate-900 dark:text-white font-medium">Jadwal Sidang Rilis</p>
                        <p class="text-xs text-slate-500 dark:text-gray-400 mt-1">Admin merilis jadwal untuk periode Oktober.</p>
                        <p class="text-[10px] text-slate-400 dark:text-gray-500 mt-2">Kemarin, 14:30</p>
                    </div>
                    <div class="relative">
                        <div class="absolute -left-[21px] w-2 h-2 bg-slate-400 dark:bg-gray-600 rounded-full ring-4 ring-white dark:ring-slate-900"></div>
                        <p class="text-sm text-slate-900 dark:text-white font-medium">Revisi Skripsi</p>
                        <p class="text-xs text-slate-500 dark:text-gray-400 mt-1">Budi Santoso mengunggah revisi dokumen BAB 4.</p>
                        <p class="text-[10px] text-slate-400 dark:text-gray-500 mt-2">2 Hari yang lalu</p>
                    </div>
                </div>
            </div>
            <div class="p-4 border-t border-slate-200 dark:border-gray-800 bg-slate-50 dark:bg-[#0D1117]/50 text-center">
                <button class="text-xs font-medium text-slate-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-white transition-colors">Muat Lebih Banyak</button>
            </div>
        </div>
    </div>
</div>
@endsection
