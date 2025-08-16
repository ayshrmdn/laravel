<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ChatController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\GameController;
use App\Http\Controllers\Admin\ProviderController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    // Guest routes (not authenticated)
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    });

    // Authenticated admin routes
    Route::middleware(['auth:admin', 'update.online.status'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        
        // User Management Routes
        Route::resource('users', UserController::class);
        Route::patch('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
        
        // Chat Routes
        Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
        Route::get('/chat/{chat}', [ChatController::class, 'show'])->name('chat.show');
        Route::post('/chat/send', [ChatController::class, 'store'])->name('chat.send');
        Route::get('/chat/users/list', [ChatController::class, 'getUsers'])->name('chat.users');
        Route::post('/chat/start', [ChatController::class, 'startChat'])->name('chat.start');
        
        // Banner Routes
        Route::resource('banners', BannerController::class);
        Route::patch('/banners/{banner}/toggle-status', [BannerController::class, 'toggleStatus'])->name('banners.toggle-status');
        
        // Settings Routes
        Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
        Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
        Route::post('/settings/gif-banner/delete', [SettingsController::class, 'deleteGifBanner'])->name('settings.gif-banner.delete');
        Route::post('/settings/support-agent/delete', [SettingsController::class, 'deleteSupportAgentImage'])->name('settings.support-agent.delete');
        
        // Game Management Routes
        Route::resource('games', GameController::class);
        Route::patch('/games/{game}/toggle-status', [GameController::class, 'toggleStatus'])->name('games.toggle-status');
        Route::patch('/games/{game}/toggle-popular', [GameController::class, 'togglePopular'])->name('games.toggle-popular');
        Route::patch('/games/{game}/toggle-new', [GameController::class, 'toggleNew'])->name('games.toggle-new');
        
        // Provider Management Routes
        Route::resource('providers', ProviderController::class);
        Route::patch('/providers/{provider}/toggle-status', [ProviderController::class, 'toggleStatus'])->name('providers.toggle-status');
        
        // Category Management Routes
        Route::resource('categories', CategoryController::class);
        Route::patch('/categories/{category}/toggle-status', [CategoryController::class, 'toggleStatus'])->name('categories.toggle-status');
    });
});
