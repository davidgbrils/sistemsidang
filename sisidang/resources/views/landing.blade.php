<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SiSidang') }} - Landing</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-700 antialiased">
    <div class="relative overflow-hidden">
        <div class="absolute inset-x-0 top-0 -z-10 h-[28rem] bg-gradient-to-b from-indigo-100/60 to-transparent"></div>
        <div class="absolute left-1/2 top-24 -z-10 h-80 w-80 -translate-x-1/2 rounded-full bg-indigo-400/20 blur-3xl"></div>

        <header class="mx-auto flex w-full max-w-7xl items-center justify-between px-4 py-5 sm:px-6 lg:px-8">
            <a href="{{ route('landing') }}" class="inline-flex items-center gap-3">
                <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-600 text-sm font-bold text-white shadow-sm">S</span>
                <span class="text-lg font-semibold tracking-tight text-slate-900">SiSidang</span>
            </a>
            <div class="flex items-center gap-2">
                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-600 shadow-sm transition hover:bg-slate-50 hover:text-slate-900 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/40">
                        Masuk
                    </a>
                @endif
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/40">
                        Daftar
                    </a>
                @endif
            </div>
        </header>

        <main class="mx-auto grid w-full max-w-7xl items-center gap-10 px-4 pb-16 pt-10 sm:px-6 lg:grid-cols-2 lg:px-8 lg:pb-20 lg:pt-16">
            <section>
                <span class="inline-flex items-center rounded-full border border-indigo-100 bg-indigo-50 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-indigo-700">
                    Sistem Informasi Sidang
                </span>
                <h1 class="mt-5 text-3xl font-bold leading-tight text-slate-900 sm:text-4xl lg:text-5xl">
                    Kelola sidang lebih rapi, cepat, dan terstruktur.
                </h1>
                <p class="mt-4 max-w-xl text-sm leading-relaxed text-slate-600 sm:text-base">
                    Satu platform untuk penjadwalan, penguji, formulir, nilai, dan rekap administrasi sidang. Dirancang untuk admin, kaprodi, dosen, dan mahasiswa.
                </p>
                <div class="mt-8 flex flex-wrap items-center gap-3">
                    <a href="{{ route('login') }}" class="rounded-lg bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/40">
                        Masuk ke Sistem
                    </a>
                    <a href="{{ route('login') }}" class="rounded-lg border border-slate-200 bg-white px-5 py-3 text-sm font-medium text-slate-700 shadow-sm transition hover:bg-slate-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/40">
                        Lihat Dashboard
                    </a>
                </div>
            </section>

            <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-md sm:p-6">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <article class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Jadwal</p>
                        <p class="mt-2 text-2xl font-bold text-slate-900">Terpusat</p>
                        <p class="mt-1 text-sm text-slate-600">Susun jadwal sidang dengan alur persetujuan yang jelas.</p>
                    </article>
                    <article class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Penilaian</p>
                        <p class="mt-2 text-2xl font-bold text-slate-900">Terukur</p>
                        <p class="mt-1 text-sm text-slate-600">Input nilai dosen, rekap otomatis, dan dokumentasi rapi.</p>
                    </article>
                    <article class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Formulir</p>
                        <p class="mt-2 text-2xl font-bold text-slate-900">Digital</p>
                        <p class="mt-1 text-sm text-slate-600">Akses form sidang, revisi, dan arsip secara terintegrasi.</p>
                    </article>
                    <article class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Peran</p>
                        <p class="mt-2 text-2xl font-bold text-slate-900">Terkontrol</p>
                        <p class="mt-1 text-sm text-slate-600">Hak akses sesuai peran: admin, kaprodi, dosen, mahasiswa.</p>
                    </article>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
