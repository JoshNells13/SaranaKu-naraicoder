@extends('layouts.app')
@section('title', 'Semua Aspirasi | SaranaKu')
@php $active = 'all-aspirations'; @endphp

@section('content')
<div class="mb-8">
    <h2 class="text-3xl font-black text-on-surface mb-2">Semua Aspirasi</h2>
    <p class="text-on-surface-variant">Jelajahi seluruh aspirasi yang telah diajukan oleh siswa-siswa SaranaKu.</p>
</div>

{{-- Aspiration List --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($aspirasi as $item)
        @php
            $borderColors = ['diterima' => 'border-green-500', 'diproses' => 'border-slate-400', 'pending' => 'border-amber-500', 'ditolak' => 'border-rose-500', 'menunggu_persetujuan_atasan' => 'border-purple-500'];
            $borderColor = $borderColors[$item->status] ?? 'border-slate-300';
        @endphp
        <div class="bg-surface-container-lowest p-6 rounded-2xl transition-all hover:bg-white hover:shadow-xl hover:-translate-y-1 group flex flex-col justify-between border-t-4 {{ $borderColor }} relative overflow-hidden h-full">
            <div class="flex-grow">
                <div class="flex items-center justify-between mb-4">
                    <x-status-badge :status="$item->status" />
                    <span class="text-on-surface-variant text-xs font-medium">{{ $item->created_at->format('M d, Y') }}</span>
                </div>
                
                <h4 class="text-xl font-bold font-headline text-on-surface mb-2 group-hover:text-primary transition-colors line-clamp-2">
                    <a href="{{ route('aspirasi.show', $item) }}" class="focus:outline-none">
                        <span class="absolute inset-0" aria-hidden="true"></span>
                        {{ $item->judul }}
                    </a>
                </h4>
                
                <p class="text-on-surface-variant text-sm mb-4 line-clamp-3">
                    {{ Str::limit($item->isi, 120) }}
                </p>

                <div class="flex flex-wrap gap-2 mb-6 mt-auto">
                    <span class="text-xs font-semibold px-2 py-1 bg-surface-container-low rounded-md flex items-center gap-1 text-on-surface-variant">
                        <span class="material-symbols-outlined text-[14px]">{{ $item->kategori->icon ?? 'category' }}</span>
                        {{ $item->kategori->nama ?? 'Tidak Berkategori' }}
                    </span>
                    <span class="text-xs font-semibold px-2 py-1 bg-surface-container-low rounded-md flex items-center gap-1 text-on-surface-variant">
                        <span class="material-symbols-outlined text-[14px]">person</span>
                        {{ $item->is_anonim ? 'Anonim' : ($item->user->name ?? 'Anonim') }}
                    </span>
                </div>
            </div>

            <div class="flex items-center justify-between pt-4 border-t border-surface-container mt-auto">
                <div class="flex gap-4 items-center">
                    <div class="flex items-center gap-1 text-green-600 bg-green-50 px-2 py-1 rounded-md" title="Suka">
                        <span class="material-symbols-outlined text-[14px]">thumb_up</span>
                        <span class="font-bold text-xs">{{ $item->upvotes_count }}</span>
                    </div>
                    <div class="flex items-center gap-1 text-rose-500 bg-rose-50 px-2 py-1 rounded-md" title="Ditolak">
                        <span class="material-symbols-outlined text-[14px]">thumb_down</span>
                        <span class="font-bold text-xs">{{ $item->downvotes_count }}</span>
                    </div>
                    <div class="flex items-center gap-1 text-on-surface-variant bg-surface-container-low px-2 py-1 rounded-md" title="Tayangan">
                        <span class="material-symbols-outlined text-[14px]">visibility</span>
                        <span class="font-bold text-xs">{{ number_format($item->views_count) }}</span>
                    </div>
                </div>
                <div class="w-8 h-8 rounded-full bg-primary/10 text-primary flex items-center justify-center group-hover:bg-primary group-hover:text-white transition-colors">
                    <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-1 md:col-span-2 lg:col-span-3 flex flex-col items-center justify-center py-24 text-center">
            <div class="w-48 h-48 mb-8 bg-slate-100 rounded-full flex items-center justify-center">
                <span class="material-symbols-outlined text-slate-300 text-8xl" style="font-variation-settings: 'wght' 200;">draw</span>
            </div>
            <h3 class="text-2xl font-bold font-headline text-on-surface mb-2">Belum ada aspirasi</h3>
            <p class="text-on-surface-variant max-w-sm mb-8">Belum ada satupun aspirasi yang diajukan dalam sistem.</p>
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
