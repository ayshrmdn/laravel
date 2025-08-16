<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - {{ \App\Models\Setting::get('site_name', 'MPOELOT') }}</title>
    
    <!-- Vite CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        
        /* Cyberpunk Admin Theme */
        :root {
            --neon-cyan: #00FFFF;
            --neon-pink: #FF0080;
            --neon-purple: #8B00FF;
            --electric-blue: #0080FF;
            --cyber-red: #FF0040;
            --cyber-magenta: #FF00B4;
            --cyber-navy: #0A0F2C;
            --cyber-dark: #1A0B1A;
            --cyber-black: #0D0D0D;
            --cyber-violet: #2D1B69;
        }
        
        /* Cyber Components */
        .cyber-btn-primary {
            background: linear-gradient(135deg, var(--neon-cyan), var(--neon-purple));
            color: black;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }
        
        .cyber-btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 255, 255, 0.4);
            color: black;
        }
        
        .cyber-btn-secondary {
            background: rgba(0, 255, 255, 0.1);
            color: var(--neon-cyan);
            border: 1px solid var(--neon-cyan);
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .cyber-btn-secondary:hover {
            background: var(--neon-cyan);
            color: black;
        }
        
        .cyber-btn-ghost {
            background: transparent;
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .cyber-btn-ghost:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.5);
            color: white;
        }
        
        .cyber-btn-danger {
            background: linear-gradient(135deg, var(--cyber-red), #DC2626);
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }
        
        .cyber-btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(255, 0, 64, 0.4);
            color: white;
        }
        
        .cyber-btn-success {
            background: linear-gradient(135deg, #10B981, #059669);
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }
        
        .cyber-btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.4);
            color: white;
        }
        
        .cyber-btn-outline {
            background: transparent;
            color: var(--neon-cyan);
            border: 1px solid var(--neon-cyan);
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .cyber-btn-outline:hover {
            background: var(--neon-cyan);
            color: black;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 255, 255, 0.3);
        }
        
        .cyber-btn-sm {
            padding: 6px 12px;
            font-size: 0.875rem;
        }
        
        .cyber-btn-warning {
            background: linear-gradient(135deg, #F59E0B, #D97706);
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }
        
        .cyber-btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(245, 158, 11, 0.4);
            color: white;
        }
        
        .cyber-card {
            background: linear-gradient(135deg, rgba(26, 11, 26, 0.8), rgba(45, 27, 105, 0.8));
            border: 1px solid rgba(0, 255, 255, 0.2);
            border-radius: 12px;
            padding: 24px;
            backdrop-filter: blur(10px);
        }
        
        .cyber-input {
            width: 100%;
            padding: 12px 16px;
            background: rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(0, 255, 255, 0.3);
            border-radius: 8px;
            color: white;
            transition: all 0.3s ease;
        }
        
        .cyber-input:focus {
            outline: none;
            border-color: var(--neon-cyan);
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.3);
        }
        
        .cyber-select {
            width: 100%;
            padding: 12px 16px;
            background: rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(0, 255, 255, 0.3);
            border-radius: 8px;
            color: white;
            transition: all 0.3s ease;
        }
        
        .cyber-select:focus {
            outline: none;
            border-color: var(--neon-cyan);
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.3);
        }
        
        .cyber-textarea {
            width: 100%;
            padding: 12px 16px;
            background: rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(0, 255, 255, 0.3);
            border-radius: 8px;
            color: white;
            transition: all 0.3s ease;
            resize: vertical;
        }
        
        .cyber-textarea:focus {
            outline: none;
            border-color: var(--neon-cyan);
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.3);
        }
        
        .cyber-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--neon-cyan);
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .cyber-error {
            color: var(--cyber-red);
            font-size: 0.875rem;
            margin-top: 4px;
        }
        
        /* Cyber Badges */
        .cyber-badge-success {
            display: inline-flex;
            align-items: center;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background: linear-gradient(135deg, #10B981, #059669);
            color: white;
            border: 1px solid rgba(16, 185, 129, 0.3);
            box-shadow: 0 0 10px rgba(16, 185, 129, 0.3);
        }
        
        .cyber-badge-warning {
            display: inline-flex;
            align-items: center;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background: linear-gradient(135deg, #F59E0B, #D97706);
            color: white;
            border: 1px solid rgba(245, 158, 11, 0.3);
            box-shadow: 0 0 10px rgba(245, 158, 11, 0.3);
        }
        
        .cyber-badge-danger {
            display: inline-flex;
            align-items: center;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background: linear-gradient(135deg, #EF4444, #DC2626);
            color: white;
            border: 1px solid rgba(239, 68, 68, 0.3);
            box-shadow: 0 0 10px rgba(239, 68, 68, 0.3);
        }
        
        .cyber-section {
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(0, 255, 255, 0.1);
            border-radius: 8px;
            padding: 20px;
        }
        
        .cyber-section-title {
            color: white;
            font-size: 1.125rem;
            font-weight: 600;
            margin-bottom: 16px;
            padding-bottom: 8px;
            border-bottom: 1px solid rgba(0, 255, 255, 0.2);
        }
        
        /* Sidebar */
        .admin-sidebar {
            background: linear-gradient(180deg, var(--cyber-navy) 0%, var(--cyber-dark) 50%, var(--cyber-violet) 100%);
            border-right: 1px solid rgba(0, 255, 255, 0.2);
            transition: transform 0.3s ease-in-out;
        }

        /* Mobile Sidebar */
        @media (max-width: 1024px) {
            .admin-sidebar {
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                z-index: 50;
                transform: translateX(-100%);
                width: 280px;
                overflow-y: auto;
            }
            
            .admin-sidebar.open {
                transform: translateX(0);
                box-shadow: 0 0 30px rgba(0, 255, 255, 0.3);
            }
            
            .sidebar-overlay {
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 40;
                backdrop-filter: blur(4px);
                transition: opacity 0.3s ease;
            }

            /* Adjust main content for mobile */
            .flex.h-screen {
                flex-direction: column;
                height: 100vh;
            }

            .flex-1.flex.flex-col.overflow-hidden {
                width: 100%;
                height: calc(100vh - 64px); /* Account for mobile header */
            }
        }

        /* Hamburger Menu */
        .hamburger-menu {
            position: relative;
            width: 28px;
            height: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .hamburger-menu span {
            display: block;
            position: absolute;
            height: 3px;
            width: 100%;
            background: linear-gradient(90deg, var(--neon-cyan), var(--neon-purple));
            border-radius: 3px;
            opacity: 1;
            left: 0;
            transform: rotate(0deg);
            transition: all 0.25s ease-in-out;
        }

        .hamburger-menu span:nth-child(1) {
            top: 0px;
        }

        .hamburger-menu span:nth-child(2),
        .hamburger-menu span:nth-child(3) {
            top: 8px;
        }

        .hamburger-menu span:nth-child(4) {
            top: 16px;
        }

        .hamburger-menu.active span:nth-child(1) {
            top: 8px;
            width: 0%;
            left: 50%;
        }

        .hamburger-menu.active span:nth-child(2) {
            transform: rotate(45deg);
        }

        .hamburger-menu.active span:nth-child(3) {
            transform: rotate(-45deg);
        }

        .hamburger-menu.active span:nth-child(4) {
            top: 8px;
            width: 0%;
            left: 50%;
        }

        .hamburger-menu:hover span {
            background: linear-gradient(90deg, var(--neon-pink), var(--neon-purple));
        }

        /* Mobile Header */
        @media (max-width: 1024px) {
            .mobile-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 1rem;
                background: linear-gradient(135deg, var(--cyber-navy), var(--cyber-dark));
                border-bottom: 1px solid rgba(0, 255, 255, 0.2);
            }
            
            .main-content-mobile {
                padding-top: 0;
            }
        }

        @media (min-width: 1025px) {
            .mobile-header {
                display: none;
            }
        }

        /* Close Button */
        .sidebar-close-btn {
            position: absolute;
            top: 1rem;
            right: 1rem;
            width: 32px;
            height: 32px;
            background: rgba(255, 0, 128, 0.2);
            border: 1px solid rgba(255, 0, 128, 0.4);
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #FF0080;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .sidebar-close-btn:hover {
            background: rgba(255, 0, 128, 0.3);
            transform: scale(1.1);
        }

        @media (min-width: 1025px) {
            .sidebar-close-btn {
                display: none;
            }
        }
        
        .sidebar-menu-item {
            display: flex;
            align-items: center;
            padding: 16px 20px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            border-radius: 8px;
            margin-bottom: 4px;
            font-size: 15px;
            font-weight: 500;
        }

        @media (max-width: 1024px) {
            .sidebar-menu-item {
                padding: 18px 20px;
                font-size: 16px;
                margin-bottom: 6px;
            }
        }
        
        .sidebar-menu-item:hover {
            background: rgba(0, 255, 255, 0.1);
            color: var(--neon-cyan);
            transform: translateX(4px);
        }
        
        .sidebar-menu-item.active {
            background: linear-gradient(135deg, rgba(0, 255, 255, 0.2), rgba(139, 0, 255, 0.2));
            color: var(--neon-cyan);
            border: 1px solid rgba(0, 255, 255, 0.3);
        }
        
        .sidebar-menu-item i {
            width: 20px;
            margin-right: 12px;
        }
        
        /* Checkbox */
        .cyber-checkbox {
            display: none;
        }
        
        .cyber-checkbox-custom {
            position: relative;
            width: 20px;
            height: 20px;
            background: rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(0, 255, 255, 0.3);
            border-radius: 4px;
            transition: all 0.3s ease;
        }
        
        .cyber-checkbox-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0);
            color: var(--neon-cyan);
            font-size: 12px;
            transition: transform 0.3s ease;
        }
        
        .cyber-checkbox:checked + .cyber-checkbox-custom {
            background: linear-gradient(135deg, var(--neon-cyan), var(--neon-purple));
            border-color: var(--neon-cyan);
            box-shadow: 0 0 10px rgba(0, 255, 255, 0.5);
        }
        
        .cyber-checkbox:checked + .cyber-checkbox-custom .cyber-checkbox-icon {
            transform: translate(-50%, -50%) scale(1);
            color: white;
        }
        
        .cyber-checkbox-label {
            display: flex;
            align-items: center;
            cursor: pointer;
        }
    </style>
</head>
<body class="min-h-screen" style="background: linear-gradient(135deg, #0A0F2C 0%, #1A0B1A 25%, #0D0D0D 50%, #2D1B69 75%, #1A0B1A 100%);">
    <!-- Sidebar Overlay (Mobile) -->
    <div id="sidebar-overlay" class="sidebar-overlay hidden lg:hidden"></div>

    <!-- Mobile Header -->
    <div class="mobile-header lg:hidden">
        <div class="flex items-center space-x-3">
            <button id="mobile-menu-toggle" class="hamburger-menu">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </button>
            @php
                $logoPath = \App\Models\Setting::get('logo', 'images/logo.png');
                $logoUrl = str_starts_with($logoPath, 'images/') ? asset($logoPath) : asset('storage/' . $logoPath);
            @endphp
            <img src="{{ $logoUrl }}" alt="{{ \App\Models\Setting::get('site_name', 'MPOELOT') }}" class="h-8 w-auto">
            <div>
                <h2 class="text-white font-bold text-lg">Admin</h2>
            </div>
        </div>
        
        <div class="flex items-center space-x-3">
            <a href="{{ route('home') }}" target="_blank" class="text-cyan-400 hover:text-cyan-300">
                <i class="fas fa-external-link-alt"></i>
            </a>
            <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="text-red-400 hover:text-red-300">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
        </div>
    </div>

    <div class="flex h-screen">
        <!-- Sidebar -->
        <div id="admin-sidebar" class="w-64 admin-sidebar flex-shrink-0 lg:relative">
            <!-- Close Button (Mobile Only) -->
            <button id="sidebar-close-btn" class="sidebar-close-btn lg:hidden">
                <i class="fas fa-times"></i>
            </button>
            <div class="p-6 pt-16 lg:pt-6">
                <!-- Logo (Hidden on mobile, shown on desktop) -->
                <div class="hidden lg:flex items-center space-x-3 mb-8">
                    @php
                        $logoPath = \App\Models\Setting::get('logo', 'images/logo.png');
                        $logoUrl = str_starts_with($logoPath, 'images/') ? asset($logoPath) : asset('storage/' . $logoPath);
                    @endphp
                    <img src="{{ $logoUrl }}" alt="{{ \App\Models\Setting::get('site_name', 'MPOELOT') }}" class="h-10 w-auto">
                    <div>
                        <h2 class="text-white font-bold text-lg">Admin Panel</h2>
                        <p class="text-cyan-400 text-sm">{{ \App\Models\Setting::get('site_name', 'MPOELOT') }}</p>
                    </div>
                </div>

                <!-- Mobile Logo -->
                <div class="lg:hidden flex items-center space-x-3 mb-8">
                    <img src="{{ $logoUrl }}" alt="{{ \App\Models\Setting::get('site_name', 'MPOELOT') }}" class="h-8 w-auto">
                    <div>
                        <h2 class="text-white font-bold text-lg">Admin Panel</h2>
                        <p class="text-cyan-400 text-sm">{{ \App\Models\Setting::get('site_name', 'MPOELOT') }}</p>
                    </div>
                </div>

                <!-- Navigation Menu -->
                <nav class="space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i>
                        Dashboard
                    </a>
                    
                    <a href="{{ route('admin.games.index') }}" class="sidebar-menu-item {{ request()->routeIs('admin.games.*') ? 'active' : '' }}">
                        <i class="fas fa-gamepad"></i>
                        Manajemen Game
                    </a>
                    
                    <a href="{{ route('admin.providers.index') }}" class="sidebar-menu-item {{ request()->routeIs('admin.providers.*') ? 'active' : '' }}">
                        <i class="fas fa-building"></i>
                        Manajemen Provider
                    </a>
                    
                    <a href="{{ route('admin.categories.index') }}" class="sidebar-menu-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                        <i class="fas fa-tags"></i>
                        Manajemen Kategori
                    </a>
                    
                    <a href="{{ route('admin.users.index') }}" class="sidebar-menu-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="fas fa-users"></i>
                        Manajemen User
                    </a>
                    
                    <a href="{{ route('admin.chat.index') }}" class="sidebar-menu-item {{ request()->routeIs('admin.chat.*') ? 'active' : '' }}">
                        <i class="fas fa-comments"></i>
                        Live Chat
                    </a>
                    
                    <a href="{{ route('admin.banners.index') }}" class="sidebar-menu-item {{ request()->routeIs('admin.banners.*') ? 'active' : '' }}">
                        <i class="fas fa-images"></i>
                        Manajemen Banner
                    </a>
                    
                    <a href="{{ route('admin.settings.index') }}" class="sidebar-menu-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                        <i class="fas fa-cog"></i>
                        Pengaturan Situs
                    </a>
                </nav>
            </div>

            <!-- Admin Info -->
            <div class="mt-auto p-6 border-t border-cyan-500/20">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-10 h-10 bg-gradient-to-r from-cyan-400 to-pink-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-user-shield text-white"></i>
                    </div>
                    <div>
                        <div class="text-white font-medium">{{ auth('admin')->user()->name }}</div>
                        <div class="text-cyan-400 text-sm">Administrator</div>
                    </div>
                </div>
                
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="cyber-btn-ghost w-full">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden lg:ml-0">
            <!-- Header (Desktop Only) -->
            <header class="hidden lg:block bg-gradient-to-r from-cyan-900/20 to-purple-900/20 border-b border-cyan-500/20 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-white">@yield('title', 'Dashboard')</h1>
                        <p class="text-cyan-400">@yield('subtitle', 'Kelola situs Anda dengan mudah')</p>
                    </div>
                    
                    <!-- Quick Actions -->
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('home') }}" target="_blank" class="cyber-btn-ghost">
                            <i class="fas fa-external-link-alt mr-2"></i>
                            Lihat Situs
                        </a>
                        
                        <div class="text-right">
                            <div class="text-white text-sm">{{ now()->format('d M Y') }}</div>
                            <div class="text-cyan-400 text-xs">{{ now()->format('H:i') }}</div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Mobile Page Header -->
            <div class="lg:hidden bg-gradient-to-r from-cyan-900/20 to-purple-900/20 border-b border-cyan-500/20 p-4">
                <h1 class="text-xl font-bold text-white">@yield('title', 'Dashboard')</h1>
                <p class="text-cyan-400 text-sm">@yield('subtitle', 'Kelola situs Anda dengan mudah')</p>
            </div>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-4 lg:p-6">
                <!-- Success Message -->
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-500/20 border border-green-500/50 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-400 mr-3"></i>
                            <span class="text-green-300">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                <!-- Error Message -->
                @if(session('error'))
                    <div class="mb-6 p-4 bg-red-500/20 border border-red-500/50 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle text-red-400 mr-3"></i>
                            <span class="text-red-300">{{ session('error') }}</span>
                        </div>
                    </div>
                @endif

                <!-- Validation Errors -->
                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-500/20 border border-red-500/50 rounded-lg">
                        <div class="flex items-start">
                            <i class="fas fa-exclamation-triangle text-red-400 mr-3 mt-1"></i>
                            <div>
                                <div class="text-red-300 font-medium mb-2">Terdapat kesalahan:</div>
                                <ul class="text-red-300 text-sm space-y-1">
                                    @foreach($errors->all() as $error)
                                        <li>• {{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Sidebar JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('admin-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const mobileToggle = document.getElementById('mobile-menu-toggle');
            const closeBtn = document.getElementById('sidebar-close-btn');

            // Function to open sidebar
            function openSidebar() {
                sidebar.classList.add('open');
                overlay.classList.remove('hidden');
                mobileToggle.classList.add('active');
                document.body.style.overflow = 'hidden'; // Prevent body scroll
            }

            // Function to close sidebar
            function closeSidebar() {
                sidebar.classList.remove('open');
                overlay.classList.add('hidden');
                mobileToggle.classList.remove('active');
                document.body.style.overflow = ''; // Restore body scroll
            }

            // Toggle sidebar on mobile menu button click
            mobileToggle.addEventListener('click', function() {
                if (sidebar.classList.contains('open')) {
                    closeSidebar();
                } else {
                    openSidebar();
                }
            });

            // Close sidebar when close button is clicked
            closeBtn.addEventListener('click', closeSidebar);

            // Close sidebar when overlay is clicked
            overlay.addEventListener('click', closeSidebar);

            // Close sidebar when pressing Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && sidebar.classList.contains('open')) {
                    closeSidebar();
                }
            });

            // Close sidebar when clicking on menu items on mobile
            const menuItems = sidebar.querySelectorAll('.sidebar-menu-item');
            menuItems.forEach(item => {
                item.addEventListener('click', function() {
                    if (window.innerWidth <= 1024) {
                        setTimeout(closeSidebar, 150); // Small delay for better UX
                    }
                });
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth > 1024) {
                    closeSidebar(); // Close mobile sidebar when switching to desktop
                }
            });

            // Touch gestures for mobile
            let touchStartX = 0;
            let touchEndX = 0;

            document.addEventListener('touchstart', function(e) {
                touchStartX = e.changedTouches[0].screenX;
            });

            document.addEventListener('touchend', function(e) {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipe();
            });

            function handleSwipe() {
                const swipeThreshold = 50;
                const diff = touchStartX - touchEndX;

                // Swipe left to close sidebar (only if sidebar is open)
                if (diff > swipeThreshold && sidebar.classList.contains('open')) {
                    closeSidebar();
                }
                
                // Swipe right to open sidebar (only if near left edge and sidebar is closed)
                if (diff < -swipeThreshold && touchStartX < 50 && !sidebar.classList.contains('open') && window.innerWidth <= 1024) {
                    openSidebar();
                }
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
