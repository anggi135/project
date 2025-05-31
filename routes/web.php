<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

// Home
Route::get('/', fn () => view('home'));
Route::get('/about', fn () => view('about'));

// Halaman artikel
Route::get('/threats', function () {
    $comments = Comment::where('page', 'threats')->latest()->get();
    return view('threats', compact('comments'));
});

Route::get('/defense', function () {
    $comments = Comment::where('page', 'defense')->latest()->get();
    return view('defense', compact('comments'));
});

// Autentikasi
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/register', [AuthController::class, 'signupForm'])->name('register');
Route::post('/register', [AuthController::class, 'signup'])->name('register.submit');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Komentar
Route::post('/comment', function (Request $request) {
    $request->validate([
        'page' => 'required|string',
        'comment' => 'required|string',
    ]);

    if (!Auth::check()) {
        return redirect()->back()->with('error', 'Silakan login terlebih dahulu.');
    }

    Comment::create([
        'page' => $request->page,
        'comment' => $request->comment,
        'user_id' => Auth::id(),
    ]);

    return redirect()->back()->with('success', 'Komentar berhasil dikirim.');
})->name('comment.store');

