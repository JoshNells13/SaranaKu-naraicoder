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

<aside class="hidden md:flex flex-col h-screen bg-slate-50 p-4 gap-2 shrink-0 border-r border-slate-200 transition-all duration-300 ease-in-out"
       :class="sidebarOpen ? 'w-[260px]' : 'w-[72px]'"
       @mouseenter="sidebarOpen = true"
       @mouseleave="sidebarOpen = false">
    
    <div class="flex items-center py-6 mb-2 transition-all duration-300" :class="sidebarOpen ? 'px-4 gap-3' : 'justify-center px-0 gap-0'">
        <div class="w-10 h-10 bg-primary-container rounded-xl flex items-center justify-center text-white shrink-0">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">school</span>
        </div>
        <div x-show="sidebarOpen"
             x-transition:enter="transition-all duration-200 ease-out delay-70"
             x-transition:enter-start="opacity-0 translate-x-[-10px]"
             x-transition:enter-end="opacity-100 translate-x-0"
             x-transition:leave="transition-all duration-100 ease-in"
             x-transition:leave-start="opacity-100 translate-x-0"
             x-transition:leave-end="opacity-0 translate-x-[-10px]">
            <h2 class="text-lg font-black text-slate-900 font-headline leading-tight whitespace-nowrap">SaranaKu</h2>
        </div>
    </div>

    <nav class="flex-1 flex flex-col gap-1">
        @foreach($items as $item)
            <x-sidebar-item :href="route($item['route'])" :icon="$item['icon']" :label="$item['label']"
                :active="$active === $item['key']" :badge="$item['badge'] ?? 0" />
        @endforeach
    </nav>

    <div class="mt-auto pt-4 border-t border-slate-200 flex flex-col gap-3">
        {{-- Profile Info --}}
        @if($user)
            <div class="flex items-center transition-all duration-300" :class="sidebarOpen ? 'px-4 gap-3' : 'justify-center px-0 gap-0'">
                <div class="h-9 w-9 rounded-full overflow-hidden border border-outline-variant bg-primary-fixed flex items-center justify-center shrink-0">
                    @if($user->avatar)
                        <img alt="User profile" class="h-full w-full object-cover" src="{{ asset('storage/' . $user->avatar) }}" />
                    @else
                        <span class="text-xs font-bold text-primary">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                    @endif
                </div>
                <div x-show="sidebarOpen"
                     x-transition:enter="transition-all duration-200 ease-out delay-70"
                     x-transition:enter-start="opacity-0 translate-x-[-10px]"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition-all duration-100 ease-in"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 translate-x-[-10px]"
                     class="min-w-0 flex-1">
                    <p class="text-xs font-bold text-slate-900 truncate leading-tight">{{ $user->name }}</p>
                    <p class="text-[9px] text-slate-500 font-semibold uppercase tracking-wider truncate mt-0.5">{{ $isAdmin ? 'Admin' : ($isAtasan ? 'Atasan' : 'Siswa') }}</p>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full flex items-center text-slate-600 hover:bg-slate-200 rounded-lg py-2.5 font-manrope font-semibold text-sm transition-all duration-300 ease-in-out"
                :class="sidebarOpen ? 'px-4 gap-3 justify-start' : 'px-0 gap-0 justify-center'">
                <span class="material-symbols-outlined text-[20px] shrink-0">logout</span>
                <span x-show="sidebarOpen"
                      x-transition:enter="transition-all duration-200 ease-out delay-70"
                      x-transition:enter-start="opacity-0 translate-x-[-10px]"
                      x-transition:enter-end="opacity-100 translate-x-0"
                      x-transition:leave="transition-all duration-100 ease-in"
                      x-transition:leave-start="opacity-100 translate-x-0"
                      x-transition:leave-end="opacity-0 translate-x-[-10px]"
                      class="whitespace-nowrap">
                    Keluar
                </span>
            </button>
        </form>
    </div>
</aside>