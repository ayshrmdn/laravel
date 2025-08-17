<!-- Cyber Login Modal -->
<div id="loginModal" class="fixed inset-0 bg-black bg-opacity-80 hidden items-center justify-center z-50 p-4 backdrop-blur-sm">
    <div class="cyber-modal-container relative max-w-md w-full mx-auto max-h-[90vh]">
        <!-- Animated Border -->
        <div class="cyber-modal-border"></div>
        
        <!-- Modal Content -->
        <div class="cyber-modal-content relative bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900 rounded-xl backdrop-blur-xl border border-cyan-500/30 flex flex-col h-full max-h-[90vh] overflow-hidden">
            <!-- Close Button -->
            <button onclick="closeLoginModal()" class="absolute top-4 right-4 z-20 cyber-close-btn">
                <i class="fas fa-times text-xl"></i>
            </button>
            
            <!-- Modal Header with Logo -->
            <div class="cyber-header relative p-4 text-center flex-shrink-0">
                <div class="cyber-logo-container">
                    @php
                        $logoPath = \App\Models\Setting::get('logo', 'images/logo.png');
                        $logoUrl = str_starts_with($logoPath, 'images/') ? asset($logoPath) : asset('storage/' . $logoPath);
                    @endphp
                    <img src="{{ $logoUrl }}" alt="{{ \App\Models\Setting::get('site_name', 'MPOELOT') }}" class="cyber-logo">
                </div>
                <h2 class="text-xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-pink-400 mb-1">{{ \App\Models\Setting::get('site_name', 'MPOELOT') }}</h2>
                <p class="text-xs text-cyan-300/80">{{ \App\Models\Setting::get('site_description', 'Situs Game Online Terpercaya') }}</p>
                
                <!-- Decorative Elements -->
                <div class="cyber-decorative-lines">
                    <div class="cyber-line cyber-line-1"></div>
                    <div class="cyber-line cyber-line-2"></div>
                </div>
            </div>
            
            <!-- Form Container -->
            <div class="flex-1 overflow-y-auto px-4 pb-4" style="min-height: 0;">                
                <!-- Login/Register Toggle -->
                <div class="cyber-toggle-container mb-6">
                    <button id="loginTab" class="cyber-tab cyber-tab-active">
                        <span class="relative z-10">Masuk</span>
                    </button>
                    <button id="registerTab" class="cyber-tab">
                        <span class="relative z-10">Daftar</span>
                    </button>
                    <div class="cyber-tab-indicator"></div>
                </div>
                
                <!-- Login Form -->
                <form id="loginForm" class="cyber-form space-y-4">
                    <div class="cyber-input-group">
                        <label class="cyber-label">Username atau Email</label>
                        <div class="cyber-input-container">
                            <i class="fas fa-user cyber-input-icon"></i>
                            <input type="text" name="username" required class="cyber-input" placeholder="Masukkan username/email">
                        </div>
                    </div>
                    
                    <div class="cyber-input-group">
                        <label class="cyber-label">Password</label>
                        <div class="cyber-input-container">
                            <i class="fas fa-lock cyber-input-icon"></i>
                            <input type="password" name="password" required class="cyber-input cyber-password-input" placeholder="Masukkan password">
                            <button type="button" class="cyber-toggle-password" onclick="togglePassword('login')">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="flex items-center">
                        <label class="cyber-checkbox-label">
                            <input type="checkbox" class="cyber-checkbox">
                            <span class="cyber-checkbox-custom">
                                <i class="fas fa-check cyber-checkbox-icon"></i>
                            </span>
                            <span class="text-sm text-gray-300 ml-2">Ingat saya</span>
                        </label>
                    </div>
                    
                    <button type="submit" class="cyber-submit-btn">
                        <span class="relative z-10">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Masuk Portal
                        </span>
                    </button>
                </form>
                
                <!-- Register Form (Hidden by default) -->
                <form id="registerForm" class="cyber-form space-y-3 hidden">
                    <div class="cyber-input-group">
                        <label class="cyber-label">Username</label>
                        <div class="cyber-input-container">
                            <i class="fas fa-user cyber-input-icon"></i>
                            <input type="text" name="username" required class="cyber-input" placeholder="Username">
                        </div>
                    </div>
                    
                    <div class="cyber-input-group">
                        <label class="cyber-label">Nama Lengkap</label>
                        <div class="cyber-input-container">
                            <i class="fas fa-id-card cyber-input-icon"></i>
                            <input type="text" name="full_name" required class="cyber-input" placeholder="Nama lengkap">
                        </div>
                    </div>
                    
                    <div class="cyber-input-group">
                        <label class="cyber-label">Email</label>
                        <div class="cyber-input-container">
                            <i class="fas fa-envelope cyber-input-icon"></i>
                            <input type="email" name="email" required class="cyber-input" placeholder="email@example.com">
                        </div>
                    </div>
                    
                    <div class="cyber-input-group">
                        <label class="cyber-label">No. Handphone</label>
                        <div class="cyber-input-container">
                            <i class="fas fa-phone cyber-input-icon"></i>
                            <input type="tel" name="phone" required class="cyber-input" placeholder="08123456789">
                        </div>
                    </div>
                    
                    <div class="cyber-input-group">
                        <label class="cyber-label">Password</label>
                        <div class="cyber-input-container">
                            <i class="fas fa-lock cyber-input-icon"></i>
                            <input type="password" name="password" required class="cyber-input cyber-password-input" placeholder="Password">
                            <button type="button" class="cyber-toggle-password" onclick="togglePassword('register')">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="cyber-input-group">
                        <label class="cyber-label">Konfirmasi Password</label>
                        <div class="cyber-input-container">
                            <i class="fas fa-lock cyber-input-icon"></i>
                            <input type="password" name="password_confirmation" required class="cyber-input cyber-password-input" placeholder="Konfirmasi password">
                            <button type="button" class="cyber-toggle-password" onclick="togglePassword('confirm')">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="cyber-input-group">
                        <label class="cyber-label">Kode Referral (Opsional)</label>
                        <div class="cyber-input-container">
                            <i class="fas fa-gift cyber-input-icon"></i>
                            <input type="text" name="referral_code" class="cyber-input" placeholder="Kode referral">
                        </div>
                    </div>
                    
                    <!-- Captcha -->
                    <div class="cyber-input-group">
                        <label class="cyber-label">Kode Verifikasi</label>
                        <div class="flex gap-3">
                            <div class="cyber-captcha-container">
                                <span id="captchaDisplay" class="cyber-captcha-text">12345</span>
                                <button type="button" onclick="generateCaptcha()" class="cyber-refresh-btn">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>
                            <div class="cyber-input-container flex-1">
                                <i class="fas fa-shield-alt cyber-input-icon"></i>
                                <input type="number" name="captcha" required class="cyber-input" placeholder="Masukkan kode" maxlength="5">
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center mt-4">
                        <label class="cyber-checkbox-label">
                            <input type="checkbox" required class="cyber-checkbox">
                            <span class="cyber-checkbox-custom">
                                <i class="fas fa-check cyber-checkbox-icon"></i>
                            </span>
                            <span class="text-sm text-gray-300 ml-2">Saya setuju dengan <a href="#" class="text-cyan-400 hover:text-cyan-300">Syarat & Ketentuan</a></span>
                        </label>
                    </div>
                    
                    <button type="submit" class="cyber-submit-btn mt-4">
                        <span class="relative z-10">
                            <i class="fas fa-user-plus mr-2"></i>
                            Daftar Portal
                        </span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Cyber Modal Styles */
.cyber-modal-container {
    position: relative;
    animation: modalFadeIn 0.5s ease-out;
}

@keyframes modalFadeIn {
    from {
        opacity: 0;
        transform: scale(0.9) translateY(20px);
    }
    to {
        opacity: 1;
        transform: scale(1) translateY(0);
    }
}

.cyber-modal-border {
    position: absolute;
    inset: -2px;
    background: linear-gradient(45deg, var(--neon-cyan), var(--neon-pink), var(--neon-purple), var(--neon-cyan));
    background-size: 400% 400%;
    border-radius: 14px;
    z-index: -1;
    animation: borderPulse 3s ease infinite;
}

@keyframes borderPulse {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

.cyber-modal-content {
    position: relative;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
}

.cyber-close-btn {
    color: white;
    transition: all 0.3s ease;
    padding: 8px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.cyber-close-btn:hover {
    color: var(--cyber-red);
    background: rgba(255, 0, 64, 0.2);
    border-color: var(--cyber-red);
    transform: rotate(90deg) scale(1.1);
}

.cyber-header {
    background: linear-gradient(135deg, rgba(0, 255, 255, 0.1), rgba(255, 0, 128, 0.1));
    border-bottom: 1px solid rgba(0, 255, 255, 0.2);
}

.cyber-logo-container {
    position: relative;
    display: inline-block;
    margin-bottom: 12px;
}

.cyber-logo {
    height: 50px;
    width: auto;
    filter: drop-shadow(0 0 20px rgba(0, 255, 255, 0.5));
    animation: logoFloat 3s ease-in-out infinite;
}

@keyframes logoFloat {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-8px) rotate(2deg); }
}

.cyber-decorative-lines {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    pointer-events: none;
}

.cyber-line {
    position: absolute;
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--neon-cyan), transparent);
}

.cyber-line-1 {
    top: 20%;
    left: 10%;
    right: 60%;
    animation: lineGlow 2s ease-in-out infinite;
}

.cyber-line-2 {
    bottom: 20%;
    left: 40%;
    right: 10%;
    animation: lineGlow 2s ease-in-out infinite reverse;
}

@keyframes lineGlow {
    0%, 100% { opacity: 0.3; }
    50% { opacity: 1; }
}

.cyber-toggle-container {
    position: relative;
    display: flex;
    background: rgba(0, 0, 0, 0.3);
    border-radius: 12px;
    padding: 4px;
    border: 1px solid rgba(0, 255, 255, 0.2);
}

.cyber-tab {
    flex: 1;
    padding: 12px 16px;
    font-size: 0.875rem;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.3s ease;
    position: relative;
    z-index: 2;
    color: rgba(255, 255, 255, 0.6);
}

.cyber-tab-active {
    color: white;
}

.cyber-tab-indicator {
    position: absolute;
    top: 4px;
    left: 4px;
    width: calc(50% - 4px);
    height: calc(100% - 8px);
    background: linear-gradient(135deg, var(--neon-cyan), var(--neon-purple));
    border-radius: 8px;
    transition: transform 0.3s ease;
    z-index: 1;
    box-shadow: 0 0 20px rgba(0, 255, 255, 0.3);
}

.cyber-input-group {
    margin-bottom: 16px;
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

.cyber-input-container {
    position: relative;
    display: flex;
    align-items: center;
}

.cyber-input-icon {
    position: absolute;
    left: 12px;
    color: var(--neon-cyan);
    z-index: 2;
    transition: all 0.3s ease;
}

.cyber-input {
    width: 100%;
    padding: 12px 12px 12px 40px;
    background: rgba(0, 0, 0, 0.4);
    border: 1px solid rgba(0, 255, 255, 0.3);
    border-radius: 8px;
    color: white;
    font-size: 0.875rem;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.cyber-input:focus {
    outline: none;
    border-color: var(--neon-cyan);
    box-shadow: 0 0 20px rgba(0, 255, 255, 0.3);
    background: rgba(0, 0, 0, 0.6);
}

.cyber-input:focus + .cyber-input-icon {
    color: white;
    transform: scale(1.1);
}

.cyber-input::placeholder {
    color: rgba(255, 255, 255, 0.4);
}

.cyber-toggle-password {
    position: absolute;
    right: 12px;
    color: rgba(255, 255, 255, 0.6);
    transition: all 0.3s ease;
    z-index: 2;
    padding: 4px;
}

.cyber-toggle-password:hover {
    color: var(--neon-cyan);
    transform: scale(1.1);
}

.cyber-checkbox-label {
    display: flex;
    align-items: center;
    cursor: pointer;
}

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

.cyber-submit-btn {
    width: 100%;
    padding: 14px 20px;
    background: linear-gradient(135deg, var(--neon-cyan), var(--neon-purple));
    border: none;
    border-radius: 8px;
    color: white;
    font-weight: 600;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.cyber-submit-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s ease;
}

.cyber-submit-btn:hover::before {
    left: 100%;
}

.cyber-submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(0, 255, 255, 0.4);
    background: linear-gradient(135deg, var(--neon-pink), var(--cyber-red));
}

.cyber-submit-btn:active {
    transform: translateY(0);
}

/* Captcha Styles */
.cyber-captcha-container {
    display: flex;
    align-items: center;
    background: rgba(0, 0, 0, 0.4);
    border: 1px solid rgba(0, 255, 255, 0.3);
    border-radius: 8px;
    padding: 12px;
    gap: 8px;
    backdrop-filter: blur(10px);
    min-width: 120px;
}

.cyber-captcha-text {
    font-family: 'Courier New', monospace;
    font-size: 18px;
    font-weight: bold;
    color: var(--neon-cyan);
    text-decoration: line-through;
    letter-spacing: 2px;
    text-shadow: 0 0 10px rgba(0, 255, 255, 0.5);
}

.cyber-refresh-btn {
    color: var(--neon-purple);
    transition: all 0.3s ease;
    padding: 4px;
    border-radius: 4px;
}

.cyber-refresh-btn:hover {
    color: var(--neon-cyan);
    transform: rotate(180deg) scale(1.1);
    background: rgba(0, 255, 255, 0.1);
}

/* Modal Container Fixes */
.cyber-modal-container {
    display: flex;
    flex-direction: column;
}

.cyber-modal-content {
    display: flex;
    flex-direction: column;
    min-height: 0;
}

/* Custom Scrollbar for Modal */
.flex-1.overflow-y-auto {
    scrollbar-width: thin;
    scrollbar-color: var(--neon-cyan) rgba(0, 0, 0, 0.3);
    overflow-y: scroll !important;
    max-height: none;
}

.flex-1.overflow-y-auto::-webkit-scrollbar {
    width: 8px;
}

.flex-1.overflow-y-auto::-webkit-scrollbar-track {
    background: rgba(0, 0, 0, 0.3);
    border-radius: 4px;
}

.flex-1.overflow-y-auto::-webkit-scrollbar-thumb {
    background: linear-gradient(180deg, var(--neon-cyan), var(--neon-purple));
    border-radius: 4px;
    box-shadow: 0 0 10px rgba(0, 255, 255, 0.3);
}

.flex-1.overflow-y-auto::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(180deg, var(--neon-pink), var(--cyber-red));
    box-shadow: 0 0 15px rgba(255, 0, 128, 0.5);
}

/* Responsive Design */
@media (max-width: 640px) {
    .cyber-modal-container {
        margin: 8px;
        max-width: none;
        max-height: calc(100vh - 16px);
        display: flex;
        flex-direction: column;
    }
    
    .cyber-modal-content {
        max-height: calc(100vh - 16px);
        overflow: hidden;
    }
    
    .cyber-logo {
        height: 40px;
    }
    
    .cyber-input {
        font-size: 16px; /* Prevents zoom on iOS */
        padding: 10px 10px 10px 36px;
    }
    
    .cyber-header {
        padding: 12px 16px;
        flex-shrink: 0;
    }
    
    .flex-1.overflow-y-auto {
        padding: 0 16px 16px;
        flex: 1;
        min-height: 0;
        overflow-y: auto !important;
    }
    
    .cyber-captcha-container {
        min-width: 100px;
        padding: 8px;
    }
    
    .cyber-captcha-text {
        font-size: 16px;
    }
    
    .cyber-form {
        padding-bottom: 20px;
    }
}
</style>

<script>
// Global captcha variable
let currentCaptcha = '';

// Generate random captcha
function generateCaptcha() {
    currentCaptcha = Math.floor(10000 + Math.random() * 90000).toString();
    document.getElementById('captchaDisplay').textContent = currentCaptcha;
    
    // Add animation effect
    const captchaEl = document.getElementById('captchaDisplay');
    captchaEl.style.transform = 'scale(0.8)';
    setTimeout(() => {
        captchaEl.style.transform = 'scale(1)';
    }, 150);
}

// Initialize captcha on page load
document.addEventListener('DOMContentLoaded', function() {
    generateCaptcha();
});

// Password Toggle Functions
function togglePassword(type) {
    let input, button;
    
    if (type === 'login') {
        input = document.querySelector('#loginForm .cyber-password-input');
        button = document.querySelector('#loginForm .cyber-toggle-password i');
    } else if (type === 'register') {
        input = document.querySelector('#registerForm .cyber-password-input[name="password"]');
        button = document.querySelector('#registerForm .cyber-toggle-password i');
    } else if (type === 'confirm') {
        input = document.querySelector('#registerForm .cyber-password-input[name="password_confirmation"]');
        button = document.querySelectorAll('#registerForm .cyber-toggle-password i')[1];
    }
    
    if (input && button) {
        if (input.type === 'password') {
            input.type = 'text';
            button.classList.remove('fa-eye');
            button.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            button.classList.remove('fa-eye-slash');
            button.classList.add('fa-eye');
        }
    }
}

// Tab Toggle Functions
document.getElementById('loginTab').addEventListener('click', function() {
    // Switch to login
    this.classList.add('cyber-tab-active');
    document.getElementById('registerTab').classList.remove('cyber-tab-active');
    
    // Move indicator
    document.querySelector('.cyber-tab-indicator').style.transform = 'translateX(0%)';
    
    // Show/hide forms
    document.getElementById('loginForm').classList.remove('hidden');
    document.getElementById('registerForm').classList.add('hidden');
});

document.getElementById('registerTab').addEventListener('click', function() {
    // Switch to register
    this.classList.add('cyber-tab-active');
    document.getElementById('loginTab').classList.remove('cyber-tab-active');
    
    // Move indicator
    document.querySelector('.cyber-tab-indicator').style.transform = 'translateX(100%)';
    
    // Show/hide forms
    document.getElementById('registerForm').classList.remove('hidden');
    document.getElementById('loginForm').classList.add('hidden');
});

// Form Submissions
document.getElementById('loginForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const btn = this.querySelector('.cyber-submit-btn');
    btn.innerHTML = '<span class="relative z-10"><i class="fas fa-spinner fa-spin mr-2"></i>Connecting...</span>';
    
    try {
        const formData = new FormData(this);
        const res = await fetch('{{ route('auth.login') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        });
        let data = null;
        const ct = res.headers.get('content-type') || '';
        if (ct.includes('application/json')) {
            data = await res.json();
        } else {
            const text = await res.text();
            throw new Error('Server mengembalikan respons tak terduga saat login.');
        }
        if (!res.ok || !data.success) {
            const msg = data.message || (data.errors ? Object.values(data.errors).flat().join('\n') : 'Login gagal');
            throw new Error(msg);
        }
        window.location.href = data.redirect || '{{ route('dashboard') }}';
    } catch (err) {
        alert(err.message);
        btn.innerHTML = '<span class="relative z-10"><i class="fas fa-sign-in-alt mr-2"></i>Masuk Portal</span>';
    }
});

document.getElementById('registerForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const captchaInput = this.querySelector('input[name="captcha"]').value;
    if (captchaInput !== currentCaptcha) {
        alert('Kode verifikasi salah! Silakan coba lagi.');
        generateCaptcha();
        this.querySelector('input[name="captcha"]').value = '';
        this.querySelector('input[name="captcha"]').focus();
        return;
    }
    
    const btn = this.querySelector('.cyber-submit-btn');
    btn.innerHTML = '<span class="relative z-10"><i class="fas fa-spinner fa-spin mr-2"></i>Creating...</span>';
    
    try {
        const formData = new FormData(this);
        // map password confirmation to expected field name
        const pass = this.querySelector('input[name="password"]').value;
        const passConf = this.querySelector('input[name="password_confirmation"]').value;
        formData.append('password_confirmation', passConf);
        const res = await fetch('{{ route('auth.register') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        });
        let data = null;
        const ct = res.headers.get('content-type') || '';
        if (ct.includes('application/json')) {
            data = await res.json();
        } else {
            const text = await res.text();
            throw new Error('Server mengembalikan respons tak terduga saat registrasi.');
        }
        if (!res.ok || !data.success) {
            const msg = data.message || (data.errors ? Object.values(data.errors).flat().join('\n') : 'Registrasi gagal');
            throw new Error(msg);
        }
        window.location.href = data.redirect || '{{ route('dashboard') }}';
    } catch (err) {
        alert(err.message);
        btn.innerHTML = '<span class="relative z-10"><i class="fas fa-user-plus mr-2"></i>Daftar Portal</span>';
        generateCaptcha();
    }
});

// Open register modal function
function openRegisterModal() {
    document.getElementById('registerTab').click();
    openLoginModal();
}

// Close modal with animation
function closeLoginModal() {
    const modal = document.getElementById('loginModal');
    const container = modal.querySelector('.cyber-modal-container');
    
    container.style.animation = 'modalFadeOut 0.3s ease-in forwards';
    
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        container.style.animation = '';
    }, 300);
}

// Add fade out animation
const style = document.createElement('style');
style.textContent = `
    @keyframes modalFadeOut {
        from {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
        to {
            opacity: 0;
            transform: scale(0.9) translateY(20px);
        }
    }
`;
document.head.appendChild(style);

// Close modal on outside click
document.getElementById('loginModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeLoginModal();
    }
});

// Close modal on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && !document.getElementById('loginModal').classList.contains('hidden')) {
        closeLoginModal();
    }
});
</script>
