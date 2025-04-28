<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
Route::get('/cyber', function () {
    return view('cyber');
});
Route::get('/threats', function () {
    return view('cyber');
});
