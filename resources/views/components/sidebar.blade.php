@props(['active' => ''])

@php
    $user = auth()->user();
    $isAdmin = $user && $user->isAdmin();
    $isAtasan = $user && $user->isAtasan();

    $studentItems = [
        ['route' => 'student.dashboard', 'icon' => 'dashboard', 'label' => 'Dasbor', 'key' => 'dashboard'],
        ['route' => 'notifikasi.index', 'icon' => 'notifications', 'label' => 'Notifikasi', 'key' => 'notifikasi', 'badge' => $user ? $user->notifikasi()->unread()->count() : 0],
        ['route' => 'aspirasi.create', 'icon' => 'add_circle', 'label' => 'Ajukan Aspirasi', 'key' => 'submit'],
        ['route' => 'aspirasi.index', 'icon' => 'list_alt', 'label' => 'Aspirasi Saya', 'key' => 'my-aspirations'],
        ['route' => 'aspirasi.semua', 'icon' => 'public', 'label' => 'Semua Aspirasi', 'key' => 'all-aspirations'],
    ];

    $adminItems = [
        ['route' => 'admin.dashboard', 'icon' => 'dashboard', 'label' => 'Dasbor', 'key' => 'dashboard'],
        ['route' => 'admin.aspirasi.index', 'icon' => 'settings_suggest', 'label' => 'Kelola Konten', 'key' => 'manage'],
    ];

    $atasanItems = [
        ['route' => 'atasan.dashboard', 'icon' => 'dashboard', 'label' => 'Dasbor', 'key' => 'dashboard'],
        ['route' => 'atasan.aspirasi.index', 'icon' => 'approval', 'label' => 'Persetujuan Aspirasi', 'key' => 'approval'],
    ];

    if ($isAdmin) {
        $items = $adminItems;
    } elseif ($isAtasan) {
        $items = $atasanItems;
    } else {
        $items = $studentItems;
    }
@endphp

<aside class="hidden md:flex flex-col h-[calc(100vh-2rem)] w-64 bg-surface rounded-3xl my-4 ml-4 shadow-sm border border-surface-container-low gap-2 shrink-0 overflow-hidden relative">
    <!-- Subtle gradient background at top of sidebar -->
    <div class="absolute top-0 inset-x-0 h-32 bg-gradient-to-b from-primary/5 to-transparent pointer-events-none"></div>

    <div class="flex items-center gap-3 px-6 py-8 mb-2 relative z-10">
        <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center text-white shadow-lg shadow-primary/30">
            <span class="material-symbols-outlined font-black">campaign</span>
        </div>
        <div>
            <h2 class="text-xl font-black text-on-surface font-headline tracking-tight">SaranaKu</h2>
        </div>
    </div>

    <nav class="flex-1 flex flex-col gap-1 px-4 relative z-10 overflow-y-auto no-scrollbar">
        @foreach($items as $item)
            <x-sidebar-item :href="route($item['route'])" :icon="$item['icon']" :label="$item['label']"
                :active="$active === $item['key']" :badge="$item['badge'] ?? 0" />
        @endforeach
    </nav>

    <div class="mt-auto p-4 border-t border-surface-container-low relative z-10 bg-surface">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full flex items-center gap-3 text-on-surface-variant hover:bg-surface-container-low hover:text-on-surface rounded-xl px-4 py-3 font-semibold text-sm transition-all duration-200">
                <span class="material-symbols-outlined text-[20px]">logout</span>
                Keluar
            </button>
        </form>
    </div>
</aside>