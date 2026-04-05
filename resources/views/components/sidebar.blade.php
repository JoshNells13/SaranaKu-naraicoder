@props(['active' => ''])

@php
    $user = auth()->user();
    $isAdmin = $user && $user->isAdmin();

    $studentItems = [
        ['route' => 'student.dashboard', 'icon' => 'dashboard', 'label' => 'Dasbor', 'key' => 'dashboard'],
        ['route' => 'aspirasi.create', 'icon' => 'add_circle', 'label' => 'Ajukan Aspirasi', 'key' => 'submit'],
        ['route' => 'aspirasi.index', 'icon' => 'list_alt', 'label' => 'Aspirasi Saya', 'key' => 'my-aspirations'],
    ];

    $adminItems = [
        ['route' => 'admin.dashboard', 'icon' => 'dashboard', 'label' => 'Dasbor', 'key' => 'dashboard'],
        ['route' => 'admin.aspirasi.index', 'icon' => 'settings_suggest', 'label' => 'Kelola Konten', 'key' => 'manage'],
    ];

    $items = $isAdmin ? $adminItems : $studentItems;
@endphp

<aside class="hidden md:flex flex-col h-screen w-64 bg-slate-50 p-4 gap-2 shrink-0">
    <div class="flex items-center gap-3 px-4 py-6 mb-2">
        <div class="w-10 h-10 bg-primary-container rounded-xl flex items-center justify-center text-white">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">school</span>
        </div>
        <div>
            <h2 class="text-lg font-black text-slate-900 font-headline leading-tight">SaranaKu</h2>
            <p class="text-[10px] uppercase tracking-widest text-slate-500 font-bold">Aspiration Portal v1.0</p>
        </div>
    </div>

    <nav class="flex-1 flex flex-col gap-1">
        @foreach($items as $item)
            <x-sidebar-item
                :href="route($item['route'])"
                :icon="$item['icon']"
                :label="$item['label']"
                :active="$active === $item['key']"
            />
        @endforeach
    </nav>

    <div class="mt-auto pt-4 border-t border-slate-200">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 text-slate-600 hover:bg-slate-200 rounded-lg px-4 py-2.5 font-manrope font-semibold text-sm transition-all duration-200 ease-in-out">
                <span class="material-symbols-outlined text-[20px]">logout</span>
                Keluar
            </button>
        </form>
    </div>
</aside>
