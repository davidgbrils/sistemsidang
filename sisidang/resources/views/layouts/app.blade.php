<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SiSidang') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

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
<body class="font-sans antialiased text-slate-700 dark:text-slate-200 bg-slate-50 dark:bg-slate-950 transition-colors duration-300" 
    x-data="{ 
        sidebarOpen: true, 
        mobileMenuOpen: false, 
        dark: localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches), 
        toggleTheme() { 
            this.dark = !this.dark; 
            localStorage.setItem('theme', this.dark ? 'dark' : 'light'); 
            if (this.dark) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        } 
    }">
    <div class="relative flex h-screen overflow-hidden">
        <div
            x-show="mobileMenuOpen"
            x-transition.opacity
            @click="mobileMenuOpen = false"
            class="fixed inset-0 z-30 bg-slate-900/40 backdrop-blur-sm md:hidden"
        ></div>
        
        <!-- Sidebar -->
        <aside 
            :class="[
                sidebarOpen ? 'md:w-64' : 'md:w-20',
                mobileMenuOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'
            ]" 
            class="fixed inset-y-0 left-0 z-40 flex w-72 md:static md:inset-auto md:w-64 flex-col bg-white dark:bg-slate-900 border-r border-slate-200 dark:border-slate-800 shadow-sm transition-all duration-300 ease-in-out"
        >
            <!-- Logo -->
            <div class="flex items-center h-16 px-6 border-b border-slate-200 dark:border-slate-800">
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center shadow-sm">
                        <span class="text-white font-bold">S</span>
                    </div>
                    <h1 x-show="sidebarOpen" x-transition class="text-xl font-bold tracking-tight text-slate-900 dark:text-white">
                        SiSidang<span class="text-indigo-600 dark:text-indigo-400">.</span>
                    </h1>
                </div>
                <!-- Theme Toggle in Sidebar -->
                <button @click="toggleTheme" class="p-2 ml-auto text-slate-500 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-white transition-colors border border-slate-200 dark:border-slate-700 rounded-lg shadow-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/40 active:scale-[0.98]">
                    <template x-if="dark">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M16.243 17.657l.707.707M7.657 6.343l.707-.707m12.728 0l-.707.707M6.343 6.343l.707.707m12.728 12.728l-.707-.707M6.343 17.657l.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z"/></svg>
                    </template>
                    <template x-if="!dark">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                    </template>
                </button>
                <button @click="mobileMenuOpen = false" class="p-2 ml-2 text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-white transition-colors rounded-lg md:hidden focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/40">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 overflow-y-auto py-6 space-y-1">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}" class="group flex items-center rounded-lg px-6 py-3 text-sm font-medium transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/40 active:scale-[0.99] {{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-500/15 dark:text-indigo-300 border-l-4 border-indigo-600 dark:border-indigo-400' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800/60' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span x-show="sidebarOpen" class="ml-3">Dashboard</span>
                </a>

                <!-- Jadwal Sidang -->
                <a href="{{ route('jadwal.index') }}" class="group flex items-center rounded-lg px-6 py-3 text-sm font-medium transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/40 active:scale-[0.99] {{ request()->routeIs('jadwal.*') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-500/15 dark:text-indigo-300 border-l-4 border-indigo-600 dark:border-indigo-400' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800/60' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span x-show="sidebarOpen" class="ml-3">Jadwal Sidang</span>
                </a>

                <!-- Input Nilai -->
                <a href="{{ route('nilai.index') }}" class="group flex items-center rounded-lg px-6 py-3 text-sm font-medium transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/40 active:scale-[0.99] {{ request()->routeIs('nilai.*') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-500/15 dark:text-indigo-300 border-l-4 border-indigo-600 dark:border-indigo-400' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800/60' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <span x-show="sidebarOpen" class="ml-3">Input Nilai</span>
                </a>

                <!-- Formulir -->
                <a href="{{ route('formulir.index') }}" class="group flex items-center rounded-lg px-6 py-3 text-sm font-medium transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/40 active:scale-[0.99] {{ request()->routeIs('formulir.*') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-500/15 dark:text-indigo-300 border-l-4 border-indigo-600 dark:border-indigo-400' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800/60' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                    <span x-show="sidebarOpen" class="ml-3">Formulir</span>
                </a>

                <!-- Ganti Penguji -->
                <a href="{{ route('penguji.ganti') }}" class="group flex items-center rounded-lg px-6 py-3 text-sm font-medium transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/40 active:scale-[0.99] {{ request()->routeIs('penguji.*') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-500/15 dark:text-indigo-300 border-l-4 border-indigo-600 dark:border-indigo-400' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800/60' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                    <span x-show="sidebarOpen" class="ml-3">Ganti Penguji</span>
                </a>

                @role('admin|kaprodi|staff_ften')
                <!-- Data Mahasiswa -->
                <a href="{{ route('mahasiswa.index') }}" class="group flex items-center rounded-lg px-6 py-3 text-sm font-medium transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/40 active:scale-[0.99] {{ request()->routeIs('mahasiswa.*') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-500/15 dark:text-indigo-300 border-l-4 border-indigo-600 dark:border-indigo-400' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800/60' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    <span x-show="sidebarOpen" class="ml-3">Data Mahasiswa</span>
                </a>

                <!-- Import Excel -->
                <a href="{{ route('import.excel') }}" class="group flex items-center rounded-lg px-6 py-3 text-sm font-medium transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/40 active:scale-[0.99] {{ request()->routeIs('import.*') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-500/15 dark:text-indigo-300 border-l-4 border-indigo-600 dark:border-indigo-400' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800/60' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                    <span x-show="sidebarOpen" class="ml-3">Import Excel</span>
                </a>
                @endrole

                @role('admin|kaprodi|staff_ften')
                <!-- Rekap Honor -->
                <a href="{{ route('honor.rekap') }}" class="group flex items-center rounded-lg px-6 py-3 text-sm font-medium transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/40 active:scale-[0.99] {{ request()->routeIs('honor.*') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-500/15 dark:text-indigo-300 border-l-4 border-indigo-600 dark:border-indigo-400' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800/60' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    <span x-show="sidebarOpen" class="ml-3">Rekap Honor</span>
                </a>
                @endrole

                @role('admin')
                <div class="pt-4 mt-4 border-t border-slate-200 dark:border-slate-800">
                    <p class="px-6 text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-2">Administrasi</p>
                    <a href="{{ route('users.index') }}" class="group flex items-center rounded-lg px-6 py-3 text-sm font-medium transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/40 active:scale-[0.99] {{ request()->routeIs('users.*') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-500/15 dark:text-indigo-300 border-l-4 border-indigo-600 dark:border-indigo-400' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800/60' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        <span x-show="sidebarOpen" class="ml-3">Manajemen User</span>
                    </a>
                </div>
                @endrole

                <div class="pt-6 mt-6 border-t border-slate-200 dark:border-slate-800">
                    <!-- Notifikasi -->
                    <a href="{{ route('notifications') }}" class="group flex items-center rounded-lg px-6 py-3 text-sm font-medium transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/40 active:scale-[0.99] {{ request()->routeIs('notifications') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-500/15 dark:text-indigo-300 border-l-4 border-indigo-600 dark:border-indigo-400' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800/60' }}">
                        <div class="relative">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                            <span class="absolute -top-1 -right-1 flex h-3 w-3">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                            </span>
                        </div>
                        <span x-show="sidebarOpen" class="ml-3">Notifikasi</span>
                    </a>

                    <!-- Settings -->
                    <a href="{{ route('settings') }}" class="group flex items-center rounded-lg px-6 py-3 text-sm font-medium transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/40 active:scale-[0.99] {{ request()->routeIs('settings') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-500/15 dark:text-indigo-300 border-l-4 border-indigo-600 dark:border-indigo-400' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800/60' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span x-show="sidebarOpen" class="ml-3">Settings</span>
                    </a>
                </div>
            </nav>

            <!-- User Card -->
            <div class="p-4 border-t border-slate-200 dark:border-slate-800">
                <div class="flex items-center p-2.5 bg-slate-100 dark:bg-slate-800/50 rounded-xl shadow-sm">
                    <div class="flex-shrink-0 w-10 h-10 bg-indigo-600/10 dark:bg-indigo-500/20 rounded-lg flex items-center justify-center text-indigo-600 dark:text-indigo-300 font-semibold border border-indigo-600/20 dark:border-indigo-400/30">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    </div>
                    <div x-show="sidebarOpen" x-transition class="ml-3 overflow-hidden">
                        <p class="text-sm font-medium text-slate-900 dark:text-white truncate">{{ Auth::user()->name }}</p>
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-indigo-600/10 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-300 uppercase tracking-wider">
                            {{ Auth::user()->getRoleNames()->first() ?? 'User' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Collapse Toggle -->
            <button @click="sidebarOpen = !sidebarOpen" class="absolute bottom-20 -right-4 hidden md:flex w-8 h-8 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-full items-center justify-center text-slate-400 hover:text-indigo-600 dark:hover:text-white transition-all shadow-md z-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/40">
                <svg :class="sidebarOpen ? 'rotate-0' : 'rotate-180'" class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/></svg>
            </button>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col min-w-0 bg-slate-50 dark:bg-slate-950">
            <!-- Header -->
            <header class="h-16 flex items-center justify-between px-4 sm:px-6 border-b border-slate-200 dark:border-slate-800 bg-white/80 dark:bg-slate-900/50 backdrop-blur-md shadow-sm sticky top-0 z-20">
                <!-- Breadcrumb -->
                <div class="flex items-center gap-2 sm:gap-4">
                    <button @click="mobileMenuOpen = true" class="md:hidden p-2 rounded-lg border border-slate-200 dark:border-slate-700 text-slate-500 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/40 active:scale-[0.98]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <nav class="flex text-sm font-medium text-slate-400 dark:text-slate-400">
                    <ol class="flex items-center space-x-2">
                        <li><a href="#" class="hover:text-indigo-600 dark:hover:text-indigo-300 transition-colors">SiSidang</a></li>
                        <li class="flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            <span class="text-slate-900 dark:text-white">{{ ucfirst(request()->path()) }}</span>
                        </li>
                    </ol>
                    </nav>
                </div>

                <!-- Top Right Actions -->
                <div class="flex items-center space-x-2 sm:space-x-4">
                    <!-- Theme Toggle -->
                    <button @click="toggleTheme" class="p-2 text-slate-500 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-white transition-colors rounded-lg focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/40 active:scale-[0.98]">
                        <template x-if="dark">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M16.243 17.657l.707.707M7.657 6.343l.707-.707m12.728 0l-.707.707M6.343 6.343l.707.707m12.728 12.728l-.707-.707M6.343 17.657l.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z"/></svg>
                        </template>
                        <template x-if="!dark">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                        </template>
                    </button>

                    <button class="p-2 text-slate-500 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-white transition-colors rounded-lg focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/40 active:scale-[0.98] relative">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full border-2 border-white dark:border-slate-900"></span>
                    </button>

                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-2 p-1 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/40 active:scale-[0.99]">
                            <div class="w-8 h-8 bg-indigo-600/10 dark:bg-slate-700 rounded-lg flex items-center justify-center text-sm font-medium text-indigo-600 dark:text-white border border-indigo-600/20 dark:border-slate-600">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <svg class="w-4 h-4 text-slate-400 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl shadow-md py-2 z-50">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-indigo-600 dark:hover:text-indigo-300">Profil Saya</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-slate-50 dark:hover:bg-slate-800">Keluar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content Area -->
            <div class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
                @yield('content')
            </div>
        </main>
    </div>

    @stack('scripts')
</body>
</html>
