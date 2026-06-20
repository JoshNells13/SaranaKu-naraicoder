<?php

namespace App\Http\Controllers\Atasan;

use App\Http\Controllers\Controller;
use App\Models\Aspirasi;
use App\Models\Notifikasi;
use Illuminate\Http\Request;

class AspirasiController extends Controller
{
    public function index()
    {
        $query = Aspirasi::with(['user', 'kategori']);

        if (request('status') && request('status') !== 'all') {
            $query->where('status', request('status'));
        } else {
            // Default to showing those needing approval or already handled by atasan
            $query->whereIn('status', ['menunggu_persetujuan_atasan', 'diterima', 'ditolak']);
        }

        if (request('kategori') && request('kategori') !== 'all') {
            $query->where('kategori_id', request('kategori'));
        }

        if (request('search')) {
            $query->where('judul', 'like', '%' . request('search') . '%');
        }

        $aspirasi = $query->latest()->paginate(15);

        $totalPending = Aspirasi::where('status', 'menunggu_persetujuan_atasan')->count();

        return view('atasan.aspirasi.index', compact('aspirasi', 'totalPending'));
    }

    public function show(Aspirasi $aspirasi)
    {
        $aspirasi->load(['user', 'kategori', 'lampiran', 'tanggapan.admin']);

        return view('atasan.aspirasi.show', compact('aspirasi'));
    }

    public function updateStatus(Request $request, Aspirasi $aspirasi)
    {
        $request->validate([
            'status' => 'required|in:diterima,ditolak,diproses',
            'estimasi_waktu' => 'nullable|date',
        ]);

        $aspirasi->update([
            'status' => $request->status,
            'estimasi_waktu' => $request->estimasi_waktu,
        ]);

        // Notify the student
        Notifikasi::create([
            'user_id' => $aspirasi->user_id,
            'judul' => 'Pembaruan Status Aspirasi',
            'pesan' => 'Status aspirasi "' . $aspirasi->judul . '" telah diperbarui menjadi ' . $request->status . '.',
            'tipe' => 'status_update',
            'data' => [
                'aspirasi_id' => $aspirasi->id,
                'url' => route('aspirasi.show', $aspirasi->id)
            ],
        ]);

        return redirect()->route('atasan.aspirasi.index')
            ->with('success', 'Status aspirasi berhasil diperbarui!');
    }
}
