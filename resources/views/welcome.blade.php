<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SaranaKu | Platform Aspirasi Siswa</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800,900" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface text-on-surface font-sans antialiased min-h-screen flex flex-col selection:bg-primary selection:text-white">

    <!-- Navigation -->
    <nav class="fixed w-full z-50 bg-surface/80 backdrop-blur-md border-b border-surface-container transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center gap-3">
                    <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center text-white shadow-lg shadow-primary/30">
                        <span class="material-symbols-outlined font-black">campaign</span>
                    </div>
                    <span class="font-headline font-black text-2xl tracking-tight text-on-surface">Sarana<span class="text-primary">Ku</span></span>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center gap-4">
                    @auth
                        <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : (auth()->user()->role === 'atasan' ? route('atasan.dashboard') : route('student.dashboard')) }}" 
                           class="bg-primary text-white px-6 py-2.5 rounded-xl font-bold text-sm hover:brightness-110 active:scale-95 transition-all shadow-md shadow-primary/20">
                            Ke Dasbor
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-on-surface-variant hover:text-primary font-bold px-4 py-2 text-sm transition-colors">
                            Masuk
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-primary text-white px-6 py-2.5 rounded-xl font-bold text-sm hover:brightness-110 active:scale-95 transition-all shadow-md shadow-primary/20">
                                Daftar Sekarang
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="flex-grow flex flex-col justify-center relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <!-- Background Decorations -->
        <div class="absolute top-0 right-0 -translate-y-12 translate-x-1/3 w-[800px] h-[800px] bg-primary/5 rounded-full blur-3xl -z-10 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 translate-y-1/3 -translate-x-1/3 w-[600px] h-[600px] bg-blue-400/5 rounded-full blur-3xl -z-10 pointer-events-none"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full text-center">
            
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-surface-container-low border border-surface-container text-sm font-semibold text-primary mb-8 shadow-sm">
                <span class="material-symbols-outlined text-[18px]">verified</span>
                Platform Resmi Pengaduan & Aspirasi Siswa
            </div>
            
            <h1 class="font-headline font-black text-5xl md:text-7xl tracking-tighter text-on-surface mb-8 leading-tight max-w-4xl mx-auto">
                Suaramu Membangun <br class="hidden md:block" />
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-blue-500">Sekolah Kita</span>
            </h1>
            
            <p class="text-lg md:text-xl text-on-surface-variant max-w-2xl mx-auto leading-relaxed mb-12 font-medium">
                SaranaKu memberikan ruang aman bagi seluruh siswa untuk menyampaikan gagasan, pengaduan, dan aspirasi demi mewujudkan lingkungan belajar yang lebih baik.
            </p>
            
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                @auth
                    <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : (auth()->user()->role === 'atasan' ? route('atasan.dashboard') : route('student.dashboard')) }}" 
                       class="w-full sm:w-auto bg-primary text-white px-8 py-4 rounded-xl font-bold text-lg hover:brightness-110 active:scale-95 transition-all shadow-xl shadow-primary/30 flex items-center justify-center gap-2 group">
                        Mulai Sekarang
                        <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </a>
                @else
                    <a href="{{ route('register') }}" 
                       class="w-full sm:w-auto bg-primary text-white px-8 py-4 rounded-xl font-bold text-lg hover:brightness-110 active:scale-95 transition-all shadow-xl shadow-primary/30 flex items-center justify-center gap-2 group">
                        Buat Akun Baru
                        <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </a>
                    <a href="{{ route('login') }}" 
                       class="w-full sm:w-auto bg-surface-container text-on-surface px-8 py-4 rounded-xl font-bold text-lg hover:bg-surface-container-high active:scale-95 transition-all flex items-center justify-center">
                        Sudah Punya Akun
                    </a>
                @endauth
            </div>
        </div>
    </main>

    <!-- Features Section -->
    <section class="py-24 bg-surface-container-lowest border-t border-surface-container">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="font-headline font-black text-3xl md:text-4xl text-on-surface mb-4">Fitur Utama SaranaKu</h2>
                <p class="text-on-surface-variant text-lg">Dirancang khusus untuk memudahkan siswa dalam beraspirasi.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-surface p-8 rounded-3xl border border-surface-container shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                    <div class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center text-primary mb-6">
                        <span class="material-symbols-outlined text-3xl">shield_person</span>
                    </div>
                    <h3 class="font-headline font-black text-xl mb-3">Aman & Rahasia</h3>
                    <p class="text-on-surface-variant leading-relaxed">
                        Pilihan pengajuan anonim memastikan identitas Anda terlindungi. Sampaikan keluhan tanpa rasa khawatir.
                    </p>
                </div>
                
                <!-- Feature 2 -->
                <div class="bg-surface p-8 rounded-3xl border border-surface-container shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                    <div class="w-14 h-14 bg-blue-500/10 rounded-2xl flex items-center justify-center text-blue-500 mb-6">
                        <span class="material-symbols-outlined text-3xl">track_changes</span>
                    </div>
                    <h3 class="font-headline font-black text-xl mb-3">Lacak Status</h3>
                    <p class="text-on-surface-variant leading-relaxed">
                        Pantau terus perkembangan aspirasi Anda dari status pending, diproses, hingga selesai ditangani.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-surface p-8 rounded-3xl border border-surface-container shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                    <div class="w-14 h-14 bg-green-500/10 rounded-2xl flex items-center justify-center text-green-500 mb-6">
                        <span class="material-symbols-outlined text-3xl">forum</span>
                    </div>
                    <h3 class="font-headline font-black text-xl mb-3">Diskusi Terbuka</h3>
                    <p class="text-on-surface-variant leading-relaxed">
                        Beri dukungan, saling bertukar pendapat, dan diskusi pada aspirasi bersama seluruh siswa lainnya.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-surface-container-lowest py-12 border-t border-surface-container text-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-center items-center gap-2 mb-6 opacity-50">
                <span class="material-symbols-outlined font-black">campaign</span>
                <span class="font-headline font-black text-xl tracking-tight">SaranaKu</span>
            </div>
            <p class="text-on-surface-variant text-sm">
                &copy; {{ date('Y') }} SaranaKu. Membangun sekolah yang lebih baik bersama.
            </p>
        </div>
    </footer>

</body>
</html>
