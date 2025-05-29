<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Models\Comment; // Tambahin ini ya bro!

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/threats', function () {
    $comments = Comment::where('page', 'threats')->latest()->get();
    return view('threats', compact('comments'));
});

Route::get('/defense', function () {
    $comments = Session::get('comments', []);
    return view('defense', compact('comments'));
});
