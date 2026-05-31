@extends('layouts.app')
@section('title', $aspirasi->judul . ' | SaranaKu')
@php $active = 'my-aspirations'; @endphp

@section('content')
{{-- Breadcrumbs & Status --}}
<div class="flex items-center justify-between mb-8">
    <div class="flex items-center gap-2 text-on-surface-variant text-sm font-medium">
        <a href="{{ route('aspirasi.index') }}" class="hover:text-primary">Aspirasi</a>
        <span class="material-symbols-outlined text-xs">chevron_right</span>
        <span class="text-primary font-semibold">ASP-{{ str_pad($aspirasi->id, 4, '0', STR_PAD_LEFT) }}</span>
    </div>
    <x-status-badge :status="$aspirasi->status" />
</div>

{{-- Content Grid --}}
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
    {{-- Left Column --}}
    <div class="lg:col-span-8 space-y-8">
        <section class="bg-surface-container-lowest rounded-xl p-8 editorial-shadow">
            <h2 class="text-3xl font-extrabold text-on-surface leading-tight tracking-tighter mb-6">{{ $aspirasi->judul }}</h2>
            <div class="prose prose-slate max-w-none text-on-surface-variant leading-relaxed space-y-4 font-body">
                {!! nl2br(e($aspirasi->isi)) !!}
            </div>

            {{-- Vote Widget --}}
            <div class="mt-8 pt-6 border-t border-surface-container"
                 x-data="{
                     upvotes: {{ $aspirasi->upvotes_count }},
                     downvotes: {{ $aspirasi->downvotes_count }},
                     score: {{ $aspirasi->upvotes_count - $aspirasi->downvotes_count }},
                     userVote: {{ $userVote ? "'" . $userVote . "'" : 'null' }},
                     loading: false,
                     async vote(type) {
                         if (this.loading) return;
                         this.loading = true;
                         try {
                             const res = await fetch('{{ route('vote.toggle', $aspirasi) }}', {
                                 method: 'POST',
                                 headers: {
                                     'Content-Type': 'application/json',
                                     'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                     'Accept': 'application/json'
                                 },
                                 body: JSON.stringify({ type })
                             });
                             const data = await res.json();
                             this.upvotes = data.upvotes;
                             this.downvotes = data.downvotes;
                             this.score = data.score;
                             this.userVote = data.userVote;
                         } catch (e) {
                             console.error('Vote failed:', e);
                         } finally {
                             this.loading = false;
                         }
                     }
                 }">
                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-2 bg-surface-container-low p-1 rounded-xl">
                        {{-- Upvote --}}
                        <button @click="vote('up')" :disabled="loading"
                                :class="userVote === 'up'
                                    ? 'bg-primary text-white shadow-md shadow-blue-500/20'
                                    : 'bg-surface-container-lowest text-on-surface-variant hover:bg-surface-container-high'"
                                class="flex items-center gap-2 px-4 py-2 rounded-lg transition-all duration-200 active:scale-95"
                                :style="loading ? 'opacity:0.6;cursor:wait' : ''">
                            <span class="material-symbols-outlined text-sm"
                                  :style="userVote === 'up' ? 'font-variation-settings: \'FILL\' 1' : ''">thumb_up</span>
                            <span class="text-xs font-bold" x-text="upvotes"></span>
                        </button>

                        <div class="w-px h-4 bg-outline-variant/30"></div>

                        {{-- Downvote --}}
                        <button @click="vote('down')" :disabled="loading"
                                :class="userVote === 'down'
                                    ? 'bg-rose-500 text-white shadow-md shadow-rose-500/20'
                                    : 'bg-surface-container-lowest text-on-surface-variant hover:bg-surface-container-high'"
                                class="flex items-center gap-2 px-4 py-2 rounded-lg transition-all duration-200 active:scale-95"
                                :style="loading ? 'opacity:0.6;cursor:wait' : ''">
                            <span class="material-symbols-outlined text-sm"
                                  :style="userVote === 'down' ? 'font-variation-settings: \'FILL\' 1' : ''">thumb_down</span>
                            <span class="text-xs font-bold" x-text="downvotes"></span>
                        </button>
                    </div>

                    <div class="flex gap-4 text-xs text-on-surface-variant font-medium">
                        <span class="flex items-center gap-1">
                            <span class="text-green-600 font-bold" x-text="upvotes"></span> disukai
                        </span>
                        <span class="w-1 h-1 bg-outline-variant/30 rounded-full"></span>
                        <span class="flex items-center gap-1">
                            <span class="text-rose-500 font-bold" x-text="downvotes"></span> ditolak
                        </span>
                    </div>
                </div>
            </div>

            @if($aspirasi->lampiran->count())
                <div class="mt-10 pt-8 border-t border-surface-container">
                    <h3 class="text-sm font-black uppercase tracking-widest text-on-surface-variant mb-4">Lampiran ({{ $aspirasi->lampiran->count() }})</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        @foreach($aspirasi->lampiran as $file)
                            <a href="{{ asset('storage/' . $file->path) }}" target="_blank"
                               class="flex items-center p-3 rounded-lg bg-surface-container-low hover:bg-surface-container-high transition-colors cursor-pointer group">
                                <span class="material-symbols-outlined text-red-500 mr-3">picture_as_pdf</span>
                                <div class="flex-1 overflow-hidden">
                                    <p class="text-sm font-semibold truncate">{{ $file->nama_file }}</p>
                                    <p class="text-[10px] text-on-surface-variant">{{ number_format($file->ukuran / 1024) }} KB • {{ strtoupper(pathinfo($file->nama_file, PATHINFO_EXTENSION)) }}</p>
                                </div>
                                <span class="material-symbols-outlined text-slate-400 group-hover:text-primary">download</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </section>

        {{-- Admin Responses --}}
        @if($aspirasi->tanggapan->count())
            <section class="space-y-6">
                <div class="flex items-center gap-4 px-2">
                    <h3 class="text-xl font-bold tracking-tight">Umpan Balik Pengurus</h3>
                    <div class="h-px bg-surface-container-high flex-1"></div>
                </div>
                <div class="space-y-4">
                    @foreach($aspirasi->tanggapan as $response)
                        <div class="bg-surface-container-lowest rounded-xl p-6 editorial-shadow relative overflow-hidden">
                            <div class="absolute left-0 top-0 bottom-0 w-1 bg-primary"></div>
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-full bg-primary-fixed flex items-center justify-center">
                                    <span class="text-xs font-bold text-primary">{{ strtoupper(substr($response->admin->name ?? 'A', 0, 2)) }}</span>
                                </div>
                                <div class="flex-1">
                                    <div class="flex justify-between items-start mb-2">
                                        <div>
                                            <h4 class="font-bold text-on-surface">{{ $response->admin->name ?? 'Admin' }}</h4>
                                            <p class="text-xs text-primary font-semibold">Administrator</p>
                                        </div>
                                        <span class="text-xs text-on-surface-variant">{{ $response->created_at->format('M d, Y') }}</span>
                                    </div>
                                    <p class="text-on-surface-variant text-sm leading-relaxed italic">"{{ $response->isi }}"</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    </div>

    {{-- Right Column: Timeline --}}
    <aside class="lg:col-span-4 space-y-6">
        <div class="bg-surface-container-low rounded-xl p-6">
            <h3 class="text-sm font-black uppercase tracking-widest text-on-surface-variant mb-6">Linimasa Aktivitas</h3>
            <div class="relative space-y-8">
                <div class="absolute left-3 top-2 bottom-2 w-0.5 bg-outline-variant/30"></div>
                {{-- Submitted --}}
                <div class="relative flex gap-4 items-start pl-8">
                    <div class="absolute left-0 w-6 h-6 rounded-full bg-primary flex items-center justify-center text-white z-10">
                        <span class="material-symbols-outlined text-xs" style="font-variation-settings: 'FILL' 1;">check</span>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-on-surface">Diajukan</p>
                        <p class="text-xs text-on-surface-variant">{{ $aspirasi->created_at->format('M d, Y • h:i A') }}</p>
                    </div>
                </div>
                @foreach($aspirasi->tanggapan as $t)
                    <div class="relative flex gap-4 items-start pl-8">
                        <div class="absolute left-0 w-6 h-6 rounded-full bg-white border-2 border-primary flex items-center justify-center z-10">
                            <div class="w-2 h-2 rounded-full bg-primary animate-pulse"></div>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-primary">Tanggapan Diberikan</p>
                            <p class="text-xs text-on-surface-variant">{{ $t->created_at->format('M d, Y • h:i A') }}</p>
                        </div>
                    </div>
                @endforeach
                @if($aspirasi->status !== 'diterima')
                    <div class="relative flex gap-4 items-start pl-8 opacity-40">
                        <div class="absolute left-0 w-6 h-6 rounded-full bg-outline-variant/30 flex items-center justify-center z-10"></div>
                        <div>
                            <p class="text-sm font-bold text-on-surface">Persetujuan Akhir</p>
                            <p class="text-xs text-on-surface-variant">Menunggu</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        {{-- Submitter Info --}}
        @if(!$aspirasi->is_anonim)
            <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm">
                <h3 class="text-sm font-black uppercase tracking-widest text-on-surface-variant mb-4">Diajukan Oleh</h3>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-primary-fixed flex items-center justify-center">
                        <span class="text-xs font-bold text-primary">{{ strtoupper(substr($aspirasi->user->name, 0, 2)) }}</span>
                    </div>
                    <div>
                        <p class="font-bold text-on-surface">{{ $aspirasi->user->name }}</p>
                        <p class="text-xs text-on-surface-variant">{{ $aspirasi->user->kelas ?? '' }} {{ $aspirasi->user->jurusan ? '• ' . $aspirasi->user->jurusan : '' }}</p>
                    </div>
                </div>
            </div>
        @endif
    </aside>
</div>
@endsection
