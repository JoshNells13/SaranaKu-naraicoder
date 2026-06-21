@extends('layouts.app')
@section('title', 'Ubah Murid | SaranaKu')
@php $active = 'students'; @endphp

@section('content')
{{-- Breadcrumbs --}}
<div class="flex items-center gap-2 text-on-surface-variant text-sm font-medium mb-8">
    <a href="{{ route('admin.students.index') }}" class="hover:text-primary transition-colors">Kelola Murid</a>
    <span class="material-symbols-outlined text-xs">chevron_right</span>
    <span class="text-primary font-semibold">Ubah Profil Murid</span>
</div>

<div class="max-w-2xl mx-auto">
    <div class="bg-surface-container-lowest rounded-2xl p-8 md:p-10 shadow-sm border border-outline-variant/30">
        <header class="mb-8">
            <h2 class="font-headline text-3xl font-extrabold text-on-surface tracking-tight mb-2">Ubah Profil Murid</h2>
            <p class="text-on-surface-variant text-sm">Sesuaikan informasi profil murid di bawah. Anda juga dapat memperbarui kata sandinya secara langsung.</p>
        </header>

        <form class="space-y-6" method="POST" action="{{ route('admin.students.update', $student) }}">
            @csrf
            @method('PUT')

            {{-- Name --}}
            <div class="space-y-2">
                <label class="text-sm font-bold text-on-surface-variant px-1" for="name">Nama Lengkap</label>
                <div class="relative group">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant transition-colors group-focus-within:text-primary">person</span>
                    <input class="w-full pl-12 pr-4 py-4 bg-surface-container-low border-none rounded-2xl text-on-surface placeholder:text-outline/50 focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest transition-all"
                           id="name" name="name" value="{{ old('name', $student->name) }}" placeholder="Nama lengkap siswa" type="text" required autofocus />
                </div>
                @error('name')
                    <span class="text-error text-xs font-medium px-1">{{ $message }}</span>
                @enderror
            </div>

            {{-- Email --}}
            <div class="space-y-2">
                <label class="text-sm font-bold text-on-surface-variant px-1" for="email">Alamat Email</label>
                <div class="relative group">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant transition-colors group-focus-within:text-primary">mail</span>
                    <input class="w-full pl-12 pr-4 py-4 bg-surface-container-low border-none rounded-2xl text-on-surface placeholder:text-outline/50 focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest transition-all"
                           id="email" name="email" value="{{ old('email', $student->email) }}" placeholder="siswa@saranaku.com" type="email" required />
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
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant transition-colors group-focus-within:text-primary">school</span>
                        <input class="w-full pl-12 pr-4 py-4 bg-surface-container-low border-none rounded-2xl text-on-surface placeholder:text-outline/50 focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest transition-all"
                               id="kelas" name="kelas" value="{{ old('kelas', $student->kelas) }}" placeholder="XII IPA 1" type="text" required />
                    </div>
                    @error('kelas')
                        <span class="text-error text-xs font-medium px-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-on-surface-variant px-1" for="jurusan">Jurusan</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant transition-colors group-focus-within:text-primary">architecture</span>
                        <input class="w-full pl-12 pr-4 py-4 bg-surface-container-low border-none rounded-2xl text-on-surface placeholder:text-outline/50 focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest transition-all"
                               id="jurusan" name="jurusan" value="{{ old('jurusan', $student->jurusan) }}" placeholder="IPA / IPS / MIPA" type="text" required />
                    </div>
                    @error('jurusan')
                        <span class="text-error text-xs font-medium px-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- Passwords --}}
            <div class="p-5 bg-surface-container-low rounded-2xl space-y-4">
                <div>
                    <h3 class="text-sm font-bold text-on-surface flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-sm">lock_reset</span>
                        Ganti Kata Sandi
                    </h3>
                    <p class="text-xs text-on-surface-variant mt-1">Kosongkan kolom di bawah jika tidak ingin mengubah kata sandi siswa.</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-on-surface-variant px-1" for="password">Kata Sandi Baru</label>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant transition-colors group-focus-within:text-primary">lock</span>
                            <input class="w-full pl-12 pr-4 py-4 bg-surface-container-lowest border-none rounded-xl text-on-surface placeholder:text-outline/50 focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest transition-all"
                                   id="password" name="password" placeholder="••••••••" type="password" />
                        </div>
                        @error('password')
                            <span class="text-error text-xs font-medium px-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-on-surface-variant px-1" for="password_confirmation">Konfirmasi Sandi</label>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant transition-colors group-focus-within:text-primary">lock_clock</span>
                            <input class="w-full pl-12 pr-4 py-4 bg-surface-container-lowest border-none rounded-xl text-on-surface placeholder:text-outline/50 focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest transition-all"
                                   id="password_confirmation" name="password_confirmation" placeholder="••••••••" type="password" />
                        </div>
                    </div>
                </div>
            </div>

            {{-- Submit and Cancel --}}
            <div class="flex justify-end gap-3 pt-6 border-t border-outline-variant/30">
                <a href="{{ route('admin.students.index') }}"
                   class="px-6 py-3 rounded-2xl text-sm font-bold text-on-surface-variant hover:bg-surface-container-high transition-colors flex items-center justify-center">
                    Batal
                </a>
                <button type="submit"
                        class="bg-primary text-white px-8 py-3 rounded-2xl font-bold shadow-md shadow-primary/20 hover:brightness-110 active:scale-95 transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg">save</span>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
