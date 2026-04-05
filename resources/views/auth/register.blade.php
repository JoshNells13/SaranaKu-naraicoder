@extends('layouts.auth')
@section('title', 'SaranaKu | Register')
@section('content')
<main class="w-full max-w-6xl grid grid-cols-1 md:grid-cols-2 bg-surface-container-lowest rounded-[32px] overflow-hidden soft-elevation">
    {{-- Left Section --}}
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
            <h1 class="font-headline text-5xl font-extrabold tracking-tight leading-tight mb-6">Mulai perjalanan Anda hari ini</h1>
            <p class="text-white/80 text-lg font-medium leading-relaxed">Buat akun dan mulailah berbagi aspirasi untuk membuat sekolah kita lebih baik.</p>
        </div>
        <div class="relative z-10"><span class="text-sm font-semibold text-white/90">Bergabung dengan 2.000+ Siswa Aktif</span></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 -left-12 w-48 h-48 bg-blue-400/20 rounded-full blur-2xl"></div>
    </section>
    {{-- Right Section: Register Form --}}
    <section class="p-8 md:p-16 flex flex-col justify-center bg-surface-container-lowest">
        <div class="max-w-md mx-auto w-full">
            <header class="mb-10">
                <h2 class="font-headline text-3xl font-bold text-on-surface tracking-tight mb-2">Buat Akun</h2>
                <p class="text-on-surface-variant font-medium">Isi detail Anda untuk bergabung melalui wadah aspirasi kami.</p>
            </header>
            <form class="space-y-5" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-on-surface-variant px-1" for="name">Nama Lengkap</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant transition-colors group-focus-within:text-primary">person</span>
                        <input class="w-full pl-12 pr-4 py-4 bg-surface-container-low border-none rounded-xl text-on-surface placeholder:text-outline focus:ring-2 focus:ring-primary focus:bg-surface-container-lowest transition-all" id="name" name="name" value="{{ old('name') }}" placeholder="Nama Lengkap Anda" type="text" />
                    </div>
                    @error('name') <span class="text-error text-xs font-medium">{{ $message }}</span> @enderror
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-on-surface-variant px-1" for="email">Alamat Email</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant transition-colors group-focus-within:text-primary">mail</span>
                        <input class="w-full pl-12 pr-4 py-4 bg-surface-container-low border-none rounded-xl text-on-surface placeholder:text-outline focus:ring-2 focus:ring-primary focus:bg-surface-container-lowest transition-all" id="email" name="email" value="{{ old('email') }}" placeholder="nama@sekolah.edu" type="email" />
                    </div>
                    @error('email') <span class="text-error text-xs font-medium">{{ $message }}</span> @enderror
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-on-surface-variant px-1" for="kelas">Kelas</label>
                        <input class="w-full px-4 py-4 bg-surface-container-low border-none rounded-xl text-on-surface placeholder:text-outline focus:ring-2 focus:ring-primary transition-all" id="kelas" name="kelas" value="{{ old('kelas') }}" placeholder="XII IPA 1" type="text" />
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-on-surface-variant px-1" for="jurusan">Jurusan</label>
                        <input class="w-full px-4 py-4 bg-surface-container-low border-none rounded-xl text-on-surface placeholder:text-outline focus:ring-2 focus:ring-primary transition-all" id="jurusan" name="jurusan" value="{{ old('jurusan') }}" placeholder="IPA / IPS" type="text" />
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-on-surface-variant px-1" for="password">Kata Sandi</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant transition-colors group-focus-within:text-primary">lock</span>
                        <input class="w-full pl-12 pr-4 py-4 bg-surface-container-low border-none rounded-xl text-on-surface placeholder:text-outline focus:ring-2 focus:ring-primary transition-all" id="password" name="password" placeholder="••••••••" type="password" />
                    </div>
                    @error('password') <span class="text-error text-xs font-medium">{{ $message }}</span> @enderror
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-on-surface-variant px-1" for="password_confirmation">Konfirmasi Kata Sandi</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant transition-colors group-focus-within:text-primary">lock</span>
                        <input class="w-full pl-12 pr-4 py-4 bg-surface-container-low border-none rounded-xl text-on-surface placeholder:text-outline focus:ring-2 focus:ring-primary transition-all" id="password_confirmation" name="password_confirmation" placeholder="••••••••" type="password" />
                    </div>
                </div>
                <div class="pt-4">
                    <button class="w-full py-4 editorial-gradient text-white font-bold rounded-xl shadow-lg shadow-primary/20 active:scale-[0.98] transition-all hover:brightness-110 flex items-center justify-center gap-2" type="submit">
                        <span>Daftar Akun</span>
                        <span class="material-symbols-outlined text-lg">arrow_forward</span>
                    </button>
                </div>
            </form>
            <footer class="mt-8 text-center">
                <p class="text-on-surface-variant font-medium">Sudah punya akun? <a class="text-primary font-bold hover:underline ml-1" href="{{ route('login') }}">Masuk</a></p>
            </footer>
        </div>
    </section>
</main>
@endsection
