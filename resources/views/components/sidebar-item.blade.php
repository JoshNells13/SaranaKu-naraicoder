@props(['href', 'icon', 'label', 'active' => false])

<a href="{{ $href }}"
   class="{{ $active
       ? 'bg-blue-600 text-white rounded-lg px-4 py-2.5 shadow-md shadow-blue-500/20 font-semibold text-sm flex items-center gap-3 transition-all duration-200 ease-in-out'
       : 'text-slate-600 hover:bg-slate-200 rounded-lg px-4 py-2.5 font-semibold text-sm flex items-center gap-3 transition-all duration-200 ease-in-out' }}">
    <span class="material-symbols-outlined text-[20px]" @if($active) style="font-variation-settings: 'FILL' 1;" @endif>{{ $icon }}</span>
    {{ $label }}
</a>
