<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SaranaKu | Platform Manajemen & Aspirasi Sarana Sekolah</title>

    <!-- Fonts (Manrope & Inter) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Manrope:wght@500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @keyframes marquee {
            0% {
                transform: translateX(0%);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .animate-marquee {
            display: flex;
            width: max-content;
            animation: marquee 25s linear infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-12px);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        /* Custom scrollbar for light layout */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #ffffff;
        }

        ::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #cbd5e1;
        }
    </style>
</head>

<body
    class="bg-white text-black font-sans antialiased min-h-screen flex flex-col selection:bg-black/10 selection:text-black overflow-x-hidden">

    <!-- Navigation -->
    <nav class="fixed w-full z-50 bg-white/85 backdrop-blur-md border-b border-neutral-200 transition-all"
        x-data="{ mobileMenuOpen: false }">
        <div class="max-w-7xl mx-auto px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center gap-3">
                    <div class="w-10 h-10 bg-black rounded-xl flex items-center justify-center text-white shadow-md">
                        <span class="material-symbols-outlined font-black text-xl">campaign</span>
                    </div>
                    <div class="flex flex-col">
                        <span
                            class="font-headline font-black text-xl tracking-tight leading-none text-black">Sarana<span
                                class="text-neutral-500">Ku</span></span>
                    </div>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center gap-8">
                    <a href="#features"
                        class="text-sm font-semibold text-neutral-500 hover:text-black transition-colors">Fitur
                        Utama</a>
                    <a href="#trending"
                        class="text-sm font-semibold text-neutral-500 hover:text-black transition-colors">Katalog
                        Laporan</a>
                    <a href="#testimonials"
                        class="text-sm font-semibold text-neutral-500 hover:text-black transition-colors">Testimoni</a>
                    <a href="#faq"
                        class="text-sm font-semibold text-neutral-500 hover:text-black transition-colors">FAQ</a>

                    <div class="h-4 w-[1px] bg-neutral-200"></div>

                    @auth
                        <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : (auth()->user()->role === 'atasan' ? route('atasan.dashboard') : route('student.dashboard')) }}"
                            class="bg-black hover:bg-neutral-800 text-white px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wide transition-all active:scale-95 shadow-md flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[16px]">dashboard</span>
                            Ke Dasbor
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-neutral-500 hover:text-black font-bold text-xs uppercase px-3 py-2 transition-colors">
                            Masuk
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="bg-black hover:bg-neutral-800 text-white px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wide transition-all active:scale-95 shadow-md shadow-black/5">
                                Daftar Baru
                            </a>
                        @endif
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen"
                        class="text-neutral-500 hover:text-black p-2 focus:outline-none">
                        <span class="material-symbols-outlined text-[26px]"
                            x-text="mobileMenuOpen ? 'close' : 'menu'">menu</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer -->
        <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-4"
            class="md:hidden bg-white/95 border-b border-neutral-200 px-8 py-4 space-y-3">
            <a href="#features" @click="mobileMenuOpen = false"
                class="block text-base font-semibold text-neutral-500 hover:text-black py-2">Fitur Utama</a>
            <a href="#trending" @click="mobileMenuOpen = false"
                class="block text-base font-semibold text-neutral-500 hover:text-black py-2">Katalog Laporan</a>
            <a href="#testimonials" @click="mobileMenuOpen = false"
                class="block text-base font-semibold text-neutral-500 hover:text-black py-2">Testimoni</a>
            <a href="#faq" @click="mobileMenuOpen = false"
                class="block text-base font-semibold text-neutral-500 hover:text-black py-2">FAQ</a>
            <div class="border-t border-neutral-200 my-2"></div>
            @auth
                <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : (auth()->user()->role === 'atasan' ? route('atasan.dashboard') : route('student.dashboard')) }}"
                    class="w-full bg-black text-white py-2.5 rounded-lg font-bold text-xs uppercase text-center flex items-center justify-center gap-1.5 shadow-md">
                    <span class="material-symbols-outlined text-[16px]">dashboard</span>
                    Ke Dasbor
                </a>
            @else
                <a href="{{ route('login') }}"
                    class="block text-center font-bold text-xs uppercase py-2 text-neutral-500 hover:text-black">
                    Masuk
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="block w-full bg-black text-white py-2.5 rounded-lg font-bold text-xs uppercase text-center">
                        Daftar Baru
                    </a>
                @endif
            @endauth
        </div>
    </nav>

    <!-- Main Content Wrapper -->
    <div class="relative w-full bg-white min-h-screen pt-20">

        <!-- Hero Section -->
        <section class="relative overflow-hidden py-24 md:py-32 border-b border-neutral-200 z-10">
            <div class="max-w-7xl mx-auto px-8 relative">
                <div class="grid lg:grid-cols-2 gap-16 items-center">
                    <div class="space-y-8 text-left">
                        <div
                            class="inline-flex items-center px-3 py-1 bg-neutral-100 border border-neutral-200 text-neutral-600 text-xs font-bold uppercase tracking-widest rounded-full">
                            ERA BARU MANAJEMEN SARANA
                        </div>
                        <h1 class="text-5xl md:text-7xl font-extrabold tracking-tighter leading-[1.1] text-black">
                            Kuasai Laporan, <br />
                            <span class="text-neutral-500">Fasilitas Nyaman.</span>
                        </h1>
                        <p class="text-lg md:text-xl text-neutral-600 font-body leading-relaxed max-w-xl">
                            SaranaKu adalah platform manajemen sarana & prasarana sekolah terintegrasi. Tanpa birokrasi
                            bertele-tele—hanya sistem pelaporan cepat dan transparan yang menghargai waktu dan
                            kenyamanan belajar Anda.
                        </p>
                        <div class="flex flex-wrap gap-4">
                            @auth
                                <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : (auth()->user()->role === 'atasan' ? route('atasan.dashboard') : route('student.dashboard')) }}"
                                    class="px-8 py-4 bg-black text-white font-bold rounded-xl shadow-lg shadow-black/5 hover:scale-[0.98] transition-all flex items-center gap-2 text-sm">
                                    Buka Dasbor Anda
                                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                                </a>
                            @else
                                <a href="{{ route('register') }}"
                                    class="px-8 py-4 bg-black text-white font-bold rounded-xl shadow-lg shadow-black/5 hover:scale-[0.98] transition-all flex items-center gap-2 text-sm">
                                    Mulai Laporkan Sekarang
                                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                                </a>
                                <a href="{{ route('login') }}"
                                    class="px-8 py-4 bg-neutral-100 border border-neutral-200 text-black font-semibold rounded-xl hover:bg-neutral-200 transition-colors text-sm">
                                    Masuk Ke Akun
                                </a>
                            @endauth
                        </div>
                        <div class="flex items-center gap-4 pt-4">
                            <div class="flex -space-x-3">
                                <div
                                    class="w-10 h-10 rounded-full border-2 border-white bg-neutral-100 flex items-center justify-center text-xs font-bold text-black">
                                    {{ $stats['total'] }}</div>
                                <div
                                    class="w-10 h-10 rounded-full border-2 border-white bg-neutral-100 flex items-center justify-center text-xs font-bold text-neutral-500">
                                    {{ $stats['diproses'] }}</div>
                                <div
                                    class="w-10 h-10 rounded-full border-2 border-white bg-neutral-100 flex items-center justify-center text-xs font-bold text-neutral-400">
                                    {{ $stats['diterima'] }}</div>
                            </div>
                            <span class="text-sm font-medium text-neutral-500">Menghubungkan ratusan aspirasi untuk
                                pemeliharaan sarana secara langsung</span>
                        </div>
                    </div>

                    <div class="relative">
                        <div class="absolute -top-12 -left-12 w-64 h-64 bg-neutral-200/40 rounded-full blur-3xl"></div>
                        <div class="absolute -bottom-12 -right-12 w-64 h-64 bg-neutral-300/40 rounded-full blur-3xl">
                        </div>

                        <!-- Floating Macbook Mockup -->
                        <div class="animate-float relative transition-all duration-500 hover:scale-[1.03]"
                            style="perspective: 1200px;">
                            <!-- Macbook Lid/Display -->
                            <div
                                class="relative z-10 mx-auto w-[92%] aspect-[16/10] bg-[#0d0d0f] rounded-t-2xl p-[3px] border border-neutral-700/50 shadow-[0_25px_50px_-12px_rgba(0,0,0,0.25)] flex flex-col">
                                <!-- Bezel Details & Camera -->
                                <div class="relative w-full h-4 flex items-center justify-center">
                                    <div class="w-1.5 h-1.5 bg-neutral-900 rounded-full border border-neutral-800">
                                    </div>
                                </div>

                                <!-- Screen Display (Simulated Application) -->
                                <div
                                    class="flex-1 bg-white rounded-md overflow-hidden flex flex-col text-left font-sans border border-neutral-800/35 relative select-none">
                                    <!-- Browser Titlebar -->
                                    <div
                                        class="h-8 bg-neutral-100 border-b border-neutral-200 flex items-center px-4 gap-2 shrink-0">
                                        <div class="flex gap-1.5">
                                            <div class="w-2.5 h-2.5 rounded-full bg-red-400"></div>
                                            <div class="w-2.5 h-2.5 rounded-full bg-yellow-400"></div>
                                            <div class="w-2.5 h-2.5 rounded-full bg-green-400"></div>
                                        </div>
                                        <div
                                            class="flex-1 max-w-[280px] mx-auto h-5 bg-white border border-neutral-200 rounded-md flex items-center justify-center text-[10px] text-neutral-400 gap-1 font-mono">
                                            <span
                                                class="material-symbols-outlined text-[10px] text-neutral-400">lock</span>
                                            saranaku.com/aspirasi/create
                                        </div>
                                    </div>

                                    <!-- Typing Simulation App Area -->
                                    <div class="flex-1 p-5 bg-white flex flex-col justify-between"
                                        x-data="{
                                            sentences: [
                                                'Mohon perbaikan pendingin ruangan (AC) di kelas XII IPA 1 karena sering berbunyi bising...',
                                                'Koneksi internet WiFi di area perpustakaan sekolah mohon dipercepat kinerjanya...',
                                                'Proyektor di kelas XI IPS 2 lensa optiknya buram dan mohon dibersihkan atau diganti...',
                                                'Kursi kayu di baris ketiga kelas X-4 sudah patah, mohon segera diganti yang baru...'
                                            ],
                                            currentIndex: 0,
                                            currentText: '',
                                            charIndex: 0,
                                            isDeleting: false,
                                            typingSpeed: 50,
                                            deletingSpeed: 20,
                                            pauseEnd: 3000,
                                            pauseStart: 600,
                                            init() {
                                                this.type();
                                            },
                                            type() {
                                                let currentFull = this.sentences[this.currentIndex];
                                                if (this.isDeleting) {
                                                    this.currentText = currentFull.substring(0, this.charIndex - 1);
                                                    this.charIndex--;
                                                } else {
                                                    this.currentText = currentFull.substring(0, this.charIndex + 1);
                                                    this.charIndex++;
                                                }
                                                let speed = this.isDeleting ? this.deletingSpeed : this.typingSpeed;
                                                if (!this.isDeleting && this.charIndex === currentFull.length) {
                                                    speed = this.pauseEnd;
                                                    this.isDeleting = true;
                                                } else if (this.isDeleting && this.charIndex === 0) {
                                                    this.isDeleting = false;
                                                    this.currentIndex = (this.currentIndex + 1) % this.sentences.length;
                                                    speed = this.pauseStart;
                                                }
                                                setTimeout(() => this.type(), speed);
                                            }
                                        }">
                                        <div>
                                            <!-- Application Title inside mock screen -->
                                            <div
                                                class="flex justify-between items-center mb-4 border-b border-neutral-100 pb-2">
                                                <h4
                                                    class="text-xs font-bold text-black flex items-center gap-1.5 uppercase tracking-wide">
                                                    <span class="material-symbols-outlined text-sm">campaign</span>
                                                    SaranaKu
                                                </h4>
                                                <span
                                                    class="text-[9px] font-bold text-neutral-400 uppercase tracking-widest font-mono">FORM:
                                                    L-04</span>
                                            </div>

                                            <!-- Input Category (Simulated Selection) -->
                                            <div class="space-y-1.5 mb-3">
                                                <span
                                                    class="text-[9px] font-bold text-neutral-500 uppercase tracking-wide">Kategori
                                                    Laporan</span>
                                                <div
                                                    class="w-full bg-neutral-100 border border-neutral-200 text-[10px] text-black font-semibold px-2 py-1.5 rounded flex justify-between items-center">
                                                    <span>Fasilitas & Infrastruktur Kelas</span>
                                                    <span
                                                        class="material-symbols-outlined text-xs">arrow_drop_down</span>
                                                </div>
                                            </div>

                                            <!-- Textarea (Typed Content) -->
                                            <div class="space-y-1.5">
                                                <span
                                                    class="text-[9px] font-bold text-neutral-500 uppercase tracking-wide">Isi
                                                    Detail Laporan</span>
                                                <div
                                                    class="w-full h-24 bg-neutral-50 border border-neutral-200 rounded p-2.5 text-[10px] text-black leading-relaxed font-mono relative overflow-hidden">
                                                    <span x-text="currentText"></span><span
                                                        class="inline-block w-1.5 h-3.5 bg-black ml-0.5 animate-pulse"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Footer / Action bar inside mockup screen -->
                                        <div
                                            class="flex items-center justify-between border-t border-neutral-100 pt-3">
                                            <span
                                                class="text-[8px] font-medium text-neutral-400 flex items-center gap-1">
                                                <span
                                                    class="material-symbols-outlined text-[10px]">visibility_off</span>
                                                Kirim Secara Anonim
                                            </span>
                                            <div
                                                class="px-3.5 py-1.5 bg-black text-white text-[9px] font-bold rounded flex items-center gap-1 shadow-sm">
                                                <span>Kirim Laporan</span>
                                                <span class="material-symbols-outlined text-[10px]">send</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Macbook Keyboard Base / Bottom Chassis (Tilted look) -->
                            <div
                                class="relative w-full h-[18px] bg-neutral-300 rounded-b-xl border-t border-neutral-100 shadow-[0_20px_35px_rgba(0,0,0,0.15)] flex justify-center">
                                <!-- Center Notch -->
                                <div class="absolute top-0 w-24 h-1.5 bg-neutral-800 rounded-b-md"></div>
                                <!-- Drop Shadow projection -->
                                <div
                                    class="absolute -bottom-1 left-4 right-4 h-1 bg-neutral-400/30 blur-[2px] rounded-full">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Facilities Categories Marquee -->
        <div class="py-8 border-y border-neutral-200 overflow-hidden relative w-full z-10 bg-white">
            <div class="absolute inset-y-0 left-0 w-24 bg-gradient-to-r from-white to-transparent z-10"></div>
            <div class="absolute inset-y-0 right-0 w-24 bg-gradient-to-l from-white to-transparent z-10"></div>
            <div class="animate-marquee flex">
                <div class="flex gap-8 pr-8 items-center text-sm font-bold text-neutral-700 font-headline">
                    <div
                        class="flex items-center gap-2 bg-[#f9f9f9] px-5 py-3 rounded-2xl border border-neutral-200 shadow-sm">
                        <span class="material-symbols-outlined text-black text-xl">devices</span> LCD Proyektor</div>
                    <div
                        class="flex items-center gap-2 bg-[#f9f9f9] px-5 py-3 rounded-2xl border border-neutral-200 shadow-sm">
                        <span class="material-symbols-outlined text-black text-xl">ac_unit</span> Air Conditioner (AC)
                    </div>
                    <div
                        class="flex items-center gap-2 bg-[#f9f9f9] px-5 py-3 rounded-2xl border border-neutral-200 shadow-sm">
                        <span class="material-symbols-outlined text-black text-xl">computer</span> Lab Komputer</div>
                    <div
                        class="flex items-center gap-2 bg-[#f9f9f9] px-5 py-3 rounded-2xl border border-neutral-200 shadow-sm">
                        <span class="material-symbols-outlined text-black text-xl">menu_book</span> Perpustakaan</div>
                    <div
                        class="flex items-center gap-2 bg-[#f9f9f9] px-5 py-3 rounded-2xl border border-neutral-200 shadow-sm">
                        <span class="material-symbols-outlined text-black text-xl">sports_soccer</span> Lapangan
                        Olahraga</div>
                    <div
                        class="flex items-center gap-2 bg-[#f9f9f9] px-5 py-3 rounded-2xl border border-neutral-200 shadow-sm">
                        <span class="material-symbols-outlined text-black text-xl">chair</span> Meja & Kursi</div>
                    <div
                        class="flex items-center gap-2 bg-[#f9f9f9] px-5 py-3 rounded-2xl border border-neutral-200 shadow-sm">
                        <span class="material-symbols-outlined text-black text-xl">wifi</span> WiFi Sekolah</div>
                    <div
                        class="flex items-center gap-2 bg-[#f9f9f9] px-5 py-3 rounded-2xl border border-neutral-200 shadow-sm">
                        <span class="material-symbols-outlined text-black text-xl">soup_kitchen</span> Kantin Sehat
                    </div>
                </div>
                <div class="flex gap-8 pr-8 items-center text-sm font-bold text-neutral-700 font-headline"
                    aria-hidden="true">
                    <div
                        class="flex items-center gap-2 bg-[#f9f9f9] px-5 py-3 rounded-2xl border border-neutral-200 shadow-sm">
                        <span class="material-symbols-outlined text-black text-xl">devices</span> LCD Proyektor</div>
                    <div
                        class="flex items-center gap-2 bg-[#f9f9f9] px-5 py-3 rounded-2xl border border-neutral-200 shadow-sm">
                        <span class="material-symbols-outlined text-black text-xl">ac_unit</span> Air Conditioner (AC)
                    </div>
                    <div
                        class="flex items-center gap-2 bg-[#f9f9f9] px-5 py-3 rounded-2xl border border-neutral-200 shadow-sm">
                        <span class="material-symbols-outlined text-black text-xl">computer</span> Lab Komputer</div>
                    <div
                        class="flex items-center gap-2 bg-[#f9f9f9] px-5 py-3 rounded-2xl border border-neutral-200 shadow-sm">
                        <span class="material-symbols-outlined text-black text-xl">menu_book</span> Perpustakaan</div>
                    <div
                        class="flex items-center gap-2 bg-[#f9f9f9] px-5 py-3 rounded-2xl border border-neutral-200 shadow-sm">
                        <span class="material-symbols-outlined text-black text-xl">sports_soccer</span> Lapangan
                        Olahraga</div>
                    <div
                        class="flex items-center gap-2 bg-[#f9f9f9] px-5 py-3 rounded-2xl border border-neutral-200 shadow-sm">
                        <span class="material-symbols-outlined text-black text-xl">chair</span> Meja & Kursi</div>
                    <div
                        class="flex items-center gap-2 bg-[#f9f9f9] px-5 py-3 rounded-2xl border border-neutral-200 shadow-sm">
                        <span class="material-symbols-outlined text-black text-xl">wifi</span> WiFi Sekolah</div>
                    <div
                        class="flex items-center gap-2 bg-[#f9f9f9] px-5 py-3 rounded-2xl border border-neutral-200 shadow-sm">
                        <span class="material-symbols-outlined text-black text-xl">soup_kitchen</span> Kantin Sehat
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Grid -->
        <section class="py-24 relative z-10">
            <div class="max-w-7xl mx-auto px-8">
                <div class="text-center max-w-2xl mx-auto mb-16">
                    <h2 class="text-3xl font-bold tracking-tight mb-4 text-black">Didesain untuk Efisiensi &
                        Transparansi</h2>
                    <p class="text-neutral-600">Kami menghilangkan semua kerumitan birokrasi perbaikan fasilitas.
                        Pelaporan aset kini dapat ditangani secara cepat, langsung, dan terbuka.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                    <!-- Distraction-Free Card -->
                    <div
                        class="md:col-span-8 bg-neutral-50 border border-neutral-200 rounded-2xl p-8 flex flex-col justify-between overflow-hidden relative group text-left">
                        <div class="max-w-md relative z-10">
                            <span class="material-symbols-outlined text-black text-4xl mb-4">edit_note</span>
                            <h3 class="text-2xl font-bold mb-3 text-black">Pelaporan Cepat & Anonim</h3>
                            <p class="text-neutral-600 mb-6">Tulis pengaduan kerusakan sarana dengan mudah, lampirkan
                                bukti fisik, dan pilih opsi sembunyikan nama jika ingin menjaga privasi kenyamanan Anda.
                            </p>
                            @auth
                                <a href="{{ route('aspirasi.create') }}"
                                    class="text-black font-bold flex items-center gap-2 hover:gap-3 transition-all border-b border-black/20 pb-0.5 w-max">
                                    Buat Laporan Sekarang <span
                                        class="material-symbols-outlined text-xs">arrow_forward</span>
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="text-black font-bold flex items-center gap-2 hover:gap-3 transition-all border-b border-black/20 pb-0.5 w-max">
                                    Masuk untuk Melapor <span
                                        class="material-symbols-outlined text-xs">arrow_forward</span>
                                </a>
                            @endauth
                        </div>
                        <!-- Mock UI Decor -->
                        <div
                            class="absolute bottom-0 right-0 w-3/4 h-1/2 bg-white rounded-tl-2xl shadow-2xl border-t border-l border-neutral-200 p-5 translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                            <div class="flex items-center justify-between border-b border-neutral-100 pb-2 mb-3">
                                <div class="flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full bg-black animate-pulse"></span>
                                    <span class="text-xs font-bold text-black">Buat Laporan Baru</span>
                                </div>
                                <span
                                    class="text-[9px] bg-neutral-100 border border-neutral-200 text-neutral-600 px-2 py-0.5 rounded font-black">PRIORITAS
                                    TINGGI</span>
                            </div>
                            <div class="space-y-2">
                                <div class="h-2 w-full bg-neutral-100 rounded"></div>
                                <div class="h-2 w-5/6 bg-neutral-100 rounded"></div>
                            </div>
                            <div class="flex items-center gap-2 mt-4 text-[9px] text-neutral-500 font-semibold">
                                <span class="material-symbols-outlined text-sm">visibility_off</span> Anonimitas Aktif
                            </div>
                        </div>
                    </div>
                    <!-- Performance Card -->
                    <div
                        class="md:col-span-4 bg-black text-white rounded-2xl p-8 flex flex-col justify-between shadow-lg text-left">
                        <div class="space-y-4">
                            <span class="material-symbols-outlined text-4xl text-white">psychology</span>
                            <h3 class="text-2xl font-bold font-headline">Kesehatan Aset Cerdas</h3>
                            <p class="opacity-80 leading-relaxed text-sm text-neutral-300">Sistem kami mendeteksi tren
                                kerusakan dari log pemeliharaan untuk memprediksi jadwal perawatan rutin sebelum aset
                                mengalami kerusakan total.</p>
                        </div>
                        <div class="mt-8 flex items-baseline gap-1">
                            <span class="text-4xl font-extrabold tracking-tight">98%</span>
                            <span class="text-xs font-bold opacity-80 uppercase tracking-wide text-neutral-400">Akurasi
                                Prediksi AI</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured / Trending Aspiration Reports -->
        <section id="trending" class="py-24 relative z-10 border-t border-neutral-200">
            <div class="max-w-7xl mx-auto px-8">
                <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6 text-left">
                    <div class="max-w-xl">
                        <h2 class="text-3xl font-bold tracking-tight mb-4 text-black">Katalog Laporan Terkini</h2>
                        <p class="text-neutral-600">Daftar keluhan fasilitas dan pengaduan terbaru dari siswa dan guru.
                        </p>
                    </div>
                    @auth
                        <a href="{{ route('aspirasi.semua') }}"
                            class="text-black font-bold flex items-center gap-2 hover:gap-3 transition-all border-b border-black/20 pb-1">
                            Lihat Semua Laporan <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-black font-bold flex items-center gap-2 hover:gap-3 transition-all border-b border-black/20 pb-1">
                            Lihat Semua Laporan <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </a>
                    @endauth
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($recentAspirasi as $aspirasi)
                        <div
                            class="bg-[#f9f9f9] z-20 border border-neutral-200 rounded-2xl overflow-hidden group hover:border-neutral-300 transition-all flex flex-col justify-between min-h-[460px]">
                            <div>
                                <div
                                    class="h-48 bg-neutral-200/50 relative overflow-hidden flex items-center justify-center">
                                    @if ($aspirasi->lampiran->first() && $aspirasi->lampiran->first()->path_foto)
                                        <img src="{{ asset('storage/' . $aspirasi->lampiran->first()->path_foto) }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    @else
                                        <div
                                            class="w-full h-full flex items-center justify-center bg-neutral-100 text-black">
                                            <span
                                                class="material-symbols-outlined text-5xl opacity-20">construction</span>
                                        </div>
                                    @endif
                                    <div
                                        class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        @auth
                                            <a href="{{ auth()->user()->role === 'murid' ? route('aspirasi.show', $aspirasi->id) : (auth()->user()->role === 'admin' ? route('admin.aspirasi.index') : route('atasan.aspirasi.show', $aspirasi->id)) }}"
                                                class="px-5 py-2 bg-black text-white text-xs font-bold uppercase rounded-lg shadow-xl tracking-wider">Lihat
                                                Detail</a>
                                        @else
                                            <a href="{{ route('login') }}"
                                                class="px-5 py-2 bg-black text-white text-xs font-bold uppercase rounded-lg shadow-xl tracking-wider">Masuk
                                                Detail</a>
                                        @endauth
                                    </div>
                                </div>
                                <div class="p-8 space-y-4 text-left">
                                    <div class="flex items-center justify-between">
                                        <span
                                            class="text-[9px] font-bold text-black bg-neutral-100 border border-neutral-200 px-2.5 py-1 rounded-md tracking-wider uppercase">
                                            {{ $aspirasi->kategori ? $aspirasi->kategori->nama : 'Sarana' }}
                                        </span>

                                        @if ($aspirasi->status === 'pending')
                                            <span
                                                class="text-[10px] font-bold text-amber-600 bg-amber-50 border border-amber-200 px-2 py-0.5 rounded uppercase tracking-wider">Menunggu</span>
                                        @elseif($aspirasi->status === 'diproses')
                                            <span
                                                class="text-[10px] font-bold text-blue-600 bg-blue-50 border border-blue-200 px-2 py-0.5 rounded uppercase tracking-wider">Diproses</span>
                                        @elseif($aspirasi->status === 'menunggu_persetujuan_atasan')
                                            <span
                                                class="text-[10px] font-bold text-purple-600 bg-purple-50 border border-purple-200 px-2 py-0.5 rounded uppercase tracking-wider">Review</span>
                                        @elseif($aspirasi->status === 'diterima')
                                            <span
                                                class="text-[10px] font-bold text-green-600 bg-green-50 border border-green-200 px-2 py-0.5 rounded uppercase tracking-wider">Selesai</span>
                                        @else
                                            <span
                                                class="text-[10px] font-bold text-red-600 bg-red-50 border border-red-200 px-2 py-0.5 rounded uppercase tracking-wider">Ditolak</span>
                                        @endif
                                    </div>
                                    <h4
                                        class="text-xl font-bold font-headline h-14 line-clamp-2 text-black leading-snug">
                                        {{ $aspirasi->judul }}</h4>

                                    <!-- Votes & Comments Count -->
                                    <div class="flex items-center gap-4 text-xs text-neutral-500 font-semibold">
                                        <span class="flex items-center gap-1">
                                            <span class="material-symbols-outlined text-xs text-black"
                                                style="font-variation-settings: 'FILL' 1;">thumb_up</span>
                                            {{ $aspirasi->votes_count }} Dukungan
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <span class="material-symbols-outlined text-xs text-neutral-400"
                                                style="font-variation-settings: 'FILL' 1;">forum</span>
                                            {{ $aspirasi->comments_count }} Komentar
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="px-8 pb-8 space-y-4">
                                <div
                                    class="text-xs text-neutral-500 flex items-center gap-2 border-t border-neutral-200 pt-4 text-left">
                                    <div
                                        class="w-6 h-6 rounded-full bg-neutral-200 flex items-center justify-center text-neutral-600 text-[10px] font-bold">
                                        {{ $aspirasi->is_anonim ? 'A' : substr($aspirasi->user->name, 0, 1) }}
                                    </div>
                                    <span>Dilaporkan oleh
                                        {{ $aspirasi->is_anonim ? 'Anonim' : $aspirasi->user->name }}</span>
                                </div>
                                @auth
                                    <a href="{{ auth()->user()->role === 'murid' ? route('aspirasi.show', $aspirasi->id) : (auth()->user()->role === 'admin' ? route('admin.aspirasi.index') : route('atasan.aspirasi.show', $aspirasi->id)) }}"
                                        class="w-full py-3.5 bg-black text-white text-xs font-bold rounded-xl hover:bg-neutral-800 transition-all flex items-center justify-center gap-1.5 uppercase tracking-wide">
                                        Pantau Status Perbaikan
                                        <span class="material-symbols-outlined text-xs">visibility</span>
                                    </a>
                                @else
                                    <a href="{{ route('login') }}"
                                        class="w-full py-3.5 border border-neutral-300 text-neutral-600 hover:text-black text-xs font-bold rounded-xl hover:bg-neutral-100 transition-all flex items-center justify-center gap-1.5 uppercase tracking-wide">
                                        Masuk Untuk Dukung
                                    </a>
                                @endauth
                            </div>
                        </div>
                    @empty
                        <!-- Mock data Fallbacks -->
                        <div
                            class="bg-[#f9f9f9] z-20 border border-neutral-200 rounded-2xl overflow-hidden group hover:border-neutral-300 transition-all flex flex-col justify-between min-h-[460px]">
                            <div>
                                <div
                                    class="h-48 bg-neutral-100 relative overflow-hidden flex items-center justify-center">
                                    <span
                                        class="material-symbols-outlined text-5xl text-black opacity-20">ac_unit</span>
                                </div>
                                <div class="p-8 space-y-4 text-left">
                                    <div class="flex items-center justify-between">
                                        <span
                                            class="text-[9px] font-bold text-black bg-neutral-100 border border-neutral-200 px-2.5 py-1 rounded-md tracking-wider uppercase">FASILITAS</span>
                                        <span
                                            class="text-[10px] font-bold text-blue-600 bg-blue-50 border border-blue-200 px-2 py-0.5 rounded uppercase tracking-wider">Diproses</span>
                                    </div>
                                    <h4 class="text-xl font-bold font-headline h-14 line-clamp-2 text-black">AC Ruang
                                        Lab Kimia Mengeluarkan Bau Hangus</h4>
                                    <div class="flex items-center gap-4 text-xs text-neutral-500 font-semibold">
                                        <span class="flex items-center gap-1">
                                            <span class="material-symbols-outlined text-xs text-black">thumb_up</span>
                                            14 Dukungan
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <span
                                                class="material-symbols-outlined text-xs text-neutral-400">forum</span>
                                            4 Komentar
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="px-8 pb-8 space-y-4">
                                <div
                                    class="text-xs text-neutral-500 flex items-center gap-2 border-t border-neutral-200 pt-4 text-left">
                                    <div
                                        class="w-6 h-6 rounded-full bg-neutral-200 flex items-center justify-center text-neutral-600 text-[10px] font-bold">
                                        A</div>
                                    <span>Dilaporkan oleh Anonim (Murid)</span>
                                </div>
                                <a href="{{ route('login') }}"
                                    class="w-full py-3.5 border border-neutral-300 text-neutral-600 hover:text-black text-xs font-bold rounded-xl hover:bg-neutral-100 transition-all flex items-center justify-center gap-1.5 uppercase tracking-wide">Masuk
                                    Untuk Dukung</a>
                            </div>
                        </div>

                        <div
                            class="bg-[#f9f9f9] z-20 border border-neutral-200 rounded-2xl overflow-hidden group hover:border-neutral-300 transition-all flex flex-col justify-between min-h-[460px]">
                            <div>
                                <div
                                    class="h-48 bg-neutral-100 relative overflow-hidden flex items-center justify-center">
                                    <span
                                        class="material-symbols-outlined text-5xl text-black opacity-20">devices</span>
                                </div>
                                <div class="p-8 space-y-4 text-left">
                                    <div class="flex items-center justify-between">
                                        <span
                                            class="text-[9px] font-bold text-black bg-neutral-100 border border-neutral-200 px-2.5 py-1 rounded-md tracking-wider uppercase">ELEKTRONIK</span>
                                        <span
                                            class="text-[10px] font-bold text-amber-600 bg-amber-50 border border-amber-200 px-2 py-0.5 rounded uppercase tracking-wider">Menunggu</span>
                                    </div>
                                    <h4 class="text-xl font-bold font-headline h-14 line-clamp-2 text-black">Lensa
                                        Proyektor Buram di Kelas XI IPS 1</h4>
                                    <div class="flex items-center gap-4 text-xs text-neutral-500 font-semibold">
                                        <span class="flex items-center gap-1">
                                            <span class="material-symbols-outlined text-xs text-black">thumb_up</span>
                                            8 Dukungan
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <span
                                                class="material-symbols-outlined text-xs text-neutral-400">forum</span>
                                            2 Komentar
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="px-8 pb-8 space-y-4">
                                <div
                                    class="text-xs text-neutral-500 flex items-center gap-2 border-t border-neutral-200 pt-4 text-left">
                                    <div
                                        class="w-6 h-6 rounded-full bg-neutral-200 flex items-center justify-center text-neutral-600 text-[10px] font-bold">
                                        R</div>
                                    <span>Dilaporkan oleh Rian Ardiansyah</span>
                                </div>
                                <a href="{{ route('login') }}"
                                    class="w-full py-3.5 border border-neutral-300 text-neutral-600 hover:text-black text-xs font-bold rounded-xl hover:bg-neutral-100 transition-all flex items-center justify-center gap-1.5 uppercase tracking-wide">Masuk
                                    Untuk Dukung</a>
                            </div>
                        </div>

                        <div
                            class="bg-[#f9f9f9] z-20 border border-neutral-200 rounded-2xl overflow-hidden group hover:border-neutral-300 transition-all flex flex-col justify-between min-h-[460px]">
                            <div>
                                <div
                                    class="h-48 bg-neutral-100 relative overflow-hidden flex items-center justify-center">
                                    <span
                                        class="material-symbols-outlined text-5xl text-black opacity-20">sports_soccer</span>
                                </div>
                                <div class="p-8 space-y-4 text-left">
                                    <div class="flex items-center justify-between">
                                        <span
                                            class="text-[9px] font-bold text-black bg-neutral-100 border border-neutral-200 px-2.5 py-1 rounded-md tracking-wider uppercase">LAPANGAN</span>
                                        <span
                                            class="text-[10px] font-bold text-green-600 bg-green-50 border border-green-200 px-2 py-0.5 rounded uppercase tracking-wider">Selesai</span>
                                    </div>
                                    <h4 class="text-xl font-bold font-headline h-14 line-clamp-2 text-black">Perbaikan
                                        Kerusakan Net Lapangan Badminton</h4>
                                    <div class="flex items-center gap-4 text-xs text-neutral-500 font-semibold">
                                        <span class="flex items-center gap-1">
                                            <span class="material-symbols-outlined text-xs text-black">thumb_up</span>
                                            28 Dukungan
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <span
                                                class="material-symbols-outlined text-xs text-neutral-400">forum</span>
                                            9 Komentar
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="px-8 pb-8 space-y-4">
                                <div
                                    class="text-xs text-neutral-500 flex items-center gap-2 border-t border-neutral-200 pt-4 text-left">
                                    <div
                                        class="w-6 h-6 rounded-full bg-neutral-200 flex items-center justify-center text-neutral-600 text-[10px] font-bold">
                                        L</div>
                                    <span>Dilaporkan oleh Lisa (Ketua OSIS)</span>
                                </div>
                                <a href="{{ route('login') }}"
                                    class="w-full py-3.5 border border-neutral-300 text-neutral-600 hover:text-black text-xs font-bold rounded-xl hover:bg-neutral-100 transition-all flex items-center justify-center gap-1.5 uppercase tracking-wide">Masuk
                                    Untuk Dukung</a>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section id="testimonials" class="py-24 border-t border-neutral-200 relative z-10">
            <div class="max-w-7xl mx-auto px-8">
                <div class="text-center max-w-2xl mx-auto mb-16 text-left sm:text-center">
                    <h2 class="text-3xl font-extrabold tracking-tight mb-4 text-black">Apa Kata Mereka?</h2>
                    <p class="text-neutral-600 text-base">Testimoni dari para murid, guru, dan kepala sekolah yang
                        telah berkolaborasi di SaranaKu.</p>
                </div>

                <div class="mx-auto max-w-sm px-4 font-sans antialiased md:max-w-4xl md:px-8 lg:px-12"
                    id="testimonial-widget">
                    <div class="relative grid grid-cols-1 gap-20 md:grid-cols-2 items-center">
                        <!-- Left: Images Stack -->
                        <div class="relative h-80 w-full flex items-center justify-center">
                            <div class="relative h-80 w-full max-w-[320px] md:max-w-[400px]">
                                @php
                                    $testimonials = [
                                        [
                                            'quote' =>
                                                'Melaporkan AC kelas yang bocor sangat mudah. Saya tinggal memotretnya dan mengunggahnya ke SaranaKu. Besoknya teknisi langsung datang memperbaiki.',
                                            'name' => 'Sarah Chen',
                                            'designation' => 'Siswa Kelas XII RPL',
                                            'src' =>
                                                'https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=3560&auto=format&fit=crop&ixlib=rb-4.0.3',
                                        ],
                                        [
                                            'quote' =>
                                                'SaranaKu memotong rantai birokrasi manual yang lambat. Sekarang kami dapat meninjau kebutuhan sarana berdasarkan upvote terbanyak dari siswa.',
                                            'name' => 'Michael Rodriguez',
                                            'designation' => 'Kepala Sekolah',
                                            'src' =>
                                                'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=3540&auto=format&fit=crop&ixlib=rb-4.0.3',
                                        ],
                                        [
                                            'quote' =>
                                                'Sebagai staf sarana prasarana, sistem ini mempermudah inventarisasi aset dan memperkirakan jadwal pemeliharaan secara digital dan efisien.',
                                            'name' => 'Emily Watson',
                                            'designation' => 'Wakasek Bidang Sarana Prasarana',
                                            'src' =>
                                                'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=3540&auto=format&fit=crop&ixlib=rb-4.0.3',
                                        ],
                                        [
                                            'quote' =>
                                                'Fitur notifikasi real-time dan tingkat skala prioritas membantu kami sebagai petugas maintenance merespons kerusakan darurat lebih cepat.',
                                            'name' => 'James Kim',
                                            'designation' => 'Teknisi & Staff Sarpras',
                                            'src' =>
                                                'https://images.unsplash.com/photo-1628157582853-a796fa650a6a?q=80&w=3540&auto=format&fit=crop&ixlib=rb-4.0.3',
                                        ],
                                        [
                                            'quote' =>
                                                'Melalui fitur diskusi dan upvoting, kami dapat memperjuangkan fasilitas loker baru di kelas secara demokratis dan transparan.',
                                            'name' => 'Lisa Thompson',
                                            'designation' => 'Ketua OSIS',
                                            'src' =>
                                                'https://images.unsplash.com/photo-1580489944761-15a19d654956?q=80&w=3540&auto=format&fit=crop&ixlib=rb-4.0.3',
                                        ],
                                    ];
                                @endphp

                                @foreach ($testimonials as $index => $testimonial)
                                    <div data-testimonial-img="{{ $index }}"
                                        class="absolute inset-0 origin-bottom transition-all duration-500 ease-out"
                                        style="z-index: {{ 10 + count($testimonials) - $index }}; opacity: 0; transform: scale(0.9) rotate(0deg);">
                                        <img src="{{ $testimonial['src'] }}" alt="{{ $testimonial['name'] }}"
                                            draggable="false"
                                            class="h-full w-full rounded-3xl object-cover object-center shadow-2xl border border-neutral-200" />
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Right: Text Content & Buttons -->
                        <div class="flex flex-col justify-between py-4 min-h-[300px]">
                            <div id="testimonial-text-container" class="relative">
                                @foreach ($testimonials as $index => $testimonial)
                                    <div data-testimonial-text="{{ $index }}" class="hidden text-left">
                                        <h3 class="text-2xl font-bold text-black">
                                            {{ $testimonial['name'] }}
                                        </h3>
                                        <p class="text-sm text-neutral-600 font-bold">
                                            {{ $testimonial['designation'] }}
                                        </p>
                                        <p class="mt-8 text-lg text-neutral-700 leading-relaxed font-medium">
                                            @foreach (explode(' ', $testimonial['quote']) as $wordIndex => $word)
                                                <span
                                                    class="inline-block opacity-0 translate-y-1 blur-[10px] transition-all duration-300 ease-out"
                                                    style="transition-delay: {{ $wordIndex * 20 }}ms;">
                                                    {{ $word }}&nbsp;
                                                </span>
                                            @endforeach
                                        </p>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Buttons Navigation -->
                            <div class="flex gap-4 pt-12 md:pt-0">
                                <button id="testimonial-prev-btn"
                                    class="group/button flex h-10 w-10 items-center justify-center rounded-full bg-neutral-100 hover:bg-neutral-200 border border-neutral-200 transition-colors">
                                    <span
                                        class="material-symbols-outlined text-lg text-black transition-transform duration-300 group-hover/button:-translate-x-0.5">arrow_back</span>
                                </button>
                                <button id="testimonial-next-btn"
                                    class="group/button flex h-10 w-10 items-center justify-center rounded-full bg-neutral-100 hover:bg-neutral-200 border border-neutral-200 transition-colors">
                                    <span
                                        class="material-symbols-outlined text-lg text-black transition-transform duration-300 group-hover/button:translate-x-0.5">arrow_forward</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const images = document.querySelectorAll('[data-testimonial-img]');
                const texts = document.querySelectorAll('[data-testimonial-text]');
                const prevBtn = document.getElementById('testimonial-prev-btn');
                const nextBtn = document.getElementById('testimonial-next-btn');
                let activeIndex = 0;
                const total = images.length;

                // Pre-calculate random rotations for each card
                const rotations = Array.from({
                    length: total
                }, () => Math.floor(Math.random() * 21) - 10);

                function updateTestimonial() {
                    images.forEach((img, index) => {
                        const isCurrent = index === activeIndex;

                        if (isCurrent) {
                            img.style.opacity = '1';
                            img.style.transform = 'scale(1) rotate(0deg)';
                            img.style.zIndex = '40';

                            // Framer-motion bounce entry animation using Web Animations API
                            img.animate([{
                                    transform: 'scale(0.9) translateY(0px) rotate(' + rotations[index] +
                                        'deg)',
                                    opacity: 0.7
                                },
                                {
                                    transform: 'scale(1.02) translateY(-40px) rotate(0deg)',
                                    opacity: 1
                                },
                                {
                                    transform: 'scale(1) translateY(0px) rotate(0deg)',
                                    opacity: 1
                                }
                            ], {
                                duration: 400,
                                easing: 'ease-in-out'
                            });
                        } else {
                            img.style.opacity = '0.5';
                            img.style.transform = `scale(0.95) rotate(${rotations[index]}deg)`;
                            img.style.zIndex = String(total + 2 - index);

                            // Hide completely if far from active
                            const distanceFromActive = (index - activeIndex + total) % total;
                            if (distanceFromActive > 2) {
                                img.style.opacity = '0';
                            }
                        }
                    });

                    texts.forEach((textBlock, index) => {
                        if (index === activeIndex) {
                            textBlock.classList.remove('hidden');
                            // Small timeout to ensure browser paints first, then animate words
                            setTimeout(() => {
                                const words = textBlock.querySelectorAll('span');
                                words.forEach(word => {
                                    word.classList.remove('opacity-0', 'translate-y-1',
                                        'blur-[10px]');
                                    word.classList.add('opacity-100', 'translate-y-0',
                                        'blur-[0px]');
                                });
                            }, 50);
                        } else {
                            textBlock.classList.add('hidden');
                            const words = textBlock.querySelectorAll('span');
                            words.forEach(word => {
                                word.classList.add('opacity-0', 'translate-y-1', 'blur-[10px]');
                                word.classList.remove('opacity-100', 'translate-y-0', 'blur-[0px]');
                            });
                        }
                    });
                }

                prevBtn.addEventListener('click', () => {
                    activeIndex = (activeIndex - 1 + total) % total;
                    updateTestimonial();
                });

                nextBtn.addEventListener('click', () => {
                    activeIndex = (activeIndex + 1) % total;
                    updateTestimonial();
                });

                // Trigger first load
                updateTestimonial();
            });
        </script>

        <!-- FAQ Section -->
        <section id="faq" class="py-24 border-t border-neutral-200 relative z-10">
            <div class="max-w-4xl mx-auto px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-extrabold tracking-tight mb-4 text-black">Pertanyaan yang Sering Diajukan
                        (FAQ)</h2>
                    <p class="text-neutral-600 text-base">Punya pertanyaan tentang SaranaKu? Berikut beberapa jawaban
                        untuk pertanyaan umum.</p>
                </div>

                <div class="space-y-4 text-left">
                    <details
                        class="group bg-white border border-neutral-200 rounded-2xl p-6 [&_summary::-webkit-details-marker]:hidden transition-all duration-300 hover:border-neutral-300">
                        <summary
                            class="flex justify-between items-center font-bold text-lg text-black cursor-pointer select-none">
                            <span>Siapa saja yang dapat menggunakan platform SaranaKu?</span>
                            <span
                                class="material-symbols-outlined transition-transform group-open:rotate-180 text-black">expand_more</span>
                        </summary>
                        <p class="mt-4 text-neutral-600 text-sm leading-relaxed">
                            Seluruh warga sekolah yang terdaftar (siswa, guru, kepala sekolah, staff sarana prasarana,
                            dan teknisi) dapat login untuk melaporkan kerusakan sarana, memberikan usulan, atau memantau
                            progres perbaikan.
                        </p>
                    </details>

                    <details
                        class="group bg-white border border-neutral-200 rounded-2xl p-6 [&_summary::-webkit-details-marker]:hidden transition-all duration-300 hover:border-neutral-300">
                        <summary
                            class="flex justify-between items-center font-bold text-lg text-black cursor-pointer select-none">
                            <span>Apakah pelapor bisa menyembunyikan identitas?</span>
                            <span
                                class="material-symbols-outlined transition-transform group-open:rotate-180 text-black">expand_more</span>
                        </summary>
                        <p class="mt-4 text-neutral-600 text-sm leading-relaxed">
                            Ya, terdapat fitur pelaporan **Anonim**. Bila Anda mengaktifkannya saat menulis laporan,
                            nama dan profil Anda disembunyikan dari publik dan hanya dapat dilihat oleh admin sarana
                            untuk keperluan verifikasi.
                        </p>
                    </details>

                    <details
                        class="group bg-white border border-neutral-200 rounded-2xl p-6 [&_summary::-webkit-details-marker]:hidden transition-all duration-300 hover:border-neutral-300">
                        <summary
                            class="flex justify-between items-center font-bold text-lg text-black cursor-pointer select-none">
                            <span>Bagaimana alur penyelesaian laporan kerusakan?</span>
                            <span
                                class="material-symbols-outlined transition-transform group-open:rotate-180 text-black">expand_more</span>
                        </summary>
                        <p class="mt-4 text-neutral-600 text-sm leading-relaxed">
                            Setelah laporan dikirim, admin sekolah memverifikasi dan mengatur prioritas perbaikan.
                            Laporan berskala besar dikirim ke Kepala Sekolah (Atasan) untuk persetujuan anggaran,
                            kemudian teknisi internal/eksternal dikirim ke lokasi hingga status selesai diperbarui.
                        </p>
                    </details>

                    <details
                        class="group bg-white border border-neutral-200 rounded-2xl p-6 [&_summary::-webkit-details-marker]:hidden transition-all duration-300 hover:border-neutral-300">
                        <summary
                            class="flex justify-between items-center font-bold text-lg text-black cursor-pointer select-none">
                            <span>Bagaimana jika saya mengalami error atau kesulitan?</span>
                            <span
                                class="material-symbols-outlined transition-transform group-open:rotate-180 text-black">expand_more</span>
                        </summary>
                        <p class="mt-4 text-neutral-600 text-sm leading-relaxed">
                            Anda dapat menghubungi admin sarana prasarana sekolah secara langsung melalui forum diskusi
                            di dalam detail laporan untuk melaporkan bug atau kendala teknis.
                        </p>
                    </details>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-24 text-center px-8 relative z-10">
            <div
                class="max-w-3xl mx-auto py-16 px-8 rounded-3xl bg-black text-white relative overflow-hidden shadow-2xl">
                <div class="absolute top-0 right-0 w-64 h-64 bg-neutral-900 rounded-full blur-3xl -mr-32 -mt-32"></div>
                <div class="relative z-10">
                    <h2
                        class="text-3xl md:text-5xl font-bold tracking-tight mb-6 leading-tight text-white font-headline">
                        Siap untuk Mewujudkan
                        <br />Fasilitas Sekolah yang Nyaman?
                    </h2>
                    <p class="text-lg opacity-80 mb-10 max-w-xl mx-auto text-neutral-400">Bergabunglah dengan ribuan
                        siswa dan staff lainnya yang telah mendigitalisasi pelaporan serta pemeliharaan sarana secara
                        transparan di SaranaKu.</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        @auth
                            <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : (auth()->user()->role === 'atasan' ? route('atasan.dashboard') : route('student.dashboard')) }}"
                                class="px-10 py-4 bg-white text-black font-bold rounded-xl hover:bg-neutral-200 transition-colors">Buka
                                Dasbor</a>
                        @else
                            <a href="{{ route('register') }}"
                                class="px-10 py-4 bg-white text-black font-bold rounded-xl hover:bg-neutral-200 transition-colors">Daftar
                                Sekarang</a>
                            <a href="{{ route('login') }}"
                                class="px-10 py-4 border border-neutral-700 text-white font-bold rounded-xl hover:bg-white/10 transition-colors">Masuk
                                Akun</a>
                        @endauth
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <footer class="bg-white border-t border-neutral-200 py-12 text-sm z-20 relative">
        <div class="max-w-7xl mx-auto px-8 text-center sm:text-left">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-6 text-neutral-450">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-black rounded-xl flex items-center justify-center text-white shadow-md">
                        <span class="material-symbols-outlined font-black text-xl">campaign</span>
                    </div>
                    <span class="font-headline font-black text-lg tracking-tight text-black">Sarana<span
                            class="text-neutral-500">Ku</span></span>
                </div>
                <p class="font-semibold text-xs sm:text-sm">
                    &copy; {{ date('Y') }} SaranaKu. Membangun kenyamanan belajar sekolah secara kolaboratif.
                </p>
            </div>
        </div>
    </footer>

</body>

</html>
