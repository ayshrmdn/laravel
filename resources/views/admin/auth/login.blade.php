@extends('admin.layouts.auth')

@section('title', 'Login Admin - Panel Admin')

@section('content')
<div class="animate-fade-in">
    <!-- Logo Section -->
    <div class="text-center mb-8">
        <div class="glass-effect rounded-full w-20 h-20 mx-auto flex items-center justify-center mb-4 animate-pulse-glow">
            <i class="fas fa-user-shield text-3xl text-white"></i>
        </div>
        <h2 class="text-3xl font-bold text-white">Panel Admin</h2>
        <p class="text-red-light mt-2">Selamat datang kembali! Silakan masuk untuk melanjutkan</p>
    </div>

    <!-- Login Form -->
    <div class="glass-effect rounded-xl shadow-2xl p-8 animate-slide-up">
        <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-6">
            @csrf
            
            <!-- Email Field -->
            <div class="relative">
                <label for="email" class="block text-sm font-medium text-white mb-2">
                    <i class="fas fa-envelope mr-2"></i>Alamat Email
                </label>
                <div class="relative">
                    <input 
                        id="email" 
                        name="email" 
                        type="email" 
                        required 
                        value="{{ old('email') }}"
                        class="w-full px-4 py-3 pl-12 bg-white/10 border border-white/20 rounded-lg text-white placeholder-red-light focus:ring-2 focus:ring-purple-secondary focus:border-transparent transition-all duration-300 backdrop-blur-sm"
                        placeholder="Masukkan email Anda"
                    >
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-user text-red-light"></i>
                    </div>
                </div>
                @error('email')
                    <p class="mt-2 text-sm text-red-300 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Password Field -->
            <div class="relative">
                <label for="password" class="block text-sm font-medium text-white mb-2">
                    <i class="fas fa-lock mr-2"></i>Kata Sandi
                </label>
                <div class="relative">
                    <input 
                        id="password" 
                        name="password" 
                        type="password" 
                        required
                        class="w-full px-4 py-3 pl-12 pr-12 bg-white/10 border border-white/20 rounded-lg text-white placeholder-red-light focus:ring-2 focus:ring-purple-secondary focus:border-transparent transition-all duration-300 backdrop-blur-sm"
                        placeholder="Masukkan kata sandi Anda"
                    >
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-key text-red-light"></i>
                    </div>
                    <button 
                        type="button" 
                        onclick="togglePassword()"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-red-light hover:text-white transition-colors"
                    >
                        <i id="toggleIcon" class="fas fa-eye"></i>
                    </button>
                </div>
                @error('password')
                    <p class="mt-2 text-sm text-red-300 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between">
                <label class="flex items-center">
                    <input 
                        type="checkbox" 
                        name="remember" 
                        class="w-4 h-4 text-purple-secondary border-white/20 rounded focus:ring-purple-secondary focus:ring-2 bg-white/10"
                    >
                    <span class="ml-2 text-sm text-red-light">Ingat saya</span>
                </label>
                <a href="#" class="text-sm text-red-light hover:text-white transition-colors">
                    Lupa kata sandi?
                </a>
            </div>

            <!-- Submit Button -->
            <button 
                type="submit"
                class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-red-secondary to-purple-secondary hover:from-red-primary hover:to-purple-primary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-secondary transition-all duration-300 transform hover:scale-105 hover:shadow-xl"
            >
                <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                    <i class="fas fa-sign-in-alt text-red-light group-hover:text-white transition-colors"></i>
                </span>
                <span class="ml-3">Masuk</span>
            </button>
        </form>

        <!-- Additional Info -->
        <div class="mt-6 text-center">
            <p class="text-xs text-red-light">
                <i class="fas fa-shield-alt mr-1"></i>
                Hanya akses admin yang aman
            </p>
        </div>
    </div>

    <!-- Footer -->
    <div class="text-center mt-8">
        <p class="text-sm text-red-light">
            © {{ date('Y') }} Panel Admin. Hak cipta dilindungi.
        </p>
    </div>
</div>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}

// Add loading state to form submission
document.querySelector('form').addEventListener('submit', function(e) {
    const button = this.querySelector('button[type="submit"]');
    const span = button.querySelector('span:last-child');
    
    button.disabled = true;
    span.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Signing In...';
    
    // Re-enable after 3 seconds if form doesn't submit
    setTimeout(() => {
        button.disabled = false;
        span.innerHTML = 'Sign In';
    }, 3000);
});

// Add ripple effect to button
document.querySelector('button[type="submit"]').addEventListener('click', function(e) {
    const ripple = document.createElement('span');
    const rect = this.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height);
    const x = e.clientX - rect.left - size / 2;
    const y = e.clientY - rect.top - size / 2;
    
    ripple.style.width = ripple.style.height = size + 'px';
    ripple.style.left = x + 'px';
    ripple.style.top = y + 'px';
    ripple.classList.add('ripple');
    
    this.appendChild(ripple);
    
    setTimeout(() => {
        ripple.remove();
    }, 600);
});
</script>

<style>
.ripple {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    transform: scale(0);
    animation: ripple-animation 0.6s linear;
    pointer-events: none;
}

@keyframes ripple-animation {
    to {
        transform: scale(4);
        opacity: 0;
    }
}
</style>
@endsection
