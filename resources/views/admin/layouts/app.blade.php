<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard - Admin Panel')</title>
    
    <!-- Vite CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="min-h-screen flex">
        <!-- Mobile menu overlay -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden"></div>
        
        <!-- Sidebar -->
        <div id="sidebar" class="bg-gradient-to-b from-red-dark to-purple-dark w-64 min-h-screen shadow-lg fixed lg:relative z-50 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="bg-gradient-to-r from-red-secondary to-purple-secondary rounded-lg p-2">
                            @if(file_exists(public_path('images/logoadmin.png')))
                                <img src="{{ asset('images/logoadmin.png') }}" alt="Logo Admin" class="w-6 h-6 object-contain">
                            @else
                                <i class="fas fa-user-shield text-white text-xl"></i>
                            @endif
                        </div>
                        <div>
                            <h1 class="text-white text-lg font-bold">Panel Admin</h1>
                            <p class="text-red-light text-sm">Pusat Kontrol</p>
                        </div>
                    </div>
                    <!-- Close button for mobile -->
                    <button id="sidebar-close" class="lg:hidden text-white hover:text-red-light">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            
            <nav class="mt-6">
                <ul class="space-y-2 px-3">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 {{ request()->routeIs('admin.dashboard') ? 'text-white bg-gradient-to-r from-red-primary to-purple-primary' : 'text-red-light hover:bg-gradient-to-r hover:from-red-primary hover:to-purple-primary hover:text-white' }} rounded-lg px-3 py-2 transition-all duration-300">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.index') }}" class="flex items-center space-x-3 {{ request()->routeIs('admin.users.*') ? 'text-white bg-gradient-to-r from-red-primary to-purple-primary' : 'text-red-light hover:bg-gradient-to-r hover:from-red-primary hover:to-purple-primary hover:text-white' }} rounded-lg px-3 py-2 transition-all duration-300">
                            <i class="fas fa-users"></i>
                            <span>Pengguna</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.chat.index') }}" class="flex items-center space-x-3 {{ request()->routeIs('admin.chat.*') ? 'text-white bg-gradient-to-r from-red-primary to-purple-primary' : 'text-red-light hover:bg-gradient-to-r hover:from-red-primary hover:to-purple-primary hover:text-white' }} rounded-lg px-3 py-2 transition-all duration-300">
                            <i class="fas fa-comments"></i>
                            <span>Live Chat</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.banners.index') }}" class="flex items-center space-x-3 {{ request()->routeIs('admin.banners.*') ? 'text-white bg-gradient-to-r from-red-primary to-purple-primary' : 'text-red-light hover:bg-gradient-to-r hover:from-red-primary hover:to-purple-primary hover:text-white' }} rounded-lg px-3 py-2 transition-all duration-300">
                            <i class="fas fa-images"></i>
                            <span>Banner Slider</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.settings.index') }}" class="flex items-center space-x-3 {{ request()->routeIs('admin.settings.*') ? 'text-white bg-gradient-to-r from-red-primary to-purple-primary' : 'text-red-light hover:bg-gradient-to-r hover:from-red-primary hover:to-purple-primary hover:text-white' }} rounded-lg px-3 py-2 transition-all duration-300">
                            <i class="fas fa-cog"></i>
                            <span>Pengaturan</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col lg:ml-0">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center space-x-4">
                        <!-- Mobile menu button -->
                        <button id="sidebar-toggle" class="lg:hidden text-gray-600 hover:text-gray-900 focus:outline-none">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <h2 class="text-xl font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <button class="flex items-center space-x-2 text-gray-600 hover:text-gray-900 transition-colors">
                                <div class="w-8 h-8 bg-gradient-to-r from-red-secondary to-purple-secondary rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-white text-sm"></i>
                                </div>
                                <span class="text-sm font-medium">{{ auth('admin')->user()->name ?? 'Admin' }}</span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                        </div>
                        
                        <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-red-600 transition-colors">
                                <i class="fas fa-sign-out-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Sidebar Toggle JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const sidebarClose = document.getElementById('sidebar-close');
            const sidebarOverlay = document.getElementById('sidebar-overlay');

            // Toggle sidebar on mobile
            function toggleSidebar() {
                sidebar.classList.toggle('-translate-x-full');
                sidebarOverlay.classList.toggle('hidden');
            }

            // Close sidebar
            function closeSidebar() {
                sidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
            }

            // Event listeners
            sidebarToggle.addEventListener('click', toggleSidebar);
            sidebarClose.addEventListener('click', closeSidebar);
            sidebarOverlay.addEventListener('click', closeSidebar);

            // Close sidebar when clicking on navigation links on mobile
            const navLinks = sidebar.querySelectorAll('nav a');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 1024) {
                        closeSidebar();
                    }
                });
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 1024) {
                    sidebar.classList.remove('-translate-x-full');
                    sidebarOverlay.classList.add('hidden');
                }
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>
