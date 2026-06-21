@props(['href', 'icon', 'label', 'active' => false, 'badge' => 0])

<a href="{{ $href }}"
   class="relative flex items-center gap-3 rounded-lg py-2.5 font-semibold text-sm transition-all duration-300 ease-in-out group {{ $active ? 'bg-black text-white shadow-md' : 'text-slate-600 hover:bg-slate-200' }}"
   :class="sidebarOpen ? 'px-4 justify-start' : 'px-0 justify-center'">
    
    <span class="material-symbols-outlined text-[20px] shrink-0" @if($active) style="font-variation-settings: 'FILL' 1;" @endif>{{ $icon }}</span>
    
    <span x-show="sidebarOpen" 
          x-transition:enter="transition-all duration-200 ease-out delay-70"
          x-transition:enter-start="opacity-0 translate-x-[-10px]"
          x-transition:enter-end="opacity-100 translate-x-0"
          x-transition:leave="transition-all duration-100 ease-in"
          x-transition:leave-start="opacity-100 translate-x-0"
          x-transition:leave-end="opacity-0 translate-x-[-10px]"
          class="font-headline tracking-tight whitespace-nowrap overflow-hidden text-ellipsis flex-1">
        {{ $label }}
    </span>

    @if(($badge ?? 0) > 0)
        <span x-show="sidebarOpen" 
              x-transition:enter="transition-all duration-200 ease-out delay-70"
              x-transition:enter-start="opacity-0 scale-95"
              x-transition:enter-end="opacity-100 scale-100"
              class="bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full min-w-[18px] text-center shrink-0">
            {{ $badge > 9 ? '9+' : $badge }}
        </span>
        <span x-show="!sidebarOpen" 
              class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full border border-white">
        </span>
    @endif
</a>
