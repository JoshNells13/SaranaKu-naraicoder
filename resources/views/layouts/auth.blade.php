<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>@yield('title', 'SaranaKu - Masuk')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />
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
        }
    </style>
    @vite(['resources/js/app.js'])
</head>

<body class="bg-surface font-body text-on-surface min-h-screen flex items-center justify-center p-4 md:p-8">
    @yield('content')
    <div class="fixed bottom-6 left-1/2 -translate-x-1/2 text-center pointer-events-none">
        <p class="text-xs text-outline font-medium tracking-wide">
            © {{ date('Y') }} Aspirasi SaranaKu. Hak cipta dilindungi undang-undang.
        </p>
    </div>
</body>

</html>