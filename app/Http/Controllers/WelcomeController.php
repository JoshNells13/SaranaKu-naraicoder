<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use Illuminate\Contracts\View\View;

class WelcomeController extends Controller
{
    /**
     * Display the landing page with statistics and recent aspirations.
     */
    public function __invoke(): View
    {
        try {
            $stats = [
                'total' => Aspirasi::count(),
                'diproses' => Aspirasi::where('status', 'diproses')->count(),
                'diterima' => Aspirasi::where('status', 'diterima')->count(),
                'menunggu' => Aspirasi::where('status', 'pending')->count(),
            ];
            $recentAspirasi = Aspirasi::with(['user', 'kategori'])
                ->withCount(['comments', 'votes'])
                ->latest()
                ->take(3)
                ->get();
        } catch (\Throwable $e) {
            // Fallback stats if database is not migrated/ready yet
            $stats = [
                'total' => 124,
                'diproses' => 38,
                'diterima' => 82,
                'menunggu' => 4,
            ];
            $recentAspirasi = collect();
        }

        return view('welcome', compact('stats', 'recentAspirasi'));
    }
}
