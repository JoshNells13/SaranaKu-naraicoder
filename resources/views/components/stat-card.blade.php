@props(['icon', 'label', 'value', 'badge' => '', 'color' => 'primary'])

@php
    $colorClasses = [
        'primary' => 'bg-primary/5 text-primary bg-primary-fixed text-on-primary-fixed',
        'secondary' => 'bg-secondary-container/20 text-secondary bg-secondary-container text-on-secondary-container',
        'tertiary' => 'bg-tertiary-fixed/30 text-tertiary bg-tertiary-fixed text-on-tertiary-fixed-variant',
    ];
    $bgClass = explode(' ', $colorClasses[$color] ?? $colorClasses['primary']);
@endphp

<div class="bg-surface-container-lowest p-6 rounded-xl shadow-[0px_4px_32px_rgba(0,0,0,0.04)] border-none flex flex-col gap-4 relative overflow-hidden group">
    <div class="absolute top-0 right-0 w-24 h-24 {{ $bgClass[0] }} rounded-bl-full -mr-8 -mt-8 transition-transform group-hover:scale-110"></div>
    <div class="flex items-center justify-between">
        <span class="material-symbols-outlined {{ $bgClass[1] }}">{{ $icon }}</span>
        @if($badge)
            <span class="text-xs font-bold px-2 py-1 {{ $bgClass[2] }} {{ $bgClass[3] }} rounded-md uppercase tracking-wider">{{ $badge }}</span>
        @endif
    </div>
    <div>
        <div class="text-4xl font-extrabold font-headline text-on-surface">{{ $value }}</div>
        <div class="text-sm font-semibold text-on-surface-variant mt-1">{{ $label }}</div>
    </div>
</div>
