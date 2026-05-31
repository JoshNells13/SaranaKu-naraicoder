@props(['href', 'icon', 'label', 'active' => false, 'badge' => 0])

<a href="{{ $href }}"
   class="{{ $active
       ? 'bg-blue-600 text-white rounded-lg px-4 py-2.5 shadow-md shadow-blue-500/20 font-semibold text-sm flex items-center gap-3 transition-all duration-200 ease-in-out'
       : 'text-slate-600 hover:bg-slate-200 rounded-lg px-4 py-2.5 font-semibold text-sm flex items-center gap-3 transition-all duration-200 ease-in-out' }}">
    <span class="material-symbols-outlined text-[20px]" @if($active) style="font-variation-settings: 'FILL' 1;" @endif>{{ $icon }}</span>
    <span class="flex-1">{{ $label }}</span>
    @if(($badge ?? 0) > 0)
        <span class="bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full min-w-[18px] text-center">
            {{ $badge > 9 ? '9+' : $badge }}
        </span>
    @endif
</a>
