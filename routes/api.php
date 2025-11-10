<?php
use App\Http\Controllers\InterceptController;
Route::post('/intercept', [InterceptController::class, 'store']);
