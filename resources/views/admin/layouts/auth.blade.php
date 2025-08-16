<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel')</title>
    
    <!-- Vite CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        body {
            background: linear-gradient(135deg, #dc2626 0%, #7c3aed 50%, #991b1b 100%);
            min-height: 100vh;
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .floating-particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }
        
        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
    </style>
</head>
<body class="font-sans antialiased">
    <!-- Floating Particles Background -->
    <div class="floating-particles">
        <div class="particle w-2 h-2 top-1/4 left-1/4" style="animation-delay: 0s;"></div>
        <div class="particle w-3 h-3 top-1/3 right-1/4" style="animation-delay: 2s;"></div>
        <div class="particle w-1 h-1 top-1/2 left-1/6" style="animation-delay: 4s;"></div>
        <div class="particle w-2 h-2 bottom-1/4 right-1/3" style="animation-delay: 1s;"></div>
        <div class="particle w-4 h-4 bottom-1/3 left-1/3" style="animation-delay: 3s;"></div>
    </div>

    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-md w-full space-y-8">
            @yield('content')
        </div>
    </div>

    <!-- Success/Error Toast -->
    @if(session('success') || session('error'))
    <div id="toast" class="fixed top-4 right-4 z-50 animate-slide-up">
        <div class="bg-white border-l-4 {{ session('success') ? 'border-green-500' : 'border-red-500' }} rounded-lg shadow-lg p-4 max-w-sm">
            <div class="flex">
                <div class="flex-shrink-0">
                    @if(session('success'))
                        <i class="fas fa-check-circle text-green-500"></i>
                    @else
                        <i class="fas fa-exclamation-circle text-red-500"></i>
                    @endif
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-900">
                        {{ session('success') ?? session('error') }}
                    </p>
                </div>
                <div class="ml-auto pl-3">
                    <button onclick="document.getElementById('toast').remove()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <script>
        // Auto hide toast after 5 seconds
        setTimeout(() => {
            const toast = document.getElementById('toast');
            if (toast) {
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 300);
            }
        }, 5000);

        // Add interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('animate-pulse-glow');
                });
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('animate-pulse-glow');
                });
            });
        });
    </script>
</body>
</html>
