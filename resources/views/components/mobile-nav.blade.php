@props(['active' => ''])

@php
    $user = auth()->user();
    $isAdmin = $user && $user->isAdmin();
@endphp

<nav class="md:hidden fixed bottom-0 left-0 right-0 bg-white/90 backdrop-blur-md border-t-0 shadow-[0_-2px_10px_rgba(0,0,0,0.05)] h-16 flex items-center justify-around z-50">
    @if($isAdmin)
        <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center {{ $active === 'dashboard' ? 'text-blue-600' : 'text-slate-400' }}">
            <span class="material-symbols-outlined">dashboard</span>
            <span class="text-[10px] font-bold">Beranda</span>
        </a>
        <a href="{{ route('admin.aspirasi.index') }}" class="flex flex-col items-center {{ $active === 'manage' ? 'text-blue-600' : 'text-slate-400' }}">
            <span class="material-symbols-outlined">settings_suggest</span>
            <span class="text-[10px] font-bold">Kelola</span>
        </a>
    @else
        <a href="{{ route('student.dashboard') }}" class="flex flex-col items-center {{ $active === 'dashboard' ? 'text-blue-600' : 'text-slate-400' }}">
            <span class="material-symbols-outlined">dashboard</span>
            <span class="text-[10px] font-bold">Beranda</span>
        </a>
        <a href="{{ route('aspirasi.index') }}" class="flex flex-col items-center {{ $active === 'my-aspirations' ? 'text-blue-600' : 'text-slate-400' }}">
            <span class="material-symbols-outlined">list_alt</span>
            <span class="text-[10px] font-bold">Daftar Saya</span>
        </a>
        <a href="{{ route('aspirasi.create') }}" class="flex flex-col items-center">
            <div class="bg-blue-600 -mt-10 h-12 w-12 rounded-full flex items-center justify-center shadow-lg shadow-blue-500/40 text-white">
                <span class="material-symbols-outlined">add</span>
            </div>
        </a>
        <a href="{{ route('aspirasi.index') }}" class="flex flex-col items-center text-slate-400">
            <span class="material-symbols-outlined">analytics</span>
            <span class="text-[10px] font-bold">Statistik</span>
        </a>
        <a href="#" class="flex flex-col items-center text-slate-400">
            <span class="material-symbols-outlined">settings</span>
            <span class="text-[10px] font-bold">Menu</span>
        </a>
    @endif
</nav>
