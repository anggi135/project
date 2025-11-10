<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FuzzController;
use App\Http\Controllers\PentestApiController;
use App\Http\Controllers\UrlCheckController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// =============================
// Halaman Utama & Info
// =============================
Route::get('/', fn () => view('home'));

// Halaman artikel dengan komentar
Route::get('/threats', function () {
    $comments = Comment::where('page', 'threats')->latest()->get();
    return view('threats', compact('comments'));
});

Route::get('/defense', function () {
    $comments = Comment::where('page', 'defense')->latest()->get();
    return view('defense', compact('comments'));
});

// =============================
// Autentikasi (Login & Register)
// =============================
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/register', [AuthController::class, 'signupForm'])->name('register');
Route::post('/register', [AuthController::class, 'signup'])->name('register.submit');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// =============================
// Komentar
// =============================
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

// =============================
// Modul URL Fuzzing
// =============================



Route::middleware(['auth'])->prefix('fuzz')->group(function () {
    // index & create
    Route::get('/', [FuzzController::class, 'index'])->name('fuzz.index');
    Route::post('/create', [FuzzController::class, 'create'])->name('fuzz.create');

    // Hapus semua — harus didefinisikan sebelum route parameter {id}
    Route::delete('/delete-all', [FuzzController::class, 'destroyAll'])->name('fuzz.destroyAll');

    // Hapus satu job (batasi id hanya angka)
    Route::delete('/{id}', [FuzzController::class, 'destroy'])->whereNumber('id')->name('fuzz.destroy');

    // Show & progress (batasi id angka)
    Route::get('/{id}', [FuzzController::class, 'show'])->whereNumber('id')->name('fuzz.show');
    Route::get('/{id}/progress', [FuzzController::class, 'progress'])->whereNumber('id')->name('fuzz.progress');
    Route::post('/{id}/start', [FuzzController::class, 'start'])->whereNumber('id');
    Route::post('/{id}/stop', [FuzzController::class, 'stop'])->whereNumber('id');

});






// =============================
// Modul URL Checker
// =============================
Route::middleware(['auth'])->group(function () {
    Route::get('/check-url', [UrlCheckController::class, 'showForm'])->name('checkurl.form');
    Route::post('/check-url', [UrlCheckController::class, 'check'])->name('checkurl.do');
});

// =============================
// Modul API PEntest
// =============================

Route::middleware(['auth'])->group(function() {
    Route::get('/api-testing', [PentestApiController::class, 'index'])->name('api-testing.index');
    Route::post('/api-testing/send', [PentestApiController::class, 'send'])->name('api-testing.send');
    Route::post('/api-testing/save', [PentestApiController::class, 'saveRequest'])->name('api-testing.save');
    Route::get('/api-testing/history', [PentestApiController::class, 'history'])->name('api-testing.history');
});