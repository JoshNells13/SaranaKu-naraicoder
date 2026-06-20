@extends('layouts.app')
@section('title', 'Persetujuan Aspirasi | SaranaKu')
@php $active = 'approval'; @endphp

@section('content')
{{-- Header --}}
<div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
    <div>
        <span class="text-primary font-bold text-xs uppercase tracking-widest">Pusat Atasan</span>
        <h1 class="text-4xl md:text-5xl font-extrabold font-headline text-on-surface leading-none tracking-tight mt-2 mb-3">Persetujuan Aspirasi</h1>
        <p class="text-on-surface-variant text-base max-w-2xl leading-relaxed">
            Tinjau dan berikan persetujuan akhir serta estimasi waktu untuk aspirasi yang diteruskan admin.
        </p>
    </div>
    @if($totalPending > 0)
        <div class="bg-amber-50 border border-amber-200 rounded-xl px-5 py-3 flex items-center gap-3 text-amber-800">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">notification_important</span>
            <span class="text-sm font-bold">{{ $totalPending }} menunggu tinjauan</span>
        </div>
    @endif
</div>

{{-- Filter Bar --}}
<div class="bg-surface-container-lowest rounded-xl p-5 mb-8 shadow-sm flex flex-col md:flex-row gap-4 md:items-center justify-between">
    <form method="GET" action="{{ route('atasan.aspirasi.index') }}" class="flex flex-wrap gap-4 items-center flex-1">
        <div class="relative flex-1 min-w-[240px]">
            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
            <input class="w-full pl-12 pr-4 py-3 bg-surface-container-low border-none rounded-xl text-sm text-on-surface placeholder:text-outline focus:ring-2 focus:ring-primary transition-all"
                   name="search" value="{{ request('search') }}" placeholder="Cari aspirasi..." type="text" />
        </div>
        <select name="status" class="bg-surface-container-low border-none rounded-xl px-4 py-3 text-sm font-medium focus:ring-2 focus:ring-primary">
            <option value="all">Semua Status</option>
            <option value="menunggu_persetujuan_atasan" {{ request('status') === 'menunggu_persetujuan_atasan' ? 'selected' : '' }}>Menunggu Atasan</option>
            <option value="diterima" {{ request('status') === 'diterima' ? 'selected' : '' }}>Disetujui</option>
            <option value="ditolak" {{ request('status') === 'ditolak' ? 'selected' : '' }}>Dikembalikan</option>
        </select>
        <button type="submit" class="bg-primary text-white font-bold px-5 py-3 rounded-xl hover:brightness-110 transition-all text-sm">
            Filter
        </button>
    </form>
</div>

{{-- Data Table --}}
<div class="bg-surface-container-lowest rounded-xl paper-shadow overflow-x-auto">
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b border-surface-container text-on-surface-variant text-xs font-bold uppercase tracking-widest">
                <th class="text-left px-6 py-4">ID</th>
                <th class="text-left px-4 py-4">Pengajuan</th>
                <th class="text-left px-4 py-4 hidden md:table-cell">Pembuat</th>
                <th class="text-left px-4 py-4 hidden lg:table-cell">Kategori</th>
                <th class="text-left px-4 py-4">Status</th>
                <th class="text-left px-4 py-4 hidden md:table-cell">Tanggal</th>
                <th class="text-left px-4 py-4">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-surface-container">
            @forelse($aspirasi as $item)
                <tr class="hover:bg-surface-container-low transition-colors">
                    <td class="px-6 py-4 text-xs text-on-surface-variant font-mono">#{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}</td>
                    <td class="px-4 py-4">
                        <p class="font-bold text-on-surface truncate max-w-[200px]">{{ $item->judul }}</p>
                        <p class="text-xs text-on-surface-variant truncate max-w-[200px]">{{ Str::limit($item->isi, 50) }}</p>
                    </td>
                    <td class="px-4 py-4 hidden md:table-cell">
                        <div class="flex items-center gap-2">
                            <div class="w-6 h-6 rounded-full bg-primary-fixed flex items-center justify-center">
                                <span class="text-[9px] font-bold text-primary">{{ strtoupper(substr($item->user->name ?? 'A', 0, 2)) }}</span>
                            </div>
                            <span class="text-sm">{{ $item->is_anonim ? 'Anonim' : ($item->user->name ?? '-') }}</span>
                        </div>
                    </td>
                    <td class="px-4 py-4 hidden lg:table-cell">
                        <span class="text-xs bg-surface-container-low px-3 py-1 rounded-full font-semibold">{{ $item->kategori->nama ?? '-' }}</span>
                    </td>
                    <td class="px-4 py-4"><x-status-badge :status="$item->status" /></td>
                    <td class="px-4 py-4 hidden md:table-cell text-xs text-on-surface-variant">{{ $item->created_at->format('M d, Y') }}</td>
                    <td class="px-4 py-4 flex items-center gap-2">
                        <a href="{{ route('atasan.aspirasi.show', $item) }}"
                           class="bg-primary/10 text-primary hover:bg-primary hover:text-white p-2 rounded-lg transition-all inline-flex text-sm font-bold"
                           title="Tinjau">
                            <span class="material-symbols-outlined text-sm">visibility</span>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-6 py-16 text-center text-on-surface-variant">
                        <span class="material-symbols-outlined text-4xl text-slate-300 mb-2">inbox</span>
                        <p class="text-sm font-semibold">Tidak ada aspirasi ditemukan</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Pagination --}}
@if($aspirasi->hasPages())
    <div class="mt-8 flex justify-center">
        {{ $aspirasi->appends(request()->query())->links() }}
    </div>
@endif
@endsection
