@extends('layouts.auth')
@section('title', 'SaranaKu | Daftar')
@section('content')
    <main
        class="w-full max-w-xl bg-surface-container-lowest rounded-[32px] overflow-hidden soft-elevation border border-outline-variant/30 my-8">
        {{-- Register Form Card --}}
        <section class="p-8 md:p-12 flex flex-col justify-center">
            <div class="w-full">
                <header class="mb-10 text-center">
                    <div class="flex items-center justify-center mb-6">
                        <span
                            class="font-headline font-extrabold text-3xl tracking-tighter editorial-gradient bg-clip-text text-transparent">SaranaKu</span>
                    </div>
                    <h2 class="font-headline text-3xl font-extrabold text-on-surface tracking-tight mb-2">Buat Akun Baru
                    </h2>
                    <p class="text-on-surface-variant font-medium text-balance px-4">Bergabunglah dan mulai sampaikan
                        aspirasi Anda untuk sekolah yang lebih baik.</p>
                </header>

                <form class="space-y-6" method="POST" action="{{ route('register') }}">
                    @csrf

                    {{-- Name --}}
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-on-surface-variant px-1" for="name">Nama Lengkap</label>
                        <div class="relative group">
                            <span
                                class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant transition-colors group-focus-within:text-primary">person</span>
                            <input
                                class="w-full pl-12 pr-4 py-4 bg-surface-container-low border-none rounded-2xl text-on-surface placeholder:text-outline/50 focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest transition-all"
                                id="name" name="name" value="{{ old('name') }}" placeholder="Nama lengkap Anda"
                                type="text" required autofocus />
                        </div>
                        @error('name')
                            <span class="text-error text-xs font-medium px-1">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-on-surface-variant px-1" for="email">Alamat Email</label>
                        <div class="relative group">
                            <span
                                class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant transition-colors group-focus-within:text-primary">mail</span>
                            <input
                                class="w-full pl-12 pr-4 py-4 bg-surface-container-low border-none rounded-2xl text-on-surface placeholder:text-outline/50 focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest transition-all"
                                id="email" name="email" value="{{ old('email') }}" placeholder="nama@gmail.com"
                                type="email" required />
                        </div>
                        @error('email')
                            <span class="text-error text-xs font-medium px-1">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Class and Major --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-on-surface-variant px-1" for="kelas">Kelas</label>
                            <div class="relative group">
                                <span
                                    class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant transition-colors group-focus-within:text-primary">school</span>
                                <input
                                    class="w-full pl-12 pr-4 py-4 bg-surface-container-low border-none rounded-2xl text-on-surface placeholder:text-outline/50 focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest transition-all"
                                    id="kelas" name="kelas" value="{{ old('kelas') }}" placeholder="XII IPA 1"
                                    type="text" required />
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-on-surface-variant px-1" for="jurusan">Jurusan</label>
                            <div class="relative group">
                                <span
                                    class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant transition-colors group-focus-within:text-primary">architecture</span>
                                <input
                                    class="w-full pl-12 pr-4 py-4 bg-surface-container-low border-none rounded-2xl text-on-surface placeholder:text-outline/50 focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest transition-all"
                                    id="jurusan" name="jurusan" value="{{ old('jurusan') }}" placeholder="IPA / IPS"
                                    type="text" required />
                            </div>
                        </div>
                    </div>

                    {{-- Passwords --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-on-surface-variant px-1" for="password">Kata Sandi</label>
                            <div class="relative group">
                                <span
                                    class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant transition-colors group-focus-within:text-primary">lock</span>
                                <input
                                    class="w-full pl-12 pr-4 py-4 bg-surface-container-low border-none rounded-2xl text-on-surface placeholder:text-outline/50 focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest transition-all"
                                    id="password" name="password" placeholder="••••••••" type="password" required />
                            </div>
                            @error('password')
                                <span class="text-error text-xs font-medium px-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-on-surface-variant px-1"
                                for="password_confirmation">Konfirmasi</label>
                            <div class="relative group">
                                <span
                                    class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant transition-colors group-focus-within:text-primary">lock_clock</span>
                                <input
                                    class="w-full pl-12 pr-4 py-4 bg-surface-container-low border-none rounded-2xl text-on-surface placeholder:text-outline/50 focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest transition-all"
                                    id="password_confirmation" name="password_confirmation" placeholder="••••••••"
                                    type="password" required />
                            </div>
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="pt-4">
                        <button
                            class="w-full py-4 editorial-gradient text-white font-extrabold rounded-2xl shadow-xl shadow-black/10 active:scale-[0.98] hover:scale-[1.02] transition-all hover:brightness-110 flex items-center justify-center gap-2 group"
                            type="submit">
                            <span>Daftar Sekarang</span>
                            <span
                                class="material-symbols-outlined text-xl transition-transform group-hover:translate-x-1">arrow_forward</span>
                        </button>
                    </div>
                </form>

                <footer class="mt-12 text-center border-t border-outline-variant/30 pt-8">
                    <p class="text-on-surface-variant font-medium">
                        Sudah memiliki akun?
                        <a class="text-primary font-extrabold hover:underline ml-1" href="{{ route('login') }}">Masuk
                            Disini</a>
                    </p>

                    <p class="text-on-surface-variant font-medium">
                        Kembali Ke Beranda
                        <a class="text-primary font-extrabold hover:underline ml-1" href="{{ route('home') }}">Kembali Ke
                            Beranda</a>
                    </p>
                </footer>
            </div>
        </section>
    </main>
@endsection
