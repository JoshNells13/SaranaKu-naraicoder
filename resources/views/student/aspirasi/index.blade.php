@extends('layouts.app')
@section('title', 'Aspirasi Saya | SaranaKu')
@php $active = 'my-aspirations'; @endphp

@section('content')
{{-- Summary Stats --}}
<section class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
    <div class="bg-surface-container-lowest p-6 rounded-2xl border border-outline-variant/10 shadow-sm">
        <p class="text-on-surface-variant text-xs font-bold uppercase tracking-widest mb-1">Total Diajukan</p>
        <h3 class="text-3xl font-black text-on-surface">{{ $totalSubmitted }}</h3>
    </div>
    <div class="bg-surface-container-lowest p-6 rounded-2xl border border-outline-variant/10 shadow-sm">
        <p class="text-blue-600 text-xs font-bold uppercase tracking-widest mb-1">Dalam Tinjauan</p>
        <h3 class="text-3xl font-black text-on-surface">{{ $inReview }}</h3>
    </div>
    <div class="bg-surface-container-lowest p-6 rounded-2xl border border-outline-variant/10 shadow-sm">
        <p class="text-green-600 text-xs font-bold uppercase tracking-widest mb-1">Selesai</p>
        <h3 class="text-3xl font-black text-on-surface">{{ $completed }}</h3>
    </div>
    <div class="bg-surface-container-lowest p-6 rounded-2xl border border-outline-variant/10 shadow-sm">
        <p class="text-tertiary text-xs font-bold uppercase tracking-widest mb-1">Menunggu Tindakan</p>
        <h3 class="text-3xl font-black text-on-surface">{{ $pending }}</h3>
    </div>
</section>

{{-- Aspiration List --}}
<div class="flex flex-col gap-6">
    @forelse($aspirasi as $item)
        @php
            $borderColors = ['diterima' => 'border-green-500', 'diproses' => 'border-blue-500', 'pending' => 'border-amber-500', 'ditolak' => 'border-rose-500'];
            $borderColor = $borderColors[$item->status] ?? 'border-slate-300';
        @endphp
        <div class="bg-surface-container-lowest p-6 rounded-2xl transition-all hover:bg-white hover:shadow-xl hover:shadow-blue-500/5 group flex flex-col md:flex-row md:items-center justify-between gap-6 border-l-4 {{ $borderColor }}">
            <div class="flex-grow">
                <div class="flex items-center gap-3 mb-2">
                    <x-status-badge :status="$item->status" />
                    <span class="text-on-surface-variant text-xs">Diajukan {{ $item->created_at->format('M d, Y') }}</span>
                </div>
                <h4 class="text-xl font-bold text-on-surface mb-1 group-hover:text-primary transition-colors">
                    <a href="{{ route('aspirasi.show', $item) }}">{{ $item->judul }}</a>
                </h4>
                <p class="text-on-surface-variant text-sm flex items-center gap-1">
                    <span class="material-symbols-outlined text-xs">{{ $item->kategori->icon ?? 'folder_open' }}</span>
                    {{ $item->kategori->nama ?? 'Tidak Berkategori' }}
                </p>
            </div>
            <div class="flex items-center gap-8">
                <div class="flex gap-4 items-center">
                    <div class="flex flex-col items-center bg-green-50 px-2 py-1 rounded-lg">
                        <span class="text-green-600 font-bold text-sm">{{ $item->upvotes_count }}</span>
                        <span class="text-green-600/60 text-[9px] uppercase font-bold tracking-tighter leading-none mt-0.5">Suka</span>
                    </div>
                    <div class="flex flex-col items-center bg-rose-50 px-2 py-1 rounded-lg">
                        <span class="text-rose-500 font-bold text-sm">{{ $item->downvotes_count }}</span>
                        <span class="text-rose-500/60 text-[9px] uppercase font-bold tracking-tighter leading-none mt-0.5">Ditolak</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <span class="text-on-surface font-bold text-sm">{{ number_format($item->views_count) }}</span>
                        <span class="text-on-surface-variant text-[9px] uppercase font-bold tracking-tighter leading-none mt-0.5">Tayangan</span>
                    </div>
                </div>
                <a href="{{ route('aspirasi.show', $item) }}"
                   class="bg-surface-container-high p-3 rounded-xl hover:bg-primary hover:text-white transition-all active:scale-95">
                    <span class="material-symbols-outlined">visibility</span>
                </a>
            </div>
        </div>
    @empty
        <div class="flex flex-col items-center justify-center py-24 text-center">
            <div class="w-64 h-64 mb-8 bg-slate-100 rounded-full flex items-center justify-center">
                <span class="material-symbols-outlined text-slate-300 text-8xl" style="font-variation-settings: 'wght' 200;">draw</span>
            </div>
            <h3 class="text-2xl font-bold text-on-surface mb-2">Belum ada aspirasi</h3>
            <p class="text-on-surface-variant max-w-sm mb-8">Siap memberikan dampak? Mulailah dengan mengajukan aspirasi pertamamu.</p>
            <a href="{{ route('aspirasi.create') }}" class="bg-primary text-white font-bold py-3 px-8 rounded-full shadow-xl shadow-primary/20">
                Buat Aspirasi Pertama
            </a>
        </div>
    @endforelse
</div>

{{-- Pagination --}}
@if($aspirasi->hasPages())
    <div class="mt-8">
        {{ $aspirasi->links() }}
    </div>
@endif
@endsection
