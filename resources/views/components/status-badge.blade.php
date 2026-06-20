@props(['status'])

@php
    $styles = [
        'pending' => 'bg-amber-100 text-amber-700',
        'diproses' => 'bg-blue-100 text-blue-700',
        'diterima' => 'bg-emerald-100 text-emerald-700',
        'ditolak' => 'bg-rose-100 text-rose-700',
        'menunggu_persetujuan_atasan' => 'bg-purple-100 text-purple-700',
    ];
    $labels = [
        'pending' => 'Menunggu',
        'diproses' => 'Diproses',
        'diterima' => 'Disetujui',
        'ditolak' => 'Dikembalikan',
        'menunggu_persetujuan_atasan' => 'Menunggu Atasan',
    ];
@endphp

<span class="{{ $styles[$status] ?? 'bg-slate-100 text-slate-700' }} text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">
    {{ $labels[$status] ?? $status }}
</span>
