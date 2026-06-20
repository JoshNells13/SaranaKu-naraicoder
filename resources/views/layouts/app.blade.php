<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>@yield('title', 'SaranaKu - Portal Aspirasi')</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface font-body text-on-surface min-h-screen flex overflow-hidden">
    {{-- Sidebar --}}
    <x-sidebar :active="$active ?? ''" />

    {{-- Main Content --}}
    <main class="flex-1 flex flex-col h-screen overflow-y-auto relative">
        {{-- Top Navbar --}}
        <x-navbar />

        {{-- Page Content --}}
        <div class="pt-24 pb-24 md:pb-12 px-6 md:px-10 max-w-7xl mx-auto w-full flex-1">
            @if(session('success'))
                <div class="mb-6 bg-emerald-50 text-emerald-700 px-4 py-3 rounded-xl text-sm font-semibold flex items-center gap-2" x-data="{ show: true }" x-show="show" x-transition>
                    <span class="material-symbols-outlined text-lg">check_circle</span>
                    {{ session('success') }}
                    <button @click="show = false" class="ml-auto"><span class="material-symbols-outlined text-sm">close</span></button>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-50 text-red-700 px-4 py-3 rounded-xl text-sm font-semibold flex items-center gap-2" x-data="{ show: true }" x-show="show" x-transition>
                    <span class="material-symbols-outlined text-lg">error</span>
                    {{ session('error') }}
                    <button @click="show = false" class="ml-auto"><span class="material-symbols-outlined text-sm">close</span></button>
                </div>
            @endif

            @yield('content')
        </div>

        {{-- Footer --}}
        <x-footer />
    </main>

    {{-- Mobile Bottom Nav --}}
    <x-mobile-nav :active="$active ?? ''" />

    @stack('scripts')
</body>
</html>
