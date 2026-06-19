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
                        "on-background": "#191c1e",
                        "surface": "#f7f9fb",
                        "background": "#f7f9fb",
                        "primary-fixed": "#d8e2ff",
                        "surface-container-high": "#e6e8ea",
                        "outline": "#727785",
                        "on-secondary": "#ffffff",
                        "outline-variant": "#c2c6d6",
                        "on-error": "#ffffff",
                        "on-primary": "#ffffff",
                        "tertiary-container": "#b75b00",
                        "primary": "#0058be",
                        "primary-container": "#2170e4",
                        "secondary-container": "#b6ccff",
                        "on-secondary-fixed-variant": "#304671",
                        "tertiary-fixed": "#ffdcc6",
                        "primary-fixed-dim": "#adc6ff",
                        "surface-dim": "#d8dadc",
                        "surface-variant": "#e0e3e5",
                        "tertiary-fixed-dim": "#ffb786",
                        "on-secondary-container": "#405682",
                        "on-secondary-fixed": "#001a42",
                        "error": "#ba1a1a",
                        "inverse-on-surface": "#eff1f3",
                        "on-surface-variant": "#424754",
                        "secondary": "#495e8a",
                        "surface-container": "#eceef0",
                        "secondary-fixed-dim": "#b1c6f9",
                        "on-tertiary-fixed": "#311400",
                        "on-primary-fixed-variant": "#004395",
                        "surface-container-lowest": "#ffffff",
                        "on-primary-fixed": "#001a42",
                        "inverse-surface": "#2d3133",
                        "surface-bright": "#f7f9fb",
                        "on-tertiary-fixed-variant": "#723600",
                        "on-error-container": "#93000a",
                        "surface-tint": "#005ac2",
                        "on-tertiary-container": "#fffbff",
                        "tertiary": "#924700",
                        "surface-container-highest": "#e0e3e5",
                        "inverse-primary": "#adc6ff",
                        "surface-container-low": "#f2f4f6",
                        "on-tertiary": "#ffffff",
                        "error-container": "#ffdad6",
                        "on-surface": "#191c1e",
                        "on-primary-container": "#fefcff",
                        "secondary-fixed": "#d8e2ff"
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
            .editorial-gradient { background: linear-gradient(135deg, #0058be 0%, #2170e4 100%); }
            .soft-elevation { box-shadow: 0px 32px 64px -12px rgba(25, 28, 31, 0.04); }
            .glass-effect { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(24px); }
            .editorial-shadow { box-shadow: 0 32px 64px -12px rgba(0, 88, 190, 0.04); }
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