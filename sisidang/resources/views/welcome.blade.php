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
