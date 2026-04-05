@extends('layouts.auth')
@section('title', 'SaranaKu | Login')
@section('content')
<main class="w-full max-w-6xl grid grid-cols-1 md:grid-cols-2 bg-surface-container-lowest rounded-[32px] overflow-hidden soft-elevation">
    {{-- Left Section: Editorial --}}
    <section class="relative hidden md:flex flex-col justify-between p-12 editorial-gradient text-white overflow-hidden">
        <div class="absolute inset-0 opacity-20 pointer-events-none bg-[url('https://www.transparenttextures.com/patterns/asfalt-light.png')]"></div>
        <div class="relative z-10">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-md">
                    <span class="material-symbols-outlined text-white">auto_awesome</span>
                </div>
                <span class="font-headline font-extrabold text-2xl tracking-tighter">SaranaKu</span>
            </div>
        </div>
        <div class="relative z-10 max-w-md">
            <h1 class="font-headline text-5xl font-extrabold tracking-tight leading-tight mb-6">
                Membangun masa depan melalui setiap aspirasi
            </h1>
            <p class="text-white/80 text-lg font-medium leading-relaxed">
                Bergabunglah dengan komunitas siswa berpikiran maju dan pengurus yang berdedikasi untuk mewujudkan aspirasi menjadi tujuan yang nyata.
            </p>
        </div>
        <div class="relative z-10 flex items-center gap-4">
            <span class="text-sm font-semibold text-white/90">Dipercaya oleh 2.000+ Siswa</span>
        </div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 -left-12 w-48 h-48 bg-blue-400/20 rounded-full blur-2xl"></div>
    </section>

    {{-- Right Section: Login Form --}}
    <section class="p-8 md:p-16 flex flex-col justify-center bg-surface-container-lowest">
        <div class="max-w-md mx-auto w-full">
            <header class="mb-10">
                <h2 class="font-headline text-3xl font-bold text-on-surface tracking-tight mb-2">Selamat Datang Kembali</h2>
                <p class="text-on-surface-variant font-medium">Silakan masukkan detail Anda untuk mengakses portal.</p>
            </header>
            <form class="space-y-6" method="POST" action="{{ route('login') }}">
                @csrf
                {{-- Role Selection --}}
                <div class="space-y-3">
                    <label class="text-sm font-semibold text-on-surface-variant px-1">Masuk Sebagai...</label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="cursor-pointer group">
                            <input {{ old('role', 'murid') === 'murid' ? 'checked' : '' }} class="peer sr-only" name="role" type="radio" value="murid" />
                            <div class="flex items-center justify-center gap-2 p-3 rounded-xl border border-transparent bg-surface-container-low text-on-surface-variant transition-all peer-checked:bg-primary-fixed peer-checked:text-on-primary-fixed peer-checked:font-bold group-hover:bg-surface-container-high">
                                <span class="material-symbols-outlined text-lg">school</span>
                                <span class="text-sm">Siswa</span>
                            </div>
                        </label>
                        <label class="cursor-pointer group">
                            <input {{ old('role') === 'admin' ? 'checked' : '' }} class="peer sr-only" name="role" type="radio" value="admin" />
                            <div class="flex items-center justify-center gap-2 p-3 rounded-xl border border-transparent bg-surface-container-low text-on-surface-variant transition-all peer-checked:bg-primary-fixed peer-checked:text-on-primary-fixed peer-checked:font-bold group-hover:bg-surface-container-high">
                                <span class="material-symbols-outlined text-lg">shield_person</span>
                                <span class="text-sm">Admin</span>
                            </div>
                        </label>
                    </div>
                    @error('role') <span class="text-error text-xs font-medium">{{ $message }}</span> @enderror
                </div>
                {{-- Email --}}
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-on-surface-variant px-1" for="email">Alamat Email</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant transition-colors group-focus-within:text-primary">mail</span>
                        <input class="w-full pl-12 pr-4 py-4 bg-surface-container-low border-none rounded-xl text-on-surface placeholder:text-outline focus:ring-2 focus:ring-primary focus:bg-surface-container-lowest transition-all" id="email" name="email" value="{{ old('email') }}" placeholder="name@school.edu" type="email" />
                    </div>
                    @error('email') <span class="text-error text-xs font-medium">{{ $message }}</span> @enderror
                </div>
                {{-- Password --}}
                <div class="space-y-2">
                    <div class="flex justify-between items-center px-1">
                        <label class="text-sm font-semibold text-on-surface-variant" for="password">Kata Sandi</label>
                    </div>
                    <div class="relative group" x-data="{ show: false }">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant transition-colors group-focus-within:text-primary">lock</span>
                        <input class="w-full pl-12 pr-12 py-4 bg-surface-container-low border-none rounded-xl text-on-surface placeholder:text-outline focus:ring-2 focus:ring-primary focus:bg-surface-container-lowest transition-all" id="password" name="password" placeholder="••••••••" :type="show ? 'text' : 'password'" />
                        <button @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-on-surface" type="button">
                            <span class="material-symbols-outlined text-lg" x-text="show ? 'visibility_off' : 'visibility'">visibility</span>
                        </button>
                    </div>
                    @error('password') <span class="text-error text-xs font-medium">{{ $message }}</span> @enderror
                </div>
                {{-- Submit --}}
                <div class="pt-4 flex flex-col gap-4">
                    <button class="w-full py-4 editorial-gradient text-white font-bold rounded-xl shadow-lg shadow-primary/20 active:scale-[0.98] transition-all hover:brightness-110 flex items-center justify-center gap-2" type="submit">
                        <span>Masuk</span>
                        <span class="material-symbols-outlined text-lg">arrow_forward</span>
                    </button>
                </div>
            </form>
            <footer class="mt-12 text-center">
                <p class="text-on-surface-variant font-medium">
                    Belum punya akun?
                    <a class="text-primary font-bold hover:underline ml-1" href="{{ route('register') }}">Daftar sekarang</a>
                </p>
            </footer>
        </div>
    </section>
</main>
@endsection
