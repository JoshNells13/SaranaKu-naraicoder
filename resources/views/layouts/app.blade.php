<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>@yield('title', 'SaranaKu - Portal Aspirasi')</title>
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "on-background": "#18181b",
                        "surface": "#f4f4f5",
                        "background": "#f4f4f5",
                        "primary-fixed": "#e4e4e7",
                        "surface-container-high": "#e4e4e7",
                        "outline": "#71717a",
                        "on-secondary": "#ffffff",
                        "outline-variant": "#d4d4d8",
                        "on-error": "#ffffff",
                        "on-primary": "#ffffff",
                        "tertiary-container": "#27272a",
                        "primary": "#000000",
                        "primary-container": "#09090b",
                        "secondary-container": "#f4f4f5",
                        "on-secondary-fixed-variant": "#27272a",
                        "tertiary-fixed": "#f4f4f5",
                        "primary-fixed-dim": "#d4d4d8",
                        "surface-dim": "#e4e4e7",
                        "surface-variant": "#e4e4e7",
                        "tertiary-fixed-dim": "#e4e4e7",
                        "on-secondary-container": "#18181b",
                        "on-secondary-fixed": "#18181b",
                        "error": "#ba1a1a",
                        "inverse-on-surface": "#f4f4f5",
                        "on-surface-variant": "#52525b",
                        "secondary": "#27272a",
                        "surface-container": "#f4f4f5",
                        "secondary-fixed-dim": "#d4d4d8",
                        "on-tertiary-fixed": "#18181b",
                        "on-primary-fixed-variant": "#27272a",
                        "surface-container-lowest": "#ffffff",
                        "on-primary-fixed": "#18181b",
                        "inverse-surface": "#27272a",
                        "surface-bright": "#f4f4f5",
                        "on-tertiary-fixed-variant": "#27272a",
                        "on-error-container": "#93000a",
                        "surface-tint": "#000000",
                        "on-tertiary-container": "#18181b",
                        "tertiary": "#52525b",
                        "surface-container-highest": "#e4e4e7",
                        "inverse-primary": "#27272a",
                        "surface-container-low": "#fafafa",
                        "on-tertiary": "#ffffff",
                        "error-container": "#ffdad6",
                        "on-surface": "#18181b",
                        "on-primary-container": "#ffffff",
                        "secondary-fixed": "#e4e4e7"
                    },
                    borderRadius: {
                        DEFAULT: "0.25rem",
                        lg: "0.5rem",
                        xl: "0.75rem",
                        full: "9999px"
                    },
                    fontFamily: {
                        headline: ["Manrope", "sans-serif"],
                        body: ["Inter", "sans-serif"],
                        label: ["Inter", "sans-serif"],
                        manrope: ["Manrope", "sans-serif"],
                        inter: ["Inter", "sans-serif"]
                    }
                }
            }
        };
    </script>
    <style type="text/tailwindcss">
        @layer base {
            body { font-family: 'Inter', sans-serif; }
            h1, h2, h3, h4 { font-family: 'Manrope', sans-serif; }
        }
        @layer components {
            .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
            .editorial-gradient { background: linear-gradient(135deg, #000000 0%, #262626 100%); }
            .soft-elevation { box-shadow: 0px 32px 64px -12px rgba(25, 28, 31, 0.04); }
            .glass-effect { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(24px); }
            .editorial-shadow { box-shadow: 0 32px 64px -12px rgba(0, 0, 0, 0.04); }
            .paper-shadow { box-shadow: 0 4px 32px 0 rgba(25, 28, 30, 0.04); }
            .no-scrollbar::-webkit-scrollbar { display: none; }
            .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        }
    </style>
    @vite(['resources/js/app.js'])
</head>
<body class="bg-surface font-body text-on-surface min-h-screen flex overflow-hidden" x-data="{ sidebarOpen: false }">
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
