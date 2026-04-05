<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Aspirasi;
use App\Models\Vote;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $totalAspirations = $user->aspirasi()->count();
        $inProgress = $user->aspirasi()->where('status', 'diproses')->count();
        $completed = $user->aspirasi()->where('status', 'diterima')->count();

        $trending = Aspirasi::with(['user', 'kategori'])
            ->withCount(['upvotes', 'downvotes'])
            ->orderByRaw('(upvotes_count * 2 + views_count) DESC')
            ->take(4)
            ->get();

        // Get user's votes for the trending aspirations so we can show active state
        $userVotes = Vote::where('user_id', $user->id)
            ->whereIn('aspirasi_id', $trending->pluck('id'))
            ->pluck('type', 'aspirasi_id')
            ->toArray();

        return view('student.dashboard', compact(
            'user', 'totalAspirations', 'inProgress', 'completed', 'trending', 'userVotes'
        ));
    }
}
