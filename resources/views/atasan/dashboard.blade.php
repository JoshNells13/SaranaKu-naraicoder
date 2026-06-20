@extends('layouts.app')
@section('title', 'Dasbor Atasan | SaranaKu')
@php $active = 'dashboard'; @endphp

@section('content')
    {{-- Header --}}
    <div class="mb-12 flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
            <span class="text-primary font-bold text-xs uppercase tracking-widest">Pusat Atasan</span>
            <h1
                class="text-4xl md:text-5xl font-extrabold font-headline text-on-surface leading-none tracking-tight mt-2 mb-3">
                Dasbor Analitik</h1>
            <p class="text-on-surface-variant text-base max-w-2xl leading-relaxed">
                Pantau sistem, tinjau pengajuan, dan berikan persetujuan akhir dari pusat kontrol Anda.
            </p>
        </div>
        <div class="flex gap-3 items-center">
            <a href="{{ route('atasan.aspirasi.index') }}"
                class="bg-primary text-white font-bold py-3 px-6 rounded-xl shadow-md shadow-primary/20 flex items-center gap-2 hover:brightness-110 active:scale-95 transition-all">
                <span class="material-symbols-outlined text-lg">approval</span>
                Persetujuan Aspirasi
            </a>
        </div>
    </div>

    {{-- Summary Bento Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
        <x-stat-card icon="edit_document" label="Total Pengajuan" :value="$totalSubmissions" badge="Semua Waktu"
            color="primary" />
        <x-stat-card icon="pending" label="Menunggu Tinjauan" :value="$pendingReview" badge="Tindakan" color="secondary" />
        <x-stat-card icon="verified" label="Ide Disetujui" :value="$approved" badge="Disetujui" color="tertiary" />
        <div
            class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border-none flex flex-col gap-4 relative overflow-hidden group">
            <div class="flex items-center justify-between">
                <span class="material-symbols-outlined text-rose-500">undo</span>
                <span
                    class="text-xs font-bold px-2 py-1 bg-rose-100 text-rose-700 rounded-md uppercase tracking-wider">Dikembalikan</span>
            </div>
            <div>
                <div class="text-4xl font-extrabold font-headline text-on-surface">{{ $returned }}</div>
                <div class="text-sm font-semibold text-on-surface-variant mt-1">Draf Dikembalikan</div>
            </div>
        </div>
    </div>

    {{-- Two Column Layout --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Recent Submissions --}}
        <div class="lg:col-span-2">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-bold font-headline text-on-surface tracking-tight">Menunggu Persetujuan</h2>
                <a href="{{ route('atasan.aspirasi.index') }}"
                    class="text-sm font-semibold text-primary flex items-center gap-1 hover:underline">
                    Lihat Semua <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>
            <div class="bg-surface-container-lowest rounded-xl paper-shadow overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr
                            class="border-b border-surface-container text-on-surface-variant text-xs font-bold uppercase tracking-widest">
                            <th class="text-left px-6 py-4">Pengajuan</th>
                            <th class="text-left px-4 py-4 hidden md:table-cell">Pembuat</th>
                            <th class="text-left px-4 py-4 hidden md:table-cell">Status</th>
                            <th class="text-left px-4 py-4"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-container">
                        @foreach($recentSubmissions as $item)
                            <tr class="hover:bg-surface-container-low transition-colors">
                                <td class="px-6 py-4">
                                    <p class="font-bold text-on-surface truncate max-w-xs">{{ $item->judul }}</p>
                                    <p class="text-xs text-on-surface-variant">{{ $item->created_at->format('M d, Y') }}</p>
                                </td>
                                <td class="px-4 py-4 hidden md:table-cell">
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 rounded-full bg-primary-fixed flex items-center justify-center">
                                            <span
                                                class="text-[9px] font-bold text-primary">{{ strtoupper(substr($item->user->name ?? 'A', 0, 2)) }}</span>
                                        </div>
                                        <span class="text-sm">{{ $item->user->name ?? 'Anonymous' }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4 hidden md:table-cell">
                                    <x-status-badge :status="$item->status" />
                                </td>
                                <td class="px-4 py-4 text-right">
                                    <a href="{{ route('atasan.aspirasi.show', $item) }}"
                                        class="bg-surface-container-low hover:bg-primary hover:text-white p-2 rounded-lg transition-all inline-flex">
                                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection