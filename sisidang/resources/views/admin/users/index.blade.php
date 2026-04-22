@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Manajemen User & Peran</h2>
            <p class="text-slate-500 dark:text-gray-400 mt-1 text-sm">Kelola peran dan hak akses user dalam sistem.</p>
        </div>
    </div>

    @if (session('status'))
        <div class="bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-100 dark:border-emerald-500/20 text-emerald-600 dark:text-emerald-400 px-4 py-3 rounded-xl text-sm font-medium">
            {{ session('status') }}
        </div>
    @endif

    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50 dark:bg-slate-950/50 border-b border-slate-200 dark:border-slate-800">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-gray-400 uppercase tracking-wider">User</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-gray-400 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-gray-400 uppercase tracking-wider">Peran Saat Ini</th>
                        <th class="px-6 py-4 text-right text-xs font-medium text-slate-500 dark:text-gray-400 uppercase tracking-wider">Ubah Peran</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800/50">
                    @foreach($users as $user)
                    <tr class="hover:bg-slate-50 dark:hover:bg-gray-800/20 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-blue-600/10 dark:bg-gray-700 rounded-lg flex items-center justify-center text-sm font-medium text-blue-600 dark:text-white border border-blue-600/20 dark:border-gray-600">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <span class="ml-3 text-sm font-medium text-slate-900 dark:text-white">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm text-slate-500 dark:text-gray-400">{{ $user->email }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 rounded-full text-xs font-medium border bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 border-blue-100 dark:border-blue-500/20 uppercase tracking-wider">
                                {{ $user->getRoleNames()->first() ?? 'Tidak ada peran' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right whitespace-nowrap">
                            <form action="{{ route('users.update-role', $user) }}" method="POST" class="inline-flex items-center space-x-2">
                                @csrf
                                @method('PATCH')
                                <x-select-input name="role" class="text-xs px-2 py-1 h-8 rounded-lg w-32" onchange="this.form.submit()">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                            {{ ucfirst($role->name) }}
                                        </option>
                                    @endforeach
                                </x-select-input>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/50">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
