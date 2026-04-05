<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;

class NotifikasiController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifikasi()->latest()->paginate(20);
        return view('notifikasi.index', compact('notifications'));
    }

    public function markAsRead(Notifikasi $notifikasi)
    {
        $notifikasi->update(['is_read' => true]);
        return response()->json(['success' => true]);
    }
}
