<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/threats', function () {
    return view('threats');
});
Route::get('/defense', function () {
    return view('defense');
});
