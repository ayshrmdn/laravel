<!-- Cyber Sidebar Header -->
<div class="cyber-sidebar-header text-center mb-8 relative">
    <!-- Neural Network Background -->
    <div class="absolute inset-0 opacity-20">
        <div class="neural-network"></div>
    </div>
    
    <!-- Avatar Container -->
    <div class="relative z-10">
        <div class="cyber-avatar-container mx-auto mb-4 relative" style="width: 96px; height: 96px;">
            <!-- Outer Ring -->
            <div class="cyber-ring absolute rounded-full border-2 border-cyan-400 opacity-50 animate-spin-slow" style="width: 96px; height: 96px; top: 0; left: 0;"></div>
            
            <!-- Inner Ring -->
            <div class="cyber-ring-inner absolute rounded-full border border-pink-400 opacity-30 animate-spin-reverse" style="width: 80px; height: 80px; top: 8px; left: 8px;"></div>
            
            <!-- Avatar Circle -->
            <div class="cyber-avatar absolute rounded-full bg-gradient-to-br from-cyan-400 via-purple-500 to-pink-500 flex items-center justify-center shadow-2xl" style="width: 72px; height: 72px; top: 12px; left: 12px;">
                @auth
                    <i class="fas fa-user-astronaut text-white text-2xl cyber-glow"></i>
                @else
                    <i class="fas fa-user-secret text-white text-2xl cyber-glow"></i>
                @endauth
            </div>
            
            <!-- Status Indicator -->
            <div class="status-indicator absolute rounded-full bg-green-400 border-2 border-gray-900 animate-pulse" style="width: 16px; height: 16px; bottom: 4px; right: 4px; z-index: 30;"></div>
        </div>
        
        <!-- Welcome Text -->
        <div class="cyber-welcome-text">
            @auth
                <p class="text-cyan-300 text-sm mt-1 font-mono tracking-wide">{{ auth()->user()->full_name ?? auth()->user()->username }}</p>
                <div class="cyber-status-bar mt-2">
                    <div class="flex items-center justify-center space-x-2 text-xs">
                        <span class="text-green-400">●</span>
                        <span class="text-green-300 font-mono">ONLINE</span>
                        <span class="text-green-400">●</span>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</div>

@guest
<!-- Cyber Guest Menu -->
<div class="cyber-menu-container space-y-3">
    <!-- Cyber Authentication Panel -->
    <div class="cyber-auth-panel relative p-4 mb-6 rounded-xl bg-gradient-to-br from-gray-900/80 to-gray-800/60 border border-cyan-400/30 backdrop-blur-sm">
        <!-- Circuit Board Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="circuit-pattern"></div>
        </div>
        
        <div class="relative z-10">
            <div class="text-center mb-4">
                <h3 class="text-cyan-300 font-mono text-sm mb-1">SILAHKAN LOGIN</h3>
            </div>
            
            <div class="space-y-3">
                <button onclick="openLoginModal()" class="cyber-login-btn w-full group relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-r from-cyan-500 to-blue-600 opacity-80 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative z-10 flex items-center justify-center py-3 px-4">
                        <i class="fas fa-sign-in-alt mr-2 text-white"></i>
                        <span class="text-white font-semibold text-sm">LOGIN</span>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                </button>
                
                <button onclick="openRegisterModal()" class="cyber-register-btn w-full group relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-r from-pink-500 to-purple-600 opacity-80 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative z-10 flex items-center justify-center py-3 px-4 border border-pink-400/50 rounded-lg">
                        <i class="fas fa-user-plus mr-2 text-white"></i>
                        <span class="text-white font-semibold text-sm">REGISTER</span>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                </button>
            </div>
            

        </div>
    </div>

    <!-- Cyber Navigation Menu -->
    <div class="cyber-nav-menu space-y-2">
        <a href="{{ route('home') }}" class="cyber-nav-item {{ request()->routeIs('home') ? 'active' : '' }}" data-nav="home">
            <div class="cyber-nav-icon">
                <i class="fas fa-home"></i>
            </div>
            <span class="cyber-nav-text">HOME</span>
            <div class="cyber-nav-arrow">
                <i class="fas fa-chevron-right"></i>
            </div>
        </a>
        
        <a href="#" class="cyber-nav-item" data-nav="promo">
            <div class="cyber-nav-icon">
                <i class="fas fa-fire"></i>
            </div>
            <span class="cyber-nav-text">PROMOTIONS</span>
            <div class="cyber-nav-arrow">
                <i class="fas fa-chevron-right"></i>
            </div>
        </a>
        
        <a href="{{ route('live-chat') }}" class="cyber-nav-item" data-nav="help">
            <div class="cyber-nav-icon">
                <i class="fas fa-headset"></i>
            </div>
            <span class="cyber-nav-text">LIVECHAT</span>
            <div class="cyber-nav-arrow">
                <i class="fas fa-chevron-right"></i>
            </div>
        </a>
    </div>
</div>
@endguest

@auth
<!-- Cyber Authenticated User Menu -->
<div class="cyber-user-menu space-y-3">
    <!-- Cyber Wallet Interface -->
    <div class="cyber-wallet-panel relative p-4 mb-6 rounded-xl bg-gradient-to-br from-emerald-900/50 to-teal-800/30 border border-emerald-400/40 backdrop-blur-sm overflow-hidden">
        <!-- Digital Grid Background -->
        <div class="absolute inset-0 opacity-20">
            <div class="digital-grid"></div>
        </div>
        
        <div class="relative z-10">
            <div class="text-center mb-4">
                <h3 class="text-emerald-300 font-mono text-sm mb-1">WALLET SYSTEM</h3>
                <div class="cyber-balance-display">
                    <p class="text-gray-300 text-xs mb-1">Current Balance</p>
                    <div class="bg-black/50 rounded-lg px-3 py-2 border border-emerald-400/30">
                        <p class="text-emerald-300 text-lg font-mono font-bold tracking-wider">
                            IDR {{ number_format(0, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-2 gap-2">
                <button class="cyber-wallet-btn deposit-btn group relative overflow-hidden rounded-lg border border-green-400/50 p-3">
                    <div class="absolute inset-0 bg-gradient-to-br from-green-500/80 to-emerald-600/80 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>
                    <div class="relative z-10 flex flex-col items-center">
                        <i class="fas fa-arrow-up text-green-400 group-hover:text-white transition-colors duration-300 mb-1"></i>
                        <span class="text-xs font-mono text-green-300 group-hover:text-white transition-colors duration-300">DEPOSIT</span>
                    </div>
                </button>
                
                <button class="cyber-wallet-btn withdraw-btn group relative overflow-hidden rounded-lg border border-orange-400/50 p-3">
                    <div class="absolute inset-0 bg-gradient-to-br from-orange-500/80 to-red-600/80 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-right"></div>
                    <div class="relative z-10 flex flex-col items-center">
                        <i class="fas fa-arrow-down text-orange-400 group-hover:text-white transition-colors duration-300 mb-1"></i>
                        <span class="text-xs font-mono text-orange-300 group-hover:text-white transition-colors duration-300">WITHDRAW</span>
                    </div>
                </button>
            </div>
        </div>
    </div>

    <!-- Cyber Navigation Menu -->
    <div class="cyber-nav-menu space-y-2">
        <a href="{{ route('home') }}" class="cyber-nav-item {{ request()->routeIs('home') ? 'active' : '' }}" data-nav="home">
            <div class="cyber-nav-icon">
                <i class="fas fa-home"></i>
            </div>
            <span class="cyber-nav-text">HOME</span>
            <div class="cyber-nav-arrow">
                <i class="fas fa-chevron-right"></i>
            </div>
        </a>
        
        <a href="#" class="cyber-nav-item" data-nav="dashboard">
            <div class="cyber-nav-icon">
                <i class="fas fa-tachometer-alt"></i>
            </div>
            <span class="cyber-nav-text">CONTROL_PANEL</span>
            <div class="cyber-nav-arrow">
                <i class="fas fa-chevron-right"></i>
            </div>
        </a>
        
        <a href="#" class="cyber-nav-item" data-nav="wallet">
            <div class="cyber-nav-icon">
                <i class="fas fa-credit-card"></i>
            </div>
            <span class="cyber-nav-text">TRANSACTIONS</span>
            <div class="cyber-nav-arrow">
                <i class="fas fa-chevron-right"></i>
            </div>
        </a>
        
        <a href="#" class="cyber-nav-item" data-nav="history">
            <div class="cyber-nav-icon">
                <i class="fas fa-history"></i>
            </div>
            <span class="cyber-nav-text">GAME_LOGS</span>
            <div class="cyber-nav-arrow">
                <i class="fas fa-chevron-right"></i>
            </div>
        </a>
        
        <a href="#" class="cyber-nav-item" data-nav="promo">
            <div class="cyber-nav-icon">
                <i class="fas fa-fire"></i>
            </div>
            <span class="cyber-nav-text">PROMOTIONS</span>
            <div class="cyber-nav-arrow">
                <i class="fas fa-chevron-right"></i>
            </div>
        </a>
        
        <a href="#" class="cyber-nav-item" data-nav="referral">
            <div class="cyber-nav-icon">
                <i class="fas fa-users"></i>
            </div>
            <span class="cyber-nav-text">REFERRAL_NET</span>
            <div class="cyber-nav-arrow">
                <i class="fas fa-chevron-right"></i>
            </div>
        </a>
        
        <a href="#" class="cyber-nav-item" data-nav="profile">
            <div class="cyber-nav-icon">
                <i class="fas fa-user-cog"></i>
            </div>
            <span class="cyber-nav-text">USER_CONFIG</span>
            <div class="cyber-nav-arrow">
                <i class="fas fa-chevron-right"></i>
            </div>
        </a>
        
        <a href="{{ route('live-chat') }}" class="cyber-nav-item" data-nav="help">
            <div class="cyber-nav-icon">
                <i class="fas fa-headset"></i>
            </div>
            <span class="cyber-nav-text">LIVECHAT</span>
            <div class="cyber-nav-arrow">
                <i class="fas fa-chevron-right"></i>
            </div>
        </a>
        
        <!-- Cyber Logout -->
        <form method="POST" action="#" class="mt-4">
            @csrf
            <button type="submit" class="cyber-nav-item logout-item w-full text-left" data-nav="logout">
                <div class="cyber-nav-icon">
                    <i class="fas fa-power-off text-red-400"></i>
                </div>
                <span class="cyber-nav-text text-red-300">LOGOUT_SYS</span>
                <div class="cyber-nav-arrow">
                    <i class="fas fa-chevron-right text-red-400"></i>
                </div>
            </button>
        </form>
    </div>
</div>
@endauth

<!-- Cyber Footer -->
<div class="cyber-footer mt-8 pt-6 border-t border-cyan-400/30 relative">
    <!-- Binary Code Background -->
    <div class="absolute inset-0 opacity-10">
        <div class="binary-code"></div>
    </div>
    
    <div class="relative z-10 text-center">
        <div class="cyber-logo mb-3">
            <h3 class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 via-purple-400 to-pink-400 text-sm font-mono font-bold tracking-wider">
                {{ \App\Models\Setting::get('site_name', 'MPOELOT') }}
            </h3>
            <div class="flex items-center justify-center mt-1">
                <div class="h-px bg-gradient-to-r from-transparent via-cyan-400 to-transparent flex-1"></div>
                <span class="text-xs text-gray-400 font-mono mx-2">SECURE</span>
                <div class="h-px bg-gradient-to-r from-transparent via-cyan-400 to-transparent flex-1"></div>
            </div>
        </div>
        
        <p class="text-gray-400 text-xs font-mono mb-4">{{ strtoupper(\App\Models\Setting::get('site_description', 'Situs Game Online Terpercaya')) }}</p>
        
        <!-- Cyber Social Links -->
        <div class="cyber-social-grid flex justify-center space-x-3">
            <a href="#" class="cyber-social-btn" data-platform="facebook">
                <div class="cyber-social-icon">
                    <i class="fab fa-facebook-f"></i>
                </div>
            </a>
            <a href="#" class="cyber-social-btn" data-platform="instagram">
                <div class="cyber-social-icon">
                    <i class="fab fa-instagram"></i>
                </div>
            </a>
            <a href="#" class="cyber-social-btn" data-platform="telegram">
                <div class="cyber-social-icon">
                    <i class="fab fa-telegram-plane"></i>
                </div>
            </a>
            <a href="#" class="cyber-social-btn" data-platform="whatsapp">
                <div class="cyber-social-icon">
                    <i class="fab fa-whatsapp"></i>
                </div>
            </a>
        </div>
        
        <!-- Version Info -->
        <div class="cyber-version-info mt-4 text-center">
            <span class="text-xs font-mono text-gray-500">v2.0.77 | SECURE_CONNECTION</span>
        </div>
    </div>
</div>

<style>
/* Cyber Avatar Container */
.cyber-avatar-container {
    position: relative;
    margin: 0 auto;
}

/* Ring Animations */
@keyframes animate-spin-slow {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

@keyframes animate-spin-reverse {
    from { transform: rotate(360deg); }
    to { transform: rotate(0deg); }
}

.animate-spin-slow {
    animation: animate-spin-slow 8s linear infinite;
    transform-origin: center;
}

.animate-spin-reverse {
    animation: animate-spin-reverse 12s linear infinite;
    transform-origin: center;
}

/* Cyber Glow Effects */
.cyber-glow {
    filter: drop-shadow(0 0 8px currentColor);
    animation: cyberIconGlow 2s ease-in-out infinite alternate;
}

@keyframes cyberIconGlow {
    0% { filter: drop-shadow(0 0 5px currentColor); }
    100% { filter: drop-shadow(0 0 15px currentColor); }
}

.cyber-text-glow {
    animation: cyberTextGlow 3s ease-in-out infinite alternate;
}

@keyframes cyberTextGlow {
    0% { text-shadow: 0 0 10px currentColor; }
    100% { text-shadow: 0 0 20px currentColor, 0 0 30px currentColor; }
}

/* Neural Network Pattern */
.neural-network {
    background-image: 
        radial-gradient(circle at 20% 20%, rgba(0, 255, 255, 0.1) 2px, transparent 2px),
        radial-gradient(circle at 80% 80%, rgba(255, 0, 128, 0.1) 2px, transparent 2px),
        radial-gradient(circle at 40% 60%, rgba(255, 215, 0, 0.1) 2px, transparent 2px);
    background-size: 50px 50px;
    animation: neuralPulse 4s ease-in-out infinite;
}

@keyframes neuralPulse {
    0%, 100% { opacity: 0.3; }
    50% { opacity: 0.7; }
}

/* Circuit Board Pattern */
.circuit-pattern {
    background-image: 
        linear-gradient(90deg, rgba(0, 255, 255, 0.1) 1px, transparent 1px),
        linear-gradient(rgba(0, 255, 255, 0.1) 1px, transparent 1px);
    background-size: 20px 20px;
    animation: circuitFlow 6s linear infinite;
}

@keyframes circuitFlow {
    0% { background-position: 0 0; }
    100% { background-position: 20px 20px; }
}

/* Digital Grid Pattern */
.digital-grid {
    background-image: 
        linear-gradient(rgba(0, 255, 255, 0.1) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0, 255, 255, 0.1) 1px, transparent 1px);
    background-size: 15px 15px;
    animation: digitalFlow 8s linear infinite;
}

@keyframes digitalFlow {
    0% { background-position: 0 0; }
    100% { background-position: 15px 15px; }
}

/* Binary Code Pattern */
.binary-code::before {
    content: "0101 1001 0110 1100 0011 1010 0101 1001 0110 1100 0011 1010";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    font-family: 'Courier New', monospace;
    font-size: 8px;
    line-height: 12px;
    color: rgba(0, 255, 255, 0.2);
    overflow: hidden;
    white-space: pre-wrap;
    animation: binaryFlow 20s linear infinite;
}

@keyframes binaryFlow {
    0% { transform: translateY(0); }
    100% { transform: translateY(-50px); }
}

/* Cyber Navigation Items */
.cyber-nav-item {
    display: flex;
    align-items: center;
    padding: 12px 16px;
    margin: 4px 0;
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(0, 255, 255, 0.1);
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    font-family: 'Courier New', monospace;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.cyber-nav-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(0, 255, 255, 0.2), transparent);
    transition: left 0.5s ease;
}

.cyber-nav-item:hover::before {
    left: 100%;
}

.cyber-nav-item:hover {
    background: rgba(0, 255, 255, 0.1);
    border-color: rgba(0, 255, 255, 0.3);
    color: rgba(255, 255, 255, 1);
    transform: translateX(5px);
    box-shadow: 0 0 15px rgba(0, 255, 255, 0.3);
}

.cyber-nav-item.active {
    background: rgba(0, 255, 255, 0.15);
    border-color: rgba(0, 255, 255, 0.4);
    color: rgba(0, 255, 255, 1);
    box-shadow: 0 0 20px rgba(0, 255, 255, 0.4);
}

.cyber-nav-item.logout-item:hover {
    background: rgba(255, 0, 64, 0.1);
    border-color: rgba(255, 0, 64, 0.3);
    box-shadow: 0 0 15px rgba(255, 0, 64, 0.3);
}

.cyber-nav-icon {
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 12px;
    font-size: 14px;
}

.cyber-nav-text {
    flex: 1;
    font-weight: 600;
    letter-spacing: 1px;
}

.cyber-nav-arrow {
    width: 16px;
    height: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: all 0.3s ease;
    font-size: 10px;
}

.cyber-nav-item:hover .cyber-nav-arrow {
    opacity: 1;
    transform: translateX(3px);
}

/* Cyber Social Buttons */
.cyber-social-btn {
    position: relative;
    display: inline-block;
    width: 32px;
    height: 32px;
    border-radius: 6px;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(0, 255, 255, 0.2);
    transition: all 0.3s ease;
}

.cyber-social-btn:hover {
    transform: translateY(-2px) scale(1.1);
    border-color: rgba(0, 255, 255, 0.5);
    box-shadow: 0 4px 15px rgba(0, 255, 255, 0.3);
}

.cyber-social-icon {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    color: rgba(255, 255, 255, 0.7);
    font-size: 14px;
    transition: all 0.3s ease;
}

.cyber-social-btn:hover .cyber-social-icon {
    color: rgba(0, 255, 255, 1);
    filter: drop-shadow(0 0 8px currentColor);
}

/* Platform specific colors */
.cyber-social-btn[data-platform="facebook"]:hover {
    border-color: #1877f2;
    box-shadow: 0 4px 15px rgba(24, 119, 242, 0.3);
}

.cyber-social-btn[data-platform="facebook"]:hover .cyber-social-icon {
    color: #1877f2;
}

.cyber-social-btn[data-platform="instagram"]:hover {
    border-color: #e4405f;
    box-shadow: 0 4px 15px rgba(228, 64, 95, 0.3);
}

.cyber-social-btn[data-platform="instagram"]:hover .cyber-social-icon {
    color: #e4405f;
}

.cyber-social-btn[data-platform="telegram"]:hover {
    border-color: #0088cc;
    box-shadow: 0 4px 15px rgba(0, 136, 204, 0.3);
}

.cyber-social-btn[data-platform="telegram"]:hover .cyber-social-icon {
    color: #0088cc;
}

.cyber-social-btn[data-platform="whatsapp"]:hover {
    border-color: #25d366;
    box-shadow: 0 4px 15px rgba(37, 211, 102, 0.3);
}

.cyber-social-btn[data-platform="whatsapp"]:hover .cyber-social-icon {
    color: #25d366;
}

/* Cyber Login/Register Buttons */
.cyber-login-btn, .cyber-register-btn {
    border-radius: 8px;
    border: 1px solid rgba(0, 255, 255, 0.3);
    overflow: hidden;
    transition: all 0.3s ease;
}

.cyber-login-btn:hover, .cyber-register-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
}
</style>
