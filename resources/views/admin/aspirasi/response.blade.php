@extends('layouts.app')
@section('title', 'Tanggapi | SaranaKu')
@php $active = 'manage'; @endphp

@section('content')
{{-- Breadcrumbs --}}
<div class="flex items-center gap-2 text-on-surface-variant text-sm font-medium mb-8">
    <a href="{{ route('admin.aspirasi.index') }}" class="hover:text-primary">Kelola Aspirasi</a>
    <span class="material-symbols-outlined text-xs">chevron_right</span>
    <span class="text-primary font-semibold">ASP-{{ str_pad($aspirasi->id, 4, '0', STR_PAD_LEFT) }}</span>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    {{-- Left Column: Aspiration Details --}}
    <div class="lg:col-span-5 space-y-6">
        <div class="bg-surface-container-lowest rounded-xl p-6 editorial-shadow">
            <div class="flex items-center justify-between mb-4">
                <x-status-badge :status="$aspirasi->status" />
                <span class="text-xs text-on-surface-variant">{{ $aspirasi->created_at->format('M d, Y') }}</span>
            </div>
            <h2 class="text-2xl font-extrabold font-headline text-on-surface mb-4 leading-tight">{{ $aspirasi->judul }}</h2>
            <div class="text-on-surface-variant text-sm leading-relaxed mb-6">
                {!! nl2br(e($aspirasi->isi)) !!}
            </div>

            {{-- Meta Info --}}
            <div class="flex flex-wrap gap-3 pt-4 border-t border-surface-container text-xs text-on-surface-variant">
                <div class="flex items-center gap-1">
                    <span class="material-symbols-outlined text-xs">person</span>
                    {{ $aspirasi->is_anonim ? 'Anonim' : ($aspirasi->user->name ?? 'Tidak diketahui') }}
                </div>
                <div class="flex items-center gap-1">
                    <span class="material-symbols-outlined text-xs">category</span>
                    {{ $aspirasi->kategori->nama ?? '-' }}
                </div>
                <div class="flex items-center gap-1">
                    <span class="material-symbols-outlined text-xs">visibility</span>
                    {{ number_format($aspirasi->views_count) }} tayangan
                </div>
            </div>
        </div>

        {{-- Attachments --}}
        @if($aspirasi->lampiran->count())
            <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm">
                <h3 class="text-sm font-bold text-on-surface mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">attach_file</span>
                    Lampiran ({{ $aspirasi->lampiran->count() }})
                </h3>
                <div class="space-y-2">
                    @foreach($aspirasi->lampiran as $file)
                        <a href="{{ asset('storage/' . $file->path) }}" target="_blank"
                           class="flex items-center p-3 rounded-lg bg-surface-container-low hover:bg-surface-container-high transition-colors">
                            <span class="material-symbols-outlined text-primary mr-3">description</span>
                            <span class="text-sm font-medium truncate">{{ $file->nama_file }}</span>
                            <span class="ml-auto material-symbols-outlined text-slate-400">download</span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Past Responses --}}
        @if($aspirasi->tanggapan->count())
            <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm">
                <h3 class="text-sm font-bold text-on-surface mb-4">Tanggapan Sebelumnya</h3>
                <div class="space-y-4">
                    @foreach($aspirasi->tanggapan as $prev)
                        <div class="p-4 bg-surface-container-low rounded-lg border-l-2 border-primary">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-xs font-bold text-primary">{{ $prev->admin->name ?? 'Admin' }}</span>
                                <span class="text-[10px] text-on-surface-variant">{{ $prev->created_at->format('M d, Y') }}</span>
                            </div>
                            <p class="text-sm text-on-surface-variant italic">"{{ $prev->isi }}"</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    {{-- Right Column: Response Form --}}
    <div class="lg:col-span-7">
        <div class="bg-surface-container-lowest rounded-xl p-8 editorial-shadow">
            <h3 class="text-2xl font-bold font-headline text-on-surface mb-2">Tanggapan Pengurus</h3>
            <p class="text-on-surface-variant text-sm mb-8">Tulis tanggapan resmi Anda untuk aspirasi ini.</p>

            <form class="space-y-6" method="POST" action="{{ route('admin.aspirasi.storeResponse', $aspirasi) }}">
                @csrf
                {{-- Status & Priority --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-on-surface-variant">Perbarui Status</label>
                        <select name="status"
                                class="w-full bg-surface-container-highest border-0 rounded-lg px-4 py-4 text-on-surface focus:ring-2 focus:ring-primary outline-none">
                            <option value="pending" {{ $aspirasi->status === 'pending' ? 'selected' : '' }}>Menunggu</option>
                            <option value="diproses" {{ $aspirasi->status === 'diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="diterima" {{ $aspirasi->status === 'diterima' ? 'selected' : '' }}>Disetujui</option>
                            <option value="ditolak" {{ $aspirasi->status === 'ditolak' ? 'selected' : '' }}>Dikembalikan</option>
                        </select>
                        @error('status') <span class="text-error text-xs font-medium">{{ $message }}</span> @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-on-surface-variant">Atur Prioritas</label>
                        <select name="prioritas"
                                class="w-full bg-surface-container-highest border-0 rounded-lg px-4 py-4 text-on-surface focus:ring-2 focus:ring-primary outline-none">
                            <option value="rendah" {{ $aspirasi->prioritas === 'rendah' ? 'selected' : '' }}>Prioritas Rendah</option>
                            <option value="sedang" {{ $aspirasi->prioritas === 'sedang' ? 'selected' : '' }}>Prioritas Sedang</option>
                            <option value="tinggi" {{ $aspirasi->prioritas === 'tinggi' ? 'selected' : '' }}>Prioritas Tinggi</option>
                        </select>
                    </div>
                </div>

                {{-- Response Body --}}
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-on-surface-variant flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">edit_note</span> Pesan Tanggapan
                    </label>
                    <textarea name="isi"
                              class="w-full bg-surface-container-lowest border border-outline-variant/20 rounded-lg p-4 text-on-surface placeholder:text-outline focus:ring-2 focus:ring-primary outline-none resize-none"
                              placeholder="Tulis tanggapan mendetail dan umpan balik Anda di sini..." rows="8">{{ old('isi') }}</textarea>
                    @error('isi') <span class="text-error text-xs font-medium">{{ $message }}</span> @enderror
                </div>

                {{-- Internal Note Toggle --}}
                <div class="flex items-center justify-between p-4 bg-surface-container-low rounded-lg">
                    <div>
                        <span class="text-sm font-semibold">Tandai Sebagai Catatan Internal</span>
                        <p class="text-[10px] text-on-surface-variant">Hanya terlihat oleh admin, disembunyikan dari siswa.</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input class="sr-only peer" type="checkbox" name="is_internal" value="1" />
                        <div class="w-11 h-6 bg-outline-variant peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                    </label>
                </div>

                {{-- Submit Buttons --}}
                <div class="flex justify-end gap-3 pt-4">
                    <a href="{{ route('admin.aspirasi.index') }}" class="px-6 py-3 rounded-xl text-sm font-bold text-on-surface-variant hover:bg-surface-container-high transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                            class="bg-gradient-to-br from-primary to-primary-container text-white px-8 py-3 rounded-xl font-bold shadow-md shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg">send</span>
                        Kirim Tanggapan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
