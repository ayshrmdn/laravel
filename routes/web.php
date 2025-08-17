<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LiveChatController;
use App\Http\Controllers\PromoController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Authenticated dashboard
Route::middleware('auth')->group(function () {
    Route::get('/beranda', [HomeController::class, 'dashboard'])->name('dashboard');
});
Route::get('/live-chat', [LiveChatController::class, 'index'])->name('live-chat');
Route::get('/promo', [PromoController::class, 'index'])->name('promo');

// Live Chat Routes
Route::post('/live-chat/guest-start', [LiveChatController::class, 'startGuestChat'])->name('live-chat.guest-start');
Route::post('/live-chat/send-message', [LiveChatController::class, 'sendMessage'])->name('live-chat.send-message');
Route::get('/live-chat/messages/{session_id}', [LiveChatController::class, 'getMessages'])->name('live-chat.get-messages');
