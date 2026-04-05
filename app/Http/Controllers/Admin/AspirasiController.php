<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreResponseRequest;
use App\Models\Aspirasi;
use App\Models\Notifikasi;
use App\Models\Tanggapan;

class AspirasiController extends Controller
{
    public function index()
    {
        $query = Aspirasi::with(['user', 'kategori']);

        if (request('status') && request('status') !== 'all') {
            $query->where('status', request('status'));
        }

        if (request('kategori') && request('kategori') !== 'all') {
            $query->where('kategori_id', request('kategori'));
        }

        if (request('search')) {
            $query->where('judul', 'like', '%' . request('search') . '%');
        }

        $aspirasi = $query->latest()->paginate(15);

        $totalPending = Aspirasi::where('status', 'pending')->count();

        return view('admin.aspirasi.index', compact('aspirasi', 'totalPending'));
    }

    public function response(Aspirasi $aspirasi)
    {
        $aspirasi->load(['user', 'kategori', 'lampiran', 'tanggapan.admin']);

        return view('admin.aspirasi.response', compact('aspirasi'));
    }

    public function storeResponse(StoreResponseRequest $request, Aspirasi $aspirasi)
    {
        Tanggapan::create([
            'aspirasi_id' => $aspirasi->id,
            'admin_id' => auth()->id(),
            'isi' => $request->isi,
            'is_internal' => $request->boolean('is_internal'),
        ]);

        $aspirasi->update([
            'status' => $request->status,
            'prioritas' => $request->prioritas ?? $aspirasi->prioritas,
        ]);

        // Notify the student
        Notifikasi::create([
            'user_id' => $aspirasi->user_id,
            'judul' => 'Tanggapan Baru',
            'pesan' => 'Aspirasi "' . $aspirasi->judul . '" telah mendapat tanggapan dari admin.',
            'tipe' => 'response',
            'data' => ['aspirasi_id' => $aspirasi->id],
        ]);

        return redirect()->route('admin.aspirasi.index')
            ->with('success', 'Tanggapan berhasil dikirim!');
    }

    public function updateStatus(Aspirasi $aspirasi)
    {
        $aspirasi->update(['status' => request('status')]);

        return response()->json(['success' => true, 'status' => $aspirasi->status]);
    }
}
