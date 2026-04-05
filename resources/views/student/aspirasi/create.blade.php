@extends('layouts.app')
@section('title', 'Ajukan Aspirasi | SaranaKu')
@php $active = 'submit'; @endphp

@section('content')
<div class="mb-12">
    <span class="text-primary font-bold text-xs uppercase tracking-widest">Entri Baru</span>
    <h1 class="text-4xl md:text-5xl font-extrabold text-on-surface tracking-tight mt-2">Ajukan Aspirasi</h1>
    <p class="text-on-surface-variant text-lg mt-4 max-w-2xl leading-relaxed">
        Bentuk masa depan komunitas sekolah kita. Bagikan pemikiran, usulan, atau permintaan perbaikan kepada pengurus.
    </p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    {{-- Form Section --}}
    <div class="lg:col-span-8 space-y-8">
        <div class="bg-surface-container-lowest rounded-xl p-8 shadow-sm">
            <form class="space-y-8" method="POST" action="{{ route('aspirasi.store') }}" enctype="multipart/form-data">
                @csrf
                {{-- Title Input --}}
                <div class="space-y-3">
                    <label class="text-sm font-semibold text-on-surface-variant flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">title</span> Judul Aspirasi
                    </label>
                    <input name="judul" value="{{ old('judul') }}"
                           class="w-full bg-surface-container-highest border-0 rounded-lg px-4 py-4 text-on-surface placeholder:text-outline focus:ring-2 focus:ring-primary focus:bg-surface-container-lowest transition-all duration-200 outline-none"
                           placeholder="Berikan judul yang jelas untuk aspirasimu" type="text" />
                    @error('judul') <span class="text-error text-xs font-medium">{{ $message }}</span> @enderror
                </div>

                {{-- Category & Anonymous --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-3">
                        <label class="text-sm font-semibold text-on-surface-variant flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">category</span> Kategori
                        </label>
                        <select name="kategori_id"
                                class="w-full bg-surface-container-highest border-0 rounded-lg px-4 py-4 text-on-surface focus:ring-2 focus:ring-primary focus:bg-surface-container-lowest transition-all duration-200 outline-none appearance-none">
                            <option value="">Pilih kategori...</option>
                            @foreach($kategori as $k)
                                <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>{{ $k->nama }}</option>
                            @endforeach
                        </select>
                        @error('kategori_id') <span class="text-error text-xs font-medium">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex items-end pb-1" x-data="{ anonim: {{ old('is_anonim') ? 'true' : 'false' }} }">
                        <div class="flex items-center justify-between w-full p-4 bg-surface-container-low rounded-lg">
                            <div class="flex flex-col">
                                <span class="text-sm font-semibold">Kirim secara anonim</span>
                                <span class="text-[10px] text-on-surface-variant">Identitasmu akan disembunyikan</span>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input @click="anonim = !anonim" class="sr-only peer" type="checkbox" name="is_anonim" value="1" :checked="anonim" />
                                <div class="w-11 h-6 bg-outline-variant peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                            </label>
                        </div>
                    </div>
                </div>

                {{-- Content --}}
                <div class="space-y-3">
                    <label class="text-sm font-semibold text-on-surface-variant flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">description</span> Detail Isi
                    </label>
                    <textarea name="isi"
                              class="w-full bg-surface-container-lowest border border-outline-variant/20 rounded-lg p-4 text-on-surface placeholder:text-outline focus:ring-2 focus:ring-primary outline-none resize-none"
                              placeholder="Deskripsikan aspirasimu secara detail..." rows="8">{{ old('isi') }}</textarea>
                    @error('isi') <span class="text-error text-xs font-medium">{{ $message }}</span> @enderror
                </div>

                {{-- File Upload --}}
                <div class="space-y-3" x-data="{ files: [] }">
                    <label class="text-sm font-semibold text-on-surface-variant flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">attach_file</span> Dokumen Pendukung
                    </label>
                    <div class="border-2 border-dashed border-outline-variant/40 rounded-xl p-10 flex flex-col items-center justify-center bg-surface-container-low/30 hover:bg-surface-container-low transition-colors cursor-pointer group"
                         @click="$refs.fileInput.click()">
                        <div class="w-16 h-16 bg-surface-container-lowest rounded-full flex items-center justify-center shadow-sm mb-4 group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-3xl text-primary">cloud_upload</span>
                        </div>
                        <p class="text-on-surface font-semibold">Tarik & Lepas file di sini</p>
                        <p class="text-on-surface-variant text-xs mt-1">PDF, JPG, PNG hingga 10MB</p>
                        <button class="mt-4 text-primary font-bold text-sm hover:underline" type="button">Atau telusuri file</button>
                    </div>
                    <input type="file" name="lampiran[]" multiple x-ref="fileInput" class="hidden"
                           @change="files = Array.from($event.target.files)" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" />
                    <template x-if="files.length > 0">
                        <div class="space-y-2 mt-2">
                            <template x-for="(file, i) in files" :key="i">
                                <div class="flex items-center gap-3 p-3 bg-surface-container-low rounded-lg">
                                    <span class="material-symbols-outlined text-primary">description</span>
                                    <span class="text-sm font-medium truncate" x-text="file.name"></span>
                                    <span class="ml-auto text-xs text-slate-400" x-text="(file.size / 1024 / 1024).toFixed(1) + ' MB'"></span>
                                </div>
                            </template>
                        </div>
                    </template>
                    @error('lampiran.*') <span class="text-error text-xs font-medium">{{ $message }}</span> @enderror
                </div>

                {{-- Submit --}}
                <div class="pt-4 flex justify-end">
                    <button class="bg-gradient-to-br from-primary to-primary-container text-white px-10 py-4 rounded-xl font-bold tracking-tight shadow-md shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all" type="submit">
                        Kirim Aspirasi
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Guidance Sidebar --}}
    <div class="lg:col-span-4 space-y-6">
        <div class="bg-surface-container-low rounded-xl p-6">
            <h3 class="font-bold text-on-surface flex items-center gap-2 mb-4">
                <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">lightbulb</span> Tips Pengajuan
            </h3>
            <ul class="space-y-4 text-sm text-on-surface-variant">
                <li class="flex gap-3"><span class="material-symbols-outlined text-sm text-green-500">check_circle</span><span>Lebih spesifik mengenai masalah dan solusi yang diusulkan.</span></li>
                <li class="flex gap-3"><span class="material-symbols-outlined text-sm text-green-500">check_circle</span><span>Lampirkan foto atau data untuk mendukung permintaanmu.</span></li>
                <li class="flex gap-3"><span class="material-symbols-outlined text-sm text-green-500">check_circle</span><span>Pilih kategori yang sesuai agar bisa diproses lebih cepat.</span></li>
            </ul>
        </div>
        <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm overflow-hidden relative group">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                <span class="material-symbols-outlined text-6xl">timeline</span>
            </div>
            <h3 class="font-bold text-on-surface mb-6 relative z-10">Apa yang terjadi selanjutnya?</h3>
            <div class="space-y-6 relative z-10">
                <div class="flex gap-4">
                    <div class="w-6 h-6 rounded-full bg-primary-fixed flex items-center justify-center text-[10px] font-bold text-primary">1</div>
                    <div><p class="text-xs font-bold">Fase Tinjauan</p><p class="text-[11px] text-on-surface-variant">Pengurus akan membaca dan meninjau dalam 48 jam.</p></div>
                </div>
                <div class="flex gap-4">
                    <div class="w-6 h-6 rounded-full bg-surface-container-high flex items-center justify-center text-[10px] font-bold text-outline">2</div>
                    <div><p class="text-xs font-bold text-outline">Dukungan Siswa</p><p class="text-[11px] text-on-surface-variant">Siswa bisa menyukai idemu (upvote).</p></div>
                </div>
                <div class="flex gap-4">
                    <div class="w-6 h-6 rounded-full bg-surface-container-high flex items-center justify-center text-[10px] font-bold text-outline">3</div>
                    <div><p class="text-xs font-bold text-outline">Implementasi</p><p class="text-[11px] text-on-surface-variant">Ide yang disetujui akan diwujudkan atau direalisasi.</p></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
