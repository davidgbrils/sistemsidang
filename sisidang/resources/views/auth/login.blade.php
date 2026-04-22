<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-300">Alamat Email</label>
            <input id="email" class="block mt-2 w-full bg-[#131623] border border-gray-700 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-[#2188FF] focus:ring-[#2188FF] transition-colors" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Masukkan email anda..." />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-300">Kata Sandi</label>
            <input id="password" class="block mt-2 w-full bg-[#131623] border border-gray-700 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-[#2188FF] focus:ring-[#2188FF] transition-colors" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded bg-[#131623] border-gray-700 text-[#2188FF] shadow-sm focus:ring-[#2188FF]" name="remember">
                <span class="ms-2 text-sm text-gray-400">Ingat Saya</span>
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
