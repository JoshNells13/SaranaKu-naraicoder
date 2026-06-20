<?php

namespace App\Http\Controllers\Atasan;

use App\Http\Controllers\Controller;
use App\Models\Aspirasi;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSubmissions = Aspirasi::count();
        $pendingReview = Aspirasi::where('status', 'menunggu_persetujuan_atasan')->count();
        $approved = Aspirasi::where('status', 'diterima')->count();
        $returned = Aspirasi::where('status', 'ditolak')->count();

        $recentSubmissions = Aspirasi::with(['user', 'kategori'])
            ->where('status', 'menunggu_persetujuan_atasan')
            ->latest()
            ->take(5)
            ->get();

        return view('atasan.dashboard', compact(
            'totalSubmissions', 'pendingReview', 'approved', 'returned',
            'recentSubmissions'
        ));
    }
}
