<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Alamat Email')" class="dark:text-gray-300" />
            <x-text-input id="email" class="block mt-2 w-full px-4 py-3 rounded-xl transition-colors border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 focus:border-blue-500 dark:focus:border-[#2188FF] focus:ring-blue-500 dark:focus:ring-[#2188FF]" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Masukkan email anda..." />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Kata Sandi')" class="dark:text-gray-300" />
            <x-text-input id="password" class="block mt-2 w-full px-4 py-3 rounded-xl transition-colors border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 focus:border-blue-500 dark:focus:border-[#2188FF] focus:ring-blue-500 dark:focus:ring-[#2188FF]" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded bg-white dark:bg-slate-900 border-slate-300 dark:border-slate-700 text-blue-600 dark:text-[#2188FF] shadow-sm focus:ring-blue-500 dark:focus:ring-[#2188FF]" name="remember">
                <span class="ms-2 text-sm text-slate-600 dark:text-gray-400">Ingat Saya</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-[#2188FF] hover:text-blue-400 font-medium transition-colors" href="{{ route('password.request') }}">
                    Lupa sandi?
                </a>
            @endif
        </div>

        <button type="submit" class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg shadow-blue-500/20 text-sm font-bold text-white bg-[#2188FF] hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#2188FF] focus:ring-offset-[#0D1117] transition-all">
            Masuk Sekarang
        </button>
    </form>
</x-guest-layout>
