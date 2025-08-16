<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LiveChatController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/live-chat', [LiveChatController::class, 'index'])->name('live-chat');

// Live Chat Routes
Route::post('/live-chat/guest-start', [LiveChatController::class, 'startGuestChat'])->name('live-chat.guest-start');
Route::post('/live-chat/send-message', [LiveChatController::class, 'sendMessage'])->name('live-chat.send-message');
Route::get('/live-chat/messages/{session_id}', [LiveChatController::class, 'getMessages'])->name('live-chat.get-messages');
