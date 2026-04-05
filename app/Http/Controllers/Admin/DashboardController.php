<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aspirasi;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSubmissions = Aspirasi::count();
        $pendingReview = Aspirasi::where('status', 'pending')->count();
        $approved = Aspirasi::where('status', 'diterima')->count();
        $returned = Aspirasi::where('status', 'ditolak')->count();

        $recentSubmissions = Aspirasi::with(['user', 'kategori'])
            ->latest()
            ->take(5)
            ->get();

        // Category breakdown
        $categories = Aspirasi::selectRaw('kategori_id, COUNT(*) as total')
            ->groupBy('kategori_id')
            ->with('kategori')
            ->get();

        $totalForPercentage = max($categories->sum('total'), 1);
        $categoryBreakdown = $categories->map(function ($item) use ($totalForPercentage) {
            return [
                'nama' => $item->kategori->nama ?? 'Unknown',
                'total' => $item->total,
                'percentage' => round(($item->total / $totalForPercentage) * 100),
            ];
        })->sortByDesc('percentage')->take(4);

        return view('admin.dashboard', compact(
            'totalSubmissions', 'pendingReview', 'approved', 'returned',
            'recentSubmissions', 'categoryBreakdown'
        ));
    }
}
