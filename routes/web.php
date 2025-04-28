<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
Route::get('/cyber', function () {
    return view('cyber');
});
Route::get('/threts', function () {
    return view('cyber');
});
