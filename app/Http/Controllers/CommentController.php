<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Aspirasi;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, Aspirasi $aspirasi)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        // Prevent deeply nested replies (max 1 level depth)
        if ($request->filled('parent_id')) {
            $parent = Comment::find($request->parent_id);
            if ($parent && $parent->parent_id !== null) {
                return back()->with('error', 'Balasan hanya diperbolehkan hingga 1 tingkat.');
            }
        }

        $comment = new Comment();
        $comment->body = $request->body;
        $comment->user_id = auth()->id();
        $comment->aspirasi_id = $aspirasi->id;
        $comment->parent_id = $request->parent_id;
        $comment->save();

        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }
}
