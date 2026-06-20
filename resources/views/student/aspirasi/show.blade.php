@extends('layouts.app')
@section('title', $aspirasi->judul . ' | SaranaKu')
@php $active = 'my-aspirations'; @endphp

@section('content')
    {{-- Breadcrumbs & Status --}}
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ url()->previous() }}"
            class="w-10 h-10 rounded-full bg-surface-container-lowest border border-surface-container hover:bg-surface-container-low transition-all flex items-center justify-center text-on-surface-variant shrink-0 shadow-sm active:scale-95">
            <span class="material-symbols-outlined text-[20px]">arrow_back</span>
        </a>
        <div class="flex-1 flex items-center justify-between">

            <x-status-badge :status="$aspirasi->status" />
        </div>
    </div>

    {{-- Content Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        {{-- Left Column --}}
        <div class="lg:col-span-8 space-y-8">
            <section class="bg-surface-container-lowest rounded-xl p-8 editorial-shadow">
                <h2 class="text-3xl font-extrabold text-on-surface leading-tight tracking-tighter mb-6">
                    {{ $aspirasi->judul }}</h2>
                <div class="prose prose-slate max-w-none text-on-surface-variant leading-relaxed space-y-4 font-body">
                    {!! nl2br(e($aspirasi->isi)) !!}
                </div>

                {{-- Vote Widget --}}
                <div class="mt-8 pt-6 border-t border-surface-container" x-data="{
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
                        <h3 class="text-sm font-black uppercase tracking-widest text-on-surface-variant mb-4">Lampiran
                            ({{ $aspirasi->lampiran->count() }})</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @foreach($aspirasi->lampiran as $file)
                                <a href="{{ asset('storage/' . $file->path) }}" target="_blank"
                                    class="flex items-center p-3 rounded-lg bg-surface-container-low hover:bg-surface-container-high transition-colors cursor-pointer group">
                                    <span class="material-symbols-outlined text-red-500 mr-3">picture_as_pdf</span>
                                    <div class="flex-1 overflow-hidden">
                                        <p class="text-sm font-semibold truncate">{{ $file->nama_file }}</p>
                                        <p class="text-[10px] text-on-surface-variant">{{ number_format($file->ukuran / 1024) }} KB
                                            • {{ strtoupper(pathinfo($file->nama_file, PATHINFO_EXTENSION)) }}</p>
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
                                        <span
                                            class="text-xs font-bold text-primary">{{ strtoupper(substr($response->admin->name ?? 'A', 0, 2)) }}</span>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex justify-between items-start mb-2">
                                            <div>
                                                <h4 class="font-bold text-on-surface">{{ $response->admin->name ?? 'Admin' }}</h4>
                                                <p class="text-xs text-primary font-semibold">Administrator</p>
                                            </div>
                                            <span
                                                class="text-xs text-on-surface-variant">{{ $response->created_at->format('M d, Y') }}</span>
                                        </div>
                                        <p class="text-on-surface-variant text-sm leading-relaxed italic">"{{ $response->isi }}"</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

            {{-- Diskusi / Komentar Siswa --}}
            <section class="mt-12 space-y-6" x-data="{ replyTo: null }">
                <div class="flex items-center gap-4 px-2">
                    <h3 class="text-xl font-bold tracking-tight">Diskusi Siswa</h3>
                    <div class="h-px bg-surface-container-high flex-1"></div>
                </div>

                {{-- Form Komentar Utama --}}
                <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm mb-8">
                    <form action="{{ route('comments.store', $aspirasi) }}" method="POST">
                        @csrf
                        <div class="flex gap-4">
                            <div class="w-10 h-10 shrink-0 rounded-full bg-primary-fixed flex items-center justify-center">
                                <span
                                    class="text-xs font-bold text-primary">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</span>
                            </div>
                            <div class="flex-1 space-y-3">
                                <textarea name="body" rows="3" required
                                    class="w-full bg-surface-container-low border-0 rounded-xl px-4 py-3 text-sm text-on-surface focus:ring-2 focus:ring-primary placeholder:text-on-surface-variant/60 resize-none"
                                    placeholder="Tulis komentar atau pendapatmu di sini..."></textarea>
                                <div class="flex justify-end">
                                    <button type="submit"
                                        class="bg-primary text-white px-6 py-2 rounded-lg text-sm font-bold shadow-md shadow-primary/20 hover:brightness-110 active:scale-95 transition-all">
                                        Kirim Komentar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- Daftar Komentar --}}
                <div class="space-y-6">
                    @forelse($aspirasi->comments as $comment)
                        <div class="flex gap-4">
                            <div
                                class="w-10 h-10 shrink-0 rounded-full bg-surface-container-highest flex items-center justify-center">
                                <span
                                    class="text-xs font-bold text-on-surface-variant">{{ strtoupper(substr($comment->user->name ?? 'A', 0, 2)) }}</span>
                            </div>
                            <div class="flex-1">
                                <div
                                    class="bg-surface-container-lowest rounded-xl rounded-tl-none p-4 shadow-sm border border-surface-container-low">
                                    <div class="flex items-center justify-between mb-1">
                                        <h5 class="text-sm font-bold text-on-surface">{{ $comment->user->name ?? 'Siswa' }}</h5>
                                        <span
                                            class="text-[10px] text-on-surface-variant">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-sm text-on-surface-variant leading-relaxed">{{ $comment->body }}</p>
                                </div>

                                {{-- Tombol Balas --}}
                                <div class="mt-2 ml-2 flex items-center gap-4 text-xs font-semibold text-on-surface-variant">
                                    <button type="button"
                                        @click="replyTo = replyTo === {{ $comment->id }} ? null : {{ $comment->id }}"
                                        class="hover:text-primary transition-colors flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[14px]">reply</span> Balas
                                    </button>
                                </div>

                                {{-- Form Balasan (Inline) --}}
                                <div x-show="replyTo === {{ $comment->id }}" x-transition class="mt-4 flex gap-3"
                                    style="display: none;">
                                    <div
                                        class="w-8 h-8 shrink-0 rounded-full bg-primary-fixed flex items-center justify-center">
                                        <span
                                            class="text-[10px] font-bold text-primary">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</span>
                                    </div>
                                    <div class="flex-1">
                                        <form action="{{ route('comments.store', $aspirasi) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                            <div class="flex flex-col gap-2">
                                                <textarea name="body" rows="2" required
                                                    class="w-full bg-surface-container-low border-0 rounded-lg px-3 py-2 text-xs text-on-surface focus:ring-2 focus:ring-primary placeholder:text-on-surface-variant/60 resize-none"
                                                    placeholder="Tulis balasanmu..."></textarea>
                                                <div class="flex justify-end gap-2">
                                                    <button type="button" @click="replyTo = null"
                                                        class="px-3 py-1.5 rounded text-xs font-bold text-on-surface-variant hover:bg-surface-container-high transition-colors">Batal</button>
                                                    <button type="submit"
                                                        class="bg-primary text-white px-4 py-1.5 rounded text-xs font-bold shadow-md shadow-primary/20 hover:brightness-110 transition-all">Kirim
                                                        Balasan</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                {{-- Daftar Balasan --}}
                                @if($comment->replies->count() > 0)
                                    <div class="mt-4 space-y-4 border-l-2 border-surface-container-high pl-4 ml-2">
                                        @foreach($comment->replies as $reply)
                                            <div class="flex gap-3">
                                                <div
                                                    class="w-8 h-8 shrink-0 rounded-full bg-surface-container-highest flex items-center justify-center">
                                                    <span
                                                        class="text-[10px] font-bold text-on-surface-variant">{{ strtoupper(substr($reply->user->name ?? 'A', 0, 2)) }}</span>
                                                </div>
                                                <div class="flex-1">
                                                    <div class="bg-surface-container-low rounded-lg rounded-tl-none p-3">
                                                        <div class="flex items-center justify-between mb-1">
                                                            <h5 class="text-xs font-bold text-on-surface">
                                                                {{ $reply->user->name ?? 'Siswa' }}</h5>
                                                            <span
                                                                class="text-[9px] text-on-surface-variant">{{ $reply->created_at->diffForHumans() }}</span>
                                                        </div>
                                                        <p class="text-xs text-on-surface-variant leading-relaxed">{{ $reply->body }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <span class="material-symbols-outlined text-4xl text-outline-variant mb-2">forum</span>
                            <p class="text-sm text-on-surface-variant">Jadilah yang pertama memulai diskusi ini!</p>
                        </div>
                    @endforelse
                </div>
            </section>
        </div>

        {{-- Right Column: Timeline --}}
        <aside class="lg:col-span-4 space-y-6">
            <div class="bg-surface-container-low rounded-xl p-6">
                <h3 class="text-sm font-black uppercase tracking-widest text-on-surface-variant mb-6">Linimasa Aktivitas
                </h3>
                <div class="relative space-y-8">
                    <div class="absolute left-3 top-2 bottom-2 w-0.5 bg-outline-variant/30"></div>
                    {{-- Submitted --}}
                    <div class="relative flex gap-4 items-start pl-8">
                        <div
                            class="absolute left-0 w-6 h-6 rounded-full bg-primary flex items-center justify-center text-white z-10">
                            <span class="material-symbols-outlined text-xs"
                                style="font-variation-settings: 'FILL' 1;">check</span>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-on-surface">Diajukan</p>
                            <p class="text-xs text-on-surface-variant">{{ $aspirasi->created_at->format('M d, Y • h:i A') }}
                            </p>
                        </div>
                    </div>
                    @foreach($aspirasi->tanggapan as $t)
                        <div class="relative flex gap-4 items-start pl-8">
                            <div
                                class="absolute left-0 w-6 h-6 rounded-full bg-white border-2 border-primary flex items-center justify-center z-10">
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
                            <div
                                class="absolute left-0 w-6 h-6 rounded-full bg-outline-variant/30 flex items-center justify-center z-10">
                            </div>
                            <div>
                                <p class="text-sm font-bold text-on-surface">Persetujuan Akhir</p>
                                <p class="text-xs text-on-surface-variant">Menunggu</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            @if($aspirasi->estimasi_waktu)
                <div
                    class="bg-surface-container-lowest border border-purple-500/30 rounded-xl p-6 shadow-sm relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-4 opacity-10">
                        <span class="material-symbols-outlined text-6xl text-purple-600"
                            style="font-variation-settings: 'FILL' 1;">calendar_month</span>
                    </div>
                    <h3 class="text-sm font-black uppercase tracking-widest text-purple-600 mb-2">Estimasi Penyelesaian</h3>
                    <div class="flex flex-col gap-1">
                        <p class="font-bold text-2xl text-on-surface">{{ $aspirasi->estimasi_waktu->format('d M Y') }}</p>
                        <p class="text-xs text-on-surface-variant">{{ $aspirasi->estimasi_waktu->format('H:i') }} WIB</p>
                    </div>
                </div>
            @endif

            {{-- Submitter Info --}}
            @if(!$aspirasi->is_anonim)
                <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm">
                    <h3 class="text-sm font-black uppercase tracking-widest text-on-surface-variant mb-4">Diajukan Oleh</h3>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-primary-fixed flex items-center justify-center">
                            <span
                                class="text-xs font-bold text-primary">{{ strtoupper(substr($aspirasi->user->name, 0, 2)) }}</span>
                        </div>
                        <div>
                            <p class="font-bold text-on-surface">{{ $aspirasi->user->name }}</p>
                            <p class="text-xs text-on-surface-variant">{{ $aspirasi->user->kelas ?? '' }}
                                {{ $aspirasi->user->jurusan ? '• ' . $aspirasi->user->jurusan : '' }}</p>
                        </div>
                    </div>
                </div>
            @endif
        </aside>
    </div>
@endsection