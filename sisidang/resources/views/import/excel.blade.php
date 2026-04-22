@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-white">Import Data Excel</h2>
            <p class="text-gray-400 mt-1 text-sm">Import data dari file Excel.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach(['mahasiswa', 'dosen', 'jadwal'] as $type)
        <div class="bg-[#131623] border border-gray-800 rounded-2xl shadow-xl p-6">
            <h3 class="text-lg font-bold text-white mb-2 capitalize">{{ ucfirst($type) }}</h3>
            <p class="text-gray-400 text-sm mb-4">Import data {{ strtolower($type) }} dari Excel.</p>
            
            <div class="space-y-3">
                <a href="{{ route('import.template', $type) }}" class="block text-center px-4 py-2 bg-[#131623] hover:bg-gray-800 border border-gray-700 text-sm font-medium rounded-xl text-gray-300 transition-colors">
                    Download Template
                </a>
                
                <form action="{{ route('import.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                    @csrf
                    <input type="hidden" name="type" value="{{ $type }}">
                    <input type="file" name="file" accept=".xlsx,.xls" class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-medium file:bg-[#2188FF] file:text-white hover:file:bg-blue-600">
                    <button type="submit" class="w-full px-4 py-2 bg-[#2188FF] hover:bg-blue-600 text-sm font-medium rounded-xl text-white transition-colors">
                        Import
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection