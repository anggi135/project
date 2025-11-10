<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
            'page' => 'required|string|max:50',
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'page' => $request->page,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Komentar berhasil dikirim!');
    }
}
