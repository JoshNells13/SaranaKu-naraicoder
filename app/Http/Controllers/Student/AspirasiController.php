<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAspirasiRequest;
use App\Models\Aspirasi;
use App\Models\Kategori;
use App\Models\Lampiran;
use App\Models\Notifikasi;

class AspirasiController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $totalSubmitted = $user->aspirasi()->count();
        $inReview = $user->aspirasi()->where('status', 'diproses')->count();
        $completed = $user->aspirasi()->where('status', 'diterima')->count();
        $pending = $user->aspirasi()->where('status', 'pending')->count();

        $aspirasi = $user->aspirasi()
            ->with('kategori')
            ->withCount(['upvotes', 'downvotes'])
            ->latest()
            ->paginate(10);

        return view('student.aspirasi.index', compact(
            'aspirasi', 'totalSubmitted', 'inReview', 'completed', 'pending'
        ));
    }

    public function semua()
    {
        $aspirasi = Aspirasi::with('kategori', 'user')
            ->withCount(['upvotes', 'downvotes'])
            ->latest()
            ->paginate(10);

        return view('student.aspirasi.semua', compact('aspirasi'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('student.aspirasi.create', compact('kategori'));
    }

    public function store(StoreAspirasiRequest $request)
    {
        $aspirasi = Aspirasi::create([
            'user_id' => auth()->id(),
            'kategori_id' => $request->kategori_id,
            'judul' => $request->judul,
            'isi' => $request->isi,
            'is_anonim' => $request->boolean('is_anonim'),
            'status' => 'pending',
        ]);

        if ($request->hasFile('lampiran')) {
            foreach ($request->file('lampiran') as $file) {
                $path = $file->store('lampiran', 'public');
                Lampiran::create([
                    'aspirasi_id' => $aspirasi->id,
                    'nama_file' => $file->getClientOriginalName(),
                    'path' => $path,
                    'tipe' => $file->getClientMimeType(),
                    'ukuran' => $file->getSize(),
                ]);
            }
        }

        return redirect()->route('aspirasi.index')
            ->with('success', 'Aspirasi berhasil disubmit!');
    }

    public function show(Aspirasi $aspirasi)
    {
        $aspirasi->incrementViews();

        $aspirasi->load([
            'user', 'kategori', 'lampiran',
            'tanggapan' => fn($q) => $q->where('is_internal', false)->with('admin'),
            'comments' => fn($q) => $q->whereNull('parent_id')->with(['user', 'replies.user'])->latest(),
        ]);

        $aspirasi->loadCount(['upvotes', 'downvotes']);

        // Mark related notifications as read
        Notifikasi::where('user_id', auth()->id())
            ->where('is_read', false)
            ->where('data->aspirasi_id', $aspirasi->id)
            ->update(['is_read' => true]);

        $userVote = \App\Models\Vote::where('user_id', auth()->id())
            ->where('aspirasi_id', $aspirasi->id)
            ->value('type');

        return view('student.aspirasi.show', compact('aspirasi', 'userVote'));
    }
}
