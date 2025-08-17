<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LiveChatController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\AuthController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Authenticated dashboard
Route::middleware('auth')->group(function () {
    Route::get('/beranda', [HomeController::class, 'dashboard'])->name('dashboard');
});
Route::get('/live-chat', [LiveChatController::class, 'index'])->name('live-chat');
Route::get('/promo', [PromoController::class, 'index'])->name('promo');

// Auth endpoints (AJAX from modal)
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/auth/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Live Chat Routes
Route::post('/live-chat/guest-start', [LiveChatController::class, 'startGuestChat'])->name('live-chat.guest-start');
Route::post('/live-chat/auth-start', [LiveChatController::class, 'startAuthChat'])->middleware('auth')->name('live-chat.auth-start');
Route::post('/live-chat/send-message', [LiveChatController::class, 'sendMessage'])->name('live-chat.send-message');
Route::get('/live-chat/messages/{session_id}', [LiveChatController::class, 'getMessages'])->name('live-chat.get-messages');
