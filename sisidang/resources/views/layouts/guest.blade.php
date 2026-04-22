<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SiSidang') }} - Masuk</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-200 antialiased bg-[#07080D] selection:bg-[#2188FF] selection:text-white">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden">
            <!-- Background Glow -->
            <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -z-10 w-[600px] h-[600px] bg-blue-500/10 blur-[120px] rounded-full"></div>

            <div class="mb-8 text-center">
                <a href="/" class="inline-flex items-center space-x-3 group">
                    <div class="w-12 h-12 bg-[#2188FF] rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/20 group-hover:scale-105 transition-transform">
                        <span class="text-white font-bold text-2xl">S</span>
                    </div>
                    <span class="text-3xl font-bold tracking-tight text-white group-hover:text-gray-300 transition-colors">SiSidang<span class="text-[#2188FF]">.</span></span>
                </a>
                <p class="mt-3 text-gray-400 text-sm">Masuk untuk mengelola jadwal dan nilai sidang.</p>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-8 py-10 bg-[#0D1117]/80 backdrop-blur-xl border border-gray-800 shadow-2xl sm:rounded-3xl relative z-10">
                {{ $slot }}
            </div>
            
            <div class="mt-8 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} Universitas. Hak Cipta Dilindungi.
            </div>
        </div>
    </body>
</html>
