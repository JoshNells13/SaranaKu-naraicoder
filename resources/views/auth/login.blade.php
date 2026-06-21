@extends('layouts.auth')
@section('title', 'SaranaKu | Masuk')
@section('content')
    <main
        class="w-full max-w-md bg-surface-container-lowest rounded-[32px] overflow-hidden soft-elevation border border-outline-variant/30">
        {{-- Right Section: Login Form --}}
        <section class="p-8 md:p-12 flex flex-col justify-center">
            <div class="w-full">
                <header class="mb-10 text-center">
                    <div class="flex items-center justify-center mb-6">
                        <span
                            class="font-headline font-extrabold text-3xl tracking-tighter editorial-gradient bg-clip-text text-transparent">SaranaKu</span>
                    </div>
                    <h2 class="font-headline text-3xl font-extrabold text-on-surface tracking-tight mb-2">Selamat Datang
                    </h2>
                    <p class="text-on-surface-variant font-medium">Masuk ke akun SaranaKu Anda</p>
                </header>

                <form class="space-y-6" method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Email --}}
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-on-surface-variant px-1" for="email">Alamat Email</label>
                        <div class="relative group">
                            <span
                                class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant transition-colors group-focus-within:text-primary">mail</span>
                            <input
                                class="w-full pl-12 pr-4 py-4 bg-surface-container-low border-none rounded-2xl text-on-surface placeholder:text-outline/50 focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest transition-all"
                                id="email" name="email" value="{{ old('email') }}" placeholder="nama@gmail.com"
                                type="email" required autofocus />
                        </div>
                        @error('email')
                            <span class="text-error text-xs font-medium px-1">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="space-y-2">
                        <div class="flex justify-between items-center px-1">
                            <label class="text-sm font-bold text-on-surface-variant" for="password">Kata Sandi</label>
                        </div>
                        <div class="relative group" x-data="{ show: false }">
                            <span
                                class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant transition-colors group-focus-within:text-primary">lock</span>
                            <input
                                class="w-full pl-12 pr-12 py-4 bg-surface-container-low border-none rounded-2xl text-on-surface placeholder:text-outline/50 focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest transition-all"
                                id="password" name="password" placeholder="••••••••" :type="show ? 'text' : 'password'"
                                required />
                            <button @click="show = !show"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-on-surface transition-colors"
                                type="button">
                                <span class="material-symbols-outlined text-xl"
                                    x-text="show ? 'visibility_off' : 'visibility'">visibility</span>
                            </button>
                        </div>
                        @error('password')
                            <span class="text-error text-xs font-medium px-1">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Submit --}}
                    <div class="pt-4">
                        <button
                            class="w-full py-4 editorial-gradient text-white font-extrabold rounded-2xl shadow-xl shadow-black/10 active:scale-[0.98] hover:scale-[1.02] transition-all hover:brightness-110 flex items-center justify-center gap-2 group"
                            type="submit">
                            <span>Masuk Sekarang</span>
                            <span
                                class="material-symbols-outlined text-xl transition-transform group-hover:translate-x-1">arrow_forward</span>
                        </button>
                    </div>
                </form>

                <footer class="mt-12 text-center border-t border-outline-variant/30 pt-8">
                    <p class="text-on-surface-variant font-medium">
                        Belum punya akun?
                        <a class="text-primary font-extrabold hover:underline ml-1" href="{{ route('register') }}">Daftar
                            Gratis</a>
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
