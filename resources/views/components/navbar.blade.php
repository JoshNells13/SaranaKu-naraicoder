@php
    $user = auth()->user();
    $unreadCount = $user ? $user->notifikasi()->unread()->count() : 0;
@endphp

<header class="fixed top-0 right-0 left-0 md:left-64 z-50 bg-white/70 backdrop-blur-xl shadow-sm h-16 px-6 flex justify-between items-center">
    <div class="flex items-center gap-4">
        <span class="text-xl font-bold tracking-tighter text-blue-700 font-headline">SaranaKu</span>
        <div class="hidden md:flex items-center gap-6 ml-4">
            <a class="font-manrope tracking-tight text-sm text-slate-500 hover:bg-slate-100 transition-colors p-2 rounded-lg" href="#">Bantuan</a>
            <a class="font-manrope tracking-tight text-sm text-slate-500 hover:bg-slate-100 transition-colors p-2 rounded-lg" href="#">Dokumentasi</a>
        </div>
    </div>
    <div class="flex items-center gap-4">
        <div class="flex items-center gap-2">
            {{-- Notifications --}}
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="p-2 text-slate-500 hover:bg-slate-100 rounded-full transition-colors cursor-pointer active:scale-95 transition-transform relative">
                    <span class="material-symbols-outlined">notifications</span>
                    @if($unreadCount > 0)
                        <span class="absolute top-1 right-1 w-4 h-4 bg-error text-white text-[9px] font-bold rounded-full flex items-center justify-center">{{ $unreadCount > 9 ? '9+' : $unreadCount }}</span>
                    @endif
                </button>
                <div x-show="open" @click.away="open = false" x-transition
                     class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-xl border border-slate-100 overflow-hidden z-50">
                    <div class="p-4 border-b border-slate-100">
                        <h3 class="font-bold text-sm">Notifikasi</h3>
                    </div>
                    <div class="max-h-64 overflow-y-auto">
                        @if($user)
                            @forelse($user->notifikasi()->latest()->take(5)->get() as $notif)
                                <div class="px-4 py-3 hover:bg-slate-50 {{ !$notif->is_read ? 'bg-primary-fixed/20' : '' }}">
                                    <p class="text-sm font-semibold">{{ $notif->judul }}</p>
                                    <p class="text-xs text-slate-500">{{ $notif->pesan }}</p>
                                    <p class="text-[10px] text-slate-400 mt-1">{{ $notif->created_at->diffForHumans() }}</p>
                                </div>
                            @empty
                                <div class="px-4 py-8 text-center text-slate-400 text-sm">Tidak ada notifikasi</div>
                            @endforelse
                        @endif
                    </div>
                </div>
            </div>

            <button class="p-2 text-slate-500 hover:bg-slate-100 rounded-full transition-colors cursor-pointer active:scale-95 transition-transform">
                <span class="material-symbols-outlined">settings</span>
            </button>
        </div>
        @if($user)
            <div class="h-8 w-8 rounded-full overflow-hidden border border-outline-variant cursor-pointer bg-primary-fixed flex items-center justify-center">
                @if($user->avatar)
                    <img alt="User profile" class="h-full w-full object-cover" src="{{ asset('storage/' . $user->avatar) }}" />
                @else
                    <span class="text-xs font-bold text-primary">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                @endif
            </div>
        @endif
    </div>
</header>
