@extends('layouts.app')

@php $active = 'notifikasi'; @endphp

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Notifikasi</h2>
            <p class="text-slate-500 text-sm">Lihat semua pemberitahuan untuk Anda</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="divide-y divide-slate-100">
            @forelse($notifications as $notif)
                <div class="p-4 hover:bg-slate-50 transition-colors flex items-start gap-4 {{ !$notif->is_read ? 'bg-slate-100/50' : '' }}" 
                     onclick="markAsRead('{{ $notif->id }}', '{{ $notif->data['url'] ?? '#' }}')"
                     style="cursor: pointer;">
                    <div class="w-10 h-10 rounded-full bg-neutral-100 flex items-center justify-center flex-shrink-0 text-black">
                        <span class="material-symbols-outlined">
                            {{ $notif->tipe === 'aspirasi' ? 'chat' : 'notifications' }}
                        </span>
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between items-start">
                            <h3 class="font-semibold text-slate-800 {{ !$notif->is_read ? 'font-bold' : '' }}">
                                {{ $notif->judul }}
                            </h3>
                            <span class="text-xs text-slate-400">{{ $notif->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-sm text-slate-600 mt-1">{{ $notif->pesan }}</p>
                    </div>
                    @if(!$notif->is_read)
                        <div class="w-2 h-2 rounded-full bg-black self-center"></div>
                    @endif
                </div>
            @empty
                <div class="p-12 text-center">
                    <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-400">
                        <span class="material-symbols-outlined text-3xl">notifications_off</span>
                    </div>
                    <p class="text-slate-500">Tidak ada notifikasi untuk saat ini.</p>
                </div>
            @endforelse
        </div>
        @if($notifications->hasPages())
            <div class="p-4 border-t border-slate-100">
                {{ $notifications->links() }}
            </div>
        @endif
    </div>
</div>

<script>
function markAsRead(id, url) {
    fetch(`/notifikasi/${id}`, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    }).then(response => {
        if (url && url !== '#') {
            window.location.href = url;
        } else {
            window.location.reload();
        }
    });
}
</script>
@endsection
