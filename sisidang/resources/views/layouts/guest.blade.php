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
        <script>
            if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark')
            } else {
                document.documentElement.classList.remove('dark')
            }
        </script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-700 dark:text-gray-200 antialiased bg-slate-50 dark:bg-slate-950 selection:bg-blue-600 dark:selection:bg-[#2188FF] selection:text-white transition-colors duration-300">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden">
            <!-- Background Glow -->
            <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -z-10 w-[600px] h-[600px] bg-blue-600/5 dark:bg-blue-500/10 blur-[120px] rounded-full"></div>

            <div class="mb-8 text-center">
                <a href="/" class="inline-flex items-center space-x-3 group">
                    <div class="w-12 h-12 bg-blue-600 dark:bg-[#2188FF] rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/20 group-hover:scale-105 transition-transform">
                        <span class="text-white font-bold text-2xl">S</span>
                    </div>
                    <span class="text-3xl font-bold tracking-tight text-slate-900 dark:text-white group-hover:text-slate-700 dark:group-hover:text-gray-300 transition-colors">SiSidang<span class="text-blue-600 dark:text-[#2188FF]">.</span></span>
                </a>
                <p class="mt-3 text-slate-500 dark:text-gray-400 text-sm">Masuk untuk mengelola jadwal dan nilai sidang.</p>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-8 py-10 bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border border-slate-200 dark:border-slate-800 shadow-2xl sm:rounded-3xl relative z-10">
                {{ $slot }}
            </div>
            
            <div class="mt-8 text-center text-sm text-slate-400 dark:text-gray-500">
                &copy; {{ date('Y') }} Universitas. Hak Cipta Dilindungi.
            </div>
        </div>
    </body>
</html>
