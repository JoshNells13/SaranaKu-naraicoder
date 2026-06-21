@extends('layouts.app')
@section('title', 'Kelola Murid | SaranaKu')
@php $active = 'students'; @endphp

@section('content')
{{-- Header --}}
<div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
    <div>
        <span class="text-primary font-bold text-xs uppercase tracking-widest">Manajemen Pengguna</span>
        <h1 class="text-4xl md:text-5xl font-extrabold font-headline text-on-surface leading-none tracking-tight mt-2 mb-3">Kelola Akun Murid</h1>
        <p class="text-on-surface-variant text-base max-w-2xl leading-relaxed">
            Tambahkan, ubah, dan kelola informasi akun murid yang terdaftar di sistem.
        </p>
    </div>
    <div>
        <a href="{{ route('admin.students.create') }}"
           class="bg-primary text-white font-bold py-3.5 px-6 rounded-2xl shadow-md shadow-primary/20 flex items-center gap-2 hover:brightness-110 active:scale-95 transition-all text-sm">
            <span class="material-symbols-outlined text-lg">person_add</span>
            Tambah Murid
        </a>
    </div>
</div>

{{-- Filter Bar --}}
<div class="bg-surface-container-lowest rounded-xl p-5 mb-8 shadow-sm flex flex-col md:flex-row gap-4 md:items-center justify-between">
    <form method="GET" action="{{ route('admin.students.index') }}" class="flex flex-wrap gap-4 items-center flex-1">
        <div class="relative flex-1 min-w-[240px]">
            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
            <input class="w-full pl-12 pr-4 py-3 bg-surface-container-low border-none rounded-xl text-sm text-on-surface placeholder:text-outline focus:ring-2 focus:ring-primary transition-all"
                   name="search" value="{{ request('search') }}" placeholder="Cari nama atau email..." type="text" />
        </div>
        
        <select name="kelas" class="bg-surface-container-low border-none rounded-xl px-4 py-3 text-sm font-medium focus:ring-2 focus:ring-primary">
            <option value="all">Semua Kelas</option>
            @foreach($classes as $class)
                <option value="{{ $class }}" {{ request('kelas') === $class ? 'selected' : '' }}>{{ $class }}</option>
            @endforeach
        </select>

        <select name="jurusan" class="bg-surface-container-low border-none rounded-xl px-4 py-3 text-sm font-medium focus:ring-2 focus:ring-primary">
            <option value="all">Semua Jurusan</option>
            @foreach($majors as $major)
                <option value="{{ $major }}" {{ request('jurusan') === $major ? 'selected' : '' }}>{{ $major }}</option>
            @endforeach
        </select>

        <button type="submit" class="bg-primary text-white font-bold px-5 py-3 rounded-xl hover:brightness-110 transition-all text-sm flex items-center gap-1">
            <span class="material-symbols-outlined text-sm">filter_alt</span>
            Filter
        </button>
        @if(request('search') || (request('kelas') && request('kelas') !== 'all') || (request('jurusan') && request('jurusan') !== 'all'))
            <a href="{{ route('admin.students.index') }}" class="text-sm font-semibold text-rose-600 hover:underline px-2 py-3">Reset</a>
        @endif
    </form>
</div>

{{-- Data Table --}}
<div class="bg-surface-container-lowest rounded-xl paper-shadow overflow-x-auto">
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b border-surface-container text-on-surface-variant text-xs font-bold uppercase tracking-widest">
                <th class="text-left px-6 py-4">Nama Lengkap</th>
                <th class="text-left px-4 py-4">Email</th>
                <th class="text-left px-4 py-4">Kelas</th>
                <th class="text-left px-4 py-4">Jurusan</th>
                <th class="text-left px-4 py-4 hidden md:table-cell">Terdaftar Pada</th>
                <th class="text-right px-6 py-4">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-surface-container">
            @forelse($students as $student)
                <tr class="hover:bg-surface-container-low transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-primary-fixed flex items-center justify-center shrink-0">
                                @if($student->avatar)
                                    <img alt="User profile" class="h-full w-full object-cover rounded-full" src="{{ asset('storage/' . $student->avatar) }}" />
                                @else
                                    <span class="text-xs font-bold text-primary">{{ strtoupper(substr($student->name, 0, 2)) }}</span>
                                @endif
                            </div>
                            <span class="font-bold text-on-surface text-sm">{{ $student->name }}</span>
                        </div>
                    </td>
                    <td class="px-4 py-4 text-on-surface-variant">{{ $student->email }}</td>
                    <td class="px-4 py-4">
                        <span class="text-xs bg-surface-container-high text-on-surface font-semibold px-2.5 py-1 rounded-md">{{ $student->kelas }}</span>
                    </td>
                    <td class="px-4 py-4">
                        <span class="text-xs bg-surface-container-high text-on-surface font-semibold px-2.5 py-1 rounded-md">{{ $student->jurusan }}</span>
                    </td>
                    <td class="px-4 py-4 hidden md:table-cell text-xs text-on-surface-variant">{{ $student->created_at->format('M d, Y') }}</td>
                    <td class="px-6 py-4 text-right flex justify-end gap-2">
                        <a href="{{ route('admin.students.edit', $student) }}"
                           class="bg-primary/10 text-primary hover:bg-primary hover:text-white p-2 rounded-lg transition-all inline-flex text-sm font-bold"
                           title="Ubah">
                            <span class="material-symbols-outlined text-sm">edit</span>
                        </a>
                        <form action="{{ route('admin.students.destroy', $student) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun murid ini? Semua aspirasi, komentar, dan voting yang dikirimkan oleh murid ini akan ikut terhapus secara permanen.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-rose-500/10 text-rose-500 hover:bg-rose-500 hover:text-white p-2 rounded-lg transition-all inline-flex text-sm font-bold"
                                    title="Hapus">
                                <span class="material-symbols-outlined text-sm">delete</span>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-16 text-center text-on-surface-variant">
                        <span class="material-symbols-outlined text-4xl text-slate-300 mb-2">group</span>
                        <p class="text-sm font-semibold">Tidak ada data murid ditemukan</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Pagination --}}
@if($students->hasPages())
    <div class="mt-8 flex justify-center">
        {{ $students->links() }}
    </div>
@endif
@endsection
