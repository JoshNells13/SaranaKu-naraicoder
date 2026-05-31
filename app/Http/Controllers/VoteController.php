<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function toggle(Aspirasi $aspirasi, Request $request)
    {
        $request->validate(['type' => 'required|in:up,down']);

        $userId = auth()->id();
        $existingVote = Vote::where('user_id', $userId)
            ->where('aspirasi_id', $aspirasi->id)
            ->first();

        if ($existingVote) {
            if ($existingVote->type === $request->type) {
                // Same vote type clicked again → remove vote (unlike/undislike)
                $existingVote->delete();
                $userVote = null;
            } else {
                // Different vote type → switch vote
                $existingVote->update(['type' => $request->type]);
                $userVote = $request->type;
            }
        } else {
            // No existing vote → create new
            Vote::create([
                'user_id' => $userId,
                'aspirasi_id' => $aspirasi->id,
                'type' => $request->type,
            ]);
            $userVote = $request->type;
        }

        $upvotes = $aspirasi->votes()->where('type', 'up')->count();
        $downvotes = $aspirasi->votes()->where('type', 'down')->count();

        return response()->json([
            'upvotes' => $upvotes,
            'downvotes' => $downvotes,
            'score' => $upvotes - $downvotes,
            'userVote' => $userVote,
        ]);
    }
}
