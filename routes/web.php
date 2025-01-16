<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

// Route::post('/register_user', [RegistrationController::class, 'register']);
// Route::post('/login_user', [AuthController::class, 'login'])->name('login');
// Route::middleware(['auth'])->get('/dashboard', function () {
//     return view('dashboard'); // Replace with your actual dashboard view
// })->name('dashboard');
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
