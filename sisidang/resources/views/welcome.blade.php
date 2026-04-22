<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SiSidang - Sistem Manajemen Sidang Skripsi</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-[#07080D] text-gray-200 selection:bg-[#2188FF] selection:text-white">
    <div class="relative min-h-screen flex flex-col">
        <!-- Background Glow -->
        <div class="absolute top-0 right-0 -z-10 w-[500px] h-[500px] bg-blue-500/10 blur-[120px] rounded-full"></div>
        <div class="absolute bottom-0 left-0 -z-10 w-[500px] h-[500px] bg-indigo-500/10 blur-[120px] rounded-full"></div>

        <!-- Navbar -->
        <nav class="flex items-center justify-between px-8 py-6 max-w-7xl mx-auto w-full">
            <div class="flex items-center space-x-2">
                <div class="w-10 h-10 bg-[#2188FF] rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/20">
                    <span class="text-white font-bold text-xl">S</span>
                </div>
                <span class="text-2xl font-bold tracking-tight text-white">SiSidang<span class="text-[#2188FF]">.</span></span>
            </div>
            
            <div class="flex items-center space-x-6">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-semibold hover:text-[#2188FF] transition-colors">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold hover:text-[#2188FF] transition-colors">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-5 py-2.5 bg-[#2188FF] hover:bg-blue-600 text-white rounded-xl text-sm font-semibold transition-all shadow-lg shadow-blue-500/20">Daftar Sekarang</a>
                        @endif
                    @endauth
                @endif
            </div>
        </nav>

        <!-- Hero Section -->
        <main class="flex-1 flex flex-col items-center justify-center px-6 text-center max-w-5xl mx-auto">
            <div class="inline-flex items-center px-3 py-1 rounded-full bg-blue-500/10 border border-blue-500/20 text-[#2188FF] text-xs font-bold uppercase tracking-wider mb-8">
                Sistem Informasi Sidang Universitas
            </div>
            
            <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 leading-tight">
                Kelola Sidang Skripsi <br/>
                <span class="bg-gradient-to-r from-[#2188FF] to-indigo-400 bg-clip-text text-transparent">Lebih Cepat & Efisien</span>
            </h1>
            
            <p class="text-lg text-gray-400 mb-10 max-w-2xl mx-auto">
                Platform terintegrasi untuk pendaftaran, penjadwalan, penilaian, hingga rekapitulasi honor dosen. Semua dalam satu dashboard profesional.
            </p>

            <div class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-4 bg-[#2188FF] hover:bg-blue-600 text-white rounded-2xl font-bold transition-all shadow-xl shadow-blue-500/30 flex items-center justify-center">
                    Mulai Sekarang
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </a>
                <a href="#features" class="w-full sm:w-auto px-8 py-4 bg-gray-800/50 hover:bg-gray-800 border border-gray-700 text-white rounded-2xl font-bold transition-all">
                    Lihat Fitur
                </a>
            </div>

            <!-- Features Section -->
        <section id="features" class="py-20 w-full max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Fitur Utama</h2>
                <p class="text-gray-400 max-w-2xl mx-auto">Semua yang Anda butuhkan untuk mengelola sidang skripsi dalam satu platform.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Feature 1 -->
                <div class="p-6 bg-[#131623] rounded-2xl border border-gray-800 hover:border-[#2188FF]/50 transition-colors">
                    <div class="w-12 h-12 bg-[#2188FF]/10 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-[#2188FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Jadwal Sidang</h3>
                    <p class="text-gray-400 text-sm">Kelola jadwal sidang dengan mudah. Atur tanggal, waktu, ruang, dan penguji dalam satu halaman.</p>
                </div>

                <!-- Feature 2 -->
                <div class="p-6 bg-[#131623] rounded-2xl border border-gray-800 hover:border-[#2188FF]/50 transition-colors">
                    <div class="w-12 h-12 bg-[#2188FF]/10 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-[#2188FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Input Nilai</h3>
                    <p class="text-gray-400 text-sm">Dosen penguji dapat langsung input nilai dan keterangan setelah sidang selesai.</p>
                </div>

                <!-- Feature 3 -->
                <div class="p-6 bg-[#131623] rounded-2xl border border-gray-800 hover:border-[#2188FF]/50 transition-colors">
                    <div class="w-12 h-12 bg-[#2188FF]/10 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-[#2188FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Formulir Digital</h3>
                    <p class="text-gray-400 text-sm">Kelola formulir absensi, rekap, dan revisi secara digital dalam satu tempat.</p>
                </div>

                <!-- Feature 4 -->
                <div class="p-6 bg-[#131623] rounded-2xl border border-gray-800 hover:border-[#2188FF]/50 transition-colors">
                    <div class="w-12 h-12 bg-[#2188FF]/10 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-[#2188FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Ganti Penguji</h3>
                    <p class="text-gray-400 text-sm">Ajukan penggantian penguji dengan mudah dan proses persetujuan yang cepat.</p>
                </div>

                <!-- Feature 5 -->
                <div class="p-6 bg-[#131623] rounded-2xl border border-gray-800 hover:border-[#2188FF]/50 transition-colors">
                    <div class="w-12 h-12 bg-[#2188FF]/10 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-[#2188FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Rekap Honor</h3>
                    <p class="text-gray-400 text-sm">Hitung honor penguji dan pembimbing secara otomatis per periode.</p>
                </div>

                <!-- Feature 6 -->
                <div class="p-6 bg-[#131623] rounded-2xl border border-gray-800 hover:border-[#2188FF]/50 transition-colors">
                    <div class="w-12 h-12 bg-[#2188FF]/10 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-[#2188FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Import Excel</h3>
                    <p class="text-gray-400 text-sm">Import data mahasiswa, dosen, dan jadwal dengan mudah dari file Excel.</p>
                </div>
            </div>
        </section>

        <!-- Stats Placeholder -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mt-20 w-full">
                <div class="p-6 bg-[#131623] rounded-3xl border border-gray-800 shadow-xl">
                    <p class="text-3xl font-bold text-[#2188FF]">500+</p>
                    <p class="text-sm text-gray-500 uppercase tracking-widest mt-1">Sidang/Tahun</p>
                </div>
                <div class="p-6 bg-[#131623] rounded-3xl border border-gray-800 shadow-xl">
                    <p class="text-3xl font-bold text-[#2188FF]">100+</p>
                    <p class="text-sm text-gray-500 uppercase tracking-widest mt-1">Dosen Penguji</p>
                </div>
                <div class="p-6 bg-[#131623] rounded-3xl border border-gray-800 shadow-xl">
                    <p class="text-3xl font-bold text-[#2188FF]">100%</p>
                    <p class="text-sm text-gray-500 uppercase tracking-widest mt-1">Digital Rekap</p>
                </div>
                <div class="p-6 bg-[#131623] rounded-3xl border border-gray-800 shadow-xl">
                    <p class="text-3xl font-bold text-[#2188FF]">Realtime</p>
                    <p class="text-sm text-gray-500 uppercase tracking-widest mt-1">Notification</p>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="py-10 text-center text-gray-500 text-sm border-t border-gray-900 mt-20">
            &copy; {{ date('Y') }} SiSidang Universitas. Dibuat untuk Efisiensi Akademik.
        </footer>
    </div>
</body>
</html>
