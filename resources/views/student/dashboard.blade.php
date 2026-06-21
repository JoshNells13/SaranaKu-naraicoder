@extends('layouts.app')
@section('title', 'Dasbor Murid | SaranaKu')
@php $active = 'dashboard'; @endphp

@section('content')
    {{-- Header Section --}}
    <div class="mb-10">
        <h1 class="text-4xl font-extrabold tracking-tight font-headline text-on-surface mb-2">Selamat datang kembali,
            {{ $user->name }}.</h1>
        <p class="text-on-surface-variant font-body">Lacak kontribusi Anda dan jelajahi ide-ide komunitas untuk kemajuan
            sekolah.</p>
    </div>

    {{-- Summary Bento Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <x-stat-card icon="auto_awesome_motion" label="Aspirasi Diajukan" :value="$totalAspirations" badge="Total"
            color="primary" />
        <x-stat-card icon="pending" label="Sedang Diproses" :value="$inProgress" badge="Tinjauan" color="secondary" />
        <x-stat-card icon="verified" label="Berhasil Selesai" :value="$completed" badge="Sukses" color="tertiary" />
    </div>

    {{-- Trending Section --}}
    <div class="mb-6 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold font-headline text-on-surface">Aspirasi Populer</h2>
            <p class="text-sm text-on-surface-variant mt-1">Inisiatif komunitas yang kini mendapatkan perhatian.</p>
        </div>
        <a href="{{ route('aspirasi.semua') }}"
            class="text-sm font-bold text-primary flex items-center gap-1 hover:underline">
            Lihat Semua <span class="material-symbols-outlined text-sm">arrow_forward</span>
        </a>
    </div>

    {{-- Asymmetric Cards Layout --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @foreach($trending as $index => $item)
            @php
                $currentUserVote = $userVotes[$item->id] ?? null;
            @endphp

            @if($index < 3)
                <div
                    class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-[0px_4px_32px_rgba(0,0,0,0.04)] border-none hover:translate-y-[-4px] transition-transform duration-300 {{ $index === 1 ? 'md:mt-12' : '' }}">
                    <div class="p-8 {{ $index === 2 ? 'h-full flex flex-col' : '' }}">
                        <div class="flex items-center justify-between mb-4">
                            <x-status-badge :status="$item->status" />
                            <div class="flex items-center gap-2 text-on-surface-variant text-xs">
                                <span
                                    class="material-symbols-outlined text-sm">{{ $index === 2 ? 'schedule' : 'visibility' }}</span>
                                {{ $index === 2 ? $item->created_at->diffForHumans() : number_format($item->views_count) . ' tayangan' }}
                            </div>
                        </div>
                        <h3 class="text-xl font-bold font-headline mb-3">
                            <a href="{{ route('aspirasi.show', $item) }}"
                                class="hover:text-primary transition-colors">{{ $item->judul }}</a>
                        </h3>
                        <p class="text-on-surface-variant text-sm mb-6 leading-relaxed">{{ Str::limit($item->isi, 120) }}</p>

                        {{-- Vote Component --}}
                        <div class="{{ $index === 2 ? 'mt-auto ' : '' }}flex items-center justify-between" x-data="{
                                         upvotes: {{ $item->upvotes_count }},
                                         downvotes: {{ $item->downvotes_count }},
                                         score: {{ $item->upvotes_count - $item->downvotes_count }},
                                         userVote: {{ $currentUserVote ? "'" . $currentUserVote . "'" : 'null' }},
                                         loading: false,
                                         async vote(type) {
                                             if (this.loading) return;
                                             this.loading = true;
                                             try {
                                                 const res = await fetch('{{ route('vote.toggle', $item) }}', {
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
                            <div class="flex items-center gap-2 bg-surface-container-low p-1 rounded-xl">
                                {{-- Upvote Button --}}
                                <button @click="vote('up')" :disabled="loading"
                                    :class="userVote === 'up'
                                                    ? 'bg-primary text-white shadow-md shadow-black/20'
                                                    : 'bg-surface-container-lowest text-on-surface-variant hover:bg-surface-container-high'"
                                    class="flex items-center gap-2 px-3 py-2 rounded-lg transition-all duration-200 active:scale-95"
                                    :style="loading ? 'opacity:0.6;cursor:wait' : ''">
                                    <span class="material-symbols-outlined text-sm"
                                        :style="userVote === 'up' ? 'font-variation-settings: \'FILL\' 1' : ''">thumb_up</span>
                                    <span class="text-xs font-bold" x-text="upvotes"></span>
                                </button>

                                <div class="w-px h-4 bg-outline-variant/30"></div>

                                {{-- Downvote Button --}}
                                <button @click="vote('down')" :disabled="loading"
                                    :class="userVote === 'down'
                                                    ? 'bg-rose-500 text-white shadow-md shadow-rose-500/20'
                                                    : 'bg-surface-container-lowest text-on-surface-variant hover:bg-surface-container-high'"
                                    class="flex items-center gap-2 px-3 py-2 rounded-lg transition-all duration-200 active:scale-95"
                                    :style="loading ? 'opacity:0.6;cursor:wait' : ''">
                                    <span class="material-symbols-outlined text-sm"
                                        :style="userVote === 'down' ? 'font-variation-settings: \'FILL\' 1' : ''">thumb_down</span>
                                    <span class="text-xs font-bold" x-text="downvotes"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

        {{-- CTA Card --}}
        <div
            class="bg-gradient-to-br from-primary to-primary-container p-8 rounded-xl flex flex-col justify-center items-center text-center text-white {{ $trending->count() > 2 ? 'md:mt-12' : '' }}">
            <span class="material-symbols-outlined text-5xl mb-4"
                style="font-variation-settings: 'FILL' 1;">lightbulb</span>
            <h3 class="text-2xl font-extrabold font-headline mb-2 leading-tight">Punya ide brilian untuk kemajuan sekolah?
            </h3>
            <p class="text-white/80 text-sm mb-8 max-w-xs">Suara Anda penting. Ajukan aspirasi dan bantu wujudkan lingkungan
                belajar yang lebih baik.</p>
            <a href="{{ route('aspirasi.create') }}"
                class="bg-white text-primary px-8 py-3 rounded-full font-bold shadow-xl hover:scale-105 transition-transform active:scale-95">
                Aspirasi Baru
            </a>
        </div>
    </div>
@endsection