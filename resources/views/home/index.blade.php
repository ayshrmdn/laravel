@extends('layouts.main')

@section('title', 'MPOELOT - Situs Game Online Terpercaya')

@section('content')
<!-- Sticky Announcement Ticker -->
<div class="text-white shadow-lg overflow-hidden sticky-announcement" style="background: linear-gradient(90deg, #00FFFF 0%, #FF0080 25%, #8B00FF 50%, #FF0040 75%, #00FFFF 100%);">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-1 left-8 w-1.5 h-1.5 bg-white rounded-full animate-pulse"></div>
        <div class="absolute top-2 right-16 w-1 h-1 bg-white rounded-full animate-pulse" style="animation-delay: 0.5s;"></div>
        <div class="absolute bottom-1 left-1/3 w-1.5 h-1.5 bg-white rounded-full animate-pulse" style="animation-delay: 1s;"></div>
    </div>
    
    <div class="relative py-0.5">
        <div class="flex items-center min-h-6">
            <!-- Announcement Icon -->
            <div class="flex-shrink-0 px-2 flex items-center">
                <div class="bg-white bg-opacity-20 rounded-full p-0.5 animate-pulse">
                    <i class="fas fa-bullhorn text-xs text-cyan-100"></i>
                </div>
            </div>
            
            <!-- Scrolling Content -->
            <div class="flex-1 overflow-hidden">
                <div id="marqueeContent" class="flex animate-smooth-marquee whitespace-nowrap">
                    <div class="flex items-center">
                        <span class="mx-4 sm:mx-8 text-xs sm:text-sm font-bold text-white">
                            Selamat Datang Di BOSCUAN69. Sebagai Penyedia Game Online Resmi Deposit Pulsa Tanpa Potongan Dan Depo Qris & Emoney Terpercaya...
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bottom border effect -->
    <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-cyan-400 via-pink-400 to-red-400"></div>
</div>

<!-- Welcome Banner -->
<div class="relative overflow-hidden">
    
    <!-- Sliding Banner -->
    <div class="relative">
        <div id="bannerSlider" class="flex transition-transform duration-500 ease-in-out">
            @foreach($banners as $index => $banner)
            <div class="min-w-full relative bg-gradient-to-r from-red-900 via-purple-900 to-red-800">
                @if($banner->image)
                    <img src="{{ asset('storage/' . $banner->image) }}" alt="Banner {{ $index + 1 }}" class="w-full h-auto max-h-80 object-cover">
                @else
                    <div class="w-full h-48 bg-gradient-to-r from-red-900 via-purple-900 to-red-800"></div>
                @endif
            </div>
            @endforeach
        </div>
        
        <!-- Slider Controls -->
        <button id="prevSlide" class="absolute left-2 sm:left-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 sm:p-3 rounded-full hover:bg-opacity-70 transition-all duration-200 shadow-lg">
            <i class="fas fa-chevron-left text-sm sm:text-base"></i>
        </button>
        <button id="nextSlide" class="absolute right-2 sm:right-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 sm:p-3 rounded-full hover:bg-opacity-70 transition-all duration-200 shadow-lg">
            <i class="fas fa-chevron-right text-sm sm:text-base"></i>
        </button>
        
        <!-- Slider Indicators -->
        <div class="absolute bottom-3 sm:bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-1 sm:space-x-2">
            @foreach($banners as $index => $banner)
            <button class="slider-indicator w-2 h-2 sm:w-3 sm:h-3 rounded-full bg-white bg-opacity-50 hover:bg-opacity-100 transition-all duration-200 {{ $index === 0 ? 'bg-opacity-100' : '' }}" data-slide="{{ $index }}"></button>
            @endforeach
        </div>
    </div>
</div>

<!-- Categories Horizontal Slider -->
<div class="bg-gray-900 py-4">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Horizontal Categories Slider -->
        <div class="relative">
            <div class="flex overflow-x-auto scrollbar-hide space-x-4 pb-2 justify-center" id="categoriesSlider">
                @foreach($categories as $category)
                    <div class="flex-shrink-0 group cursor-pointer" onclick="handleCategoryClick('{{ $category->name }}')">
                        <div class="flex flex-col items-center justify-center w-16 h-16 bg-gray-800 rounded-lg hover:bg-gray-700 transition-colors duration-200 group-hover:scale-105">
                            <!-- Icon -->
                            <div class="text-center">
                                <i class="{{ $category->icon }} text-xl mb-1 category-icon" data-color="{{ $category->color }}"></i>
                            </div>
                        </div>
                        <!-- Category Name -->
                        <p class="text-xs text-gray-400 text-center mt-1 w-16 truncate group-hover:text-white transition-colors">
                            {{ $category->name }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- GIF Banner Horizontal with Jackpot -->
@if($gifBanner)
<div class="w-full bg-black relative">
    <div class="relative overflow-hidden jackpot-frame">
                 <img src="{{ asset('storage/' . $gifBanner) }}" 
              alt="GIF Banner" 
              class="w-full h-auto max-h-48 object-cover object-center gif-banner-img"
              style="animation: subtle-glow 3s ease-in-out infinite alternate;">
 
         <!-- Jackpot Overlay -->
         <div class="absolute inset-0 flex items-center justify-end pr-6 jackpot-overlay">
                <div class="flex items-center space-x-2">
         <span class="jackpot-currency text-yellow-400 text-xl md:text-xl font-bold">IDR</span>
             <span id="jackpot-amount" class="jackpot-number text-yellow-300 text-2xl md:text-2xl font-mono font-black tracking-wider">
                     1.250.000.000
                 </span>
             </div>
         </div>
    </div>
</div>
@endif

<!-- Game Populer Section -->
<div class="bg-gray-900 relative overflow-hidden">
    <!-- Cyber Background Effects -->
    <div class="absolute inset-0 opacity-30">
        <div class="absolute inset-0" style="background-image: linear-gradient(rgba(0, 255, 255, 0.1) 1px, transparent 1px), linear-gradient(90deg, rgba(0, 255, 255, 0.1) 1px, transparent 1px); background-size: 50px 50px; animation: gridMove 20s linear infinite;">
        </div>
        <div class="absolute top-10 left-10 w-2 h-2 bg-cyan-400 rounded-full animate-pulse"></div>
        <div class="absolute top-20 right-16 w-1 h-1 bg-pink-400 rounded-full animate-pulse" style="animation-delay: 1s;"></div>
        <div class="absolute bottom-16 left-1/3 w-1.5 h-1.5 bg-purple-400 rounded-full animate-pulse" style="animation-delay: 2s;"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 py-8">
        <!-- Section Header -->
        <div class="text-center mb-8 flex items-center justify-center">
            <div class="cyber-title-container relative inline-block">
                <h2 class="text-3xl md:text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 via-purple-400 to-pink-400 mb-2 cyber-glow-text">
                    GAME POPULER
                </h2>
            

        <!-- Games Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
            @foreach($popularGames as $game)
            <div class="cyber-game-card group cursor-pointer" data-game-name="{{ $game['name'] }}" onclick="handleGameClick(this.dataset.gameName)">
                <div class="cyber-game-container">
                    <!-- Game Image -->
                    <div class="cyber-image-wrapper">
                        <img src="{{ $game['image'] }}" alt="{{ $game['name'] }}" class="cyber-game-image">
                        <div class="cyber-image-overlay">
                            <div class="cyber-play-btn">
                                <i class="fas fa-play"></i>
                            </div>
                        </div>
                        <!-- Hot Badge -->
                        <div class="cyber-hot-badge">
                            <span class="text-xs font-bold">HOT</span>
                        </div>
                    </div>

                    <!-- Game Info -->
                    <div class="cyber-game-info">
                        <h3 class="cyber-game-title">{{ $game['name'] }}</h3>
                        <p class="cyber-game-provider">{{ $game['provider'] }}</p>
                    </div>

                    <!-- Cyber Effects -->
                    <div class="cyber-border-effect"></div>
                    <div class="cyber-glow-effect"></div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- View All Button -->
        <div class="text-center mt-8">
            <button onclick="handleViewAllGames()" class="cyber-view-all-btn">
                <span class="cyber-btn-text">LIHAT SEMUA GAME</span>
                <div class="cyber-btn-glow"></div>
                <div class="cyber-btn-border"></div>
            </button>
        </div>
    </div>
</div>

<!-- Cyber Service Stats Section -->
<div class="bg-black relative overflow-hidden py-12">
    <!-- Cyber Background Effects -->
    <div class="absolute inset-0 opacity-20">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25% 25%, rgba(0, 255, 255, 0.1) 2px, transparent 2px), radial-gradient(circle at 75% 75%, rgba(255, 0, 128, 0.1) 2px, transparent 2px); background-size: 60px 60px; animation: pulseGrid 8s ease-in-out infinite;">
        </div>
        <div class="absolute top-1/4 left-1/4 w-3 h-3 bg-cyan-400 rounded-full animate-pulse opacity-30"></div>
        <div class="absolute top-3/4 right-1/4 w-2 h-2 bg-pink-400 rounded-full animate-pulse opacity-30" style="animation-delay: 2s;"></div>
    </div>

    <div class="relative z-10 max-w-6xl mx-auto px-4">
        <!-- Section Header -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 via-purple-400 to-pink-400 mb-4 cyber-stats-title">
                SERVIS KAMI
            </h2>
            <div class="cyber-stats-underline"></div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
            <!-- Deposit Stats -->
            <div class="cyber-stat-card deposit-card">
                <div class="cyber-stat-container">
                    <div class="cyber-stat-icon">
                        <i class="fas fa-arrow-up"></i>
                    </div>
                    <div class="cyber-stat-content">
                        <h3 class="cyber-stat-label">DEPOSIT</h3>
                        <p class="cyber-stat-sublabel">Rata-rata</p>
                        <div class="cyber-stat-value">
                            <span class="cyber-stat-number">1</span>
                            <span class="cyber-stat-unit">Menit</span>
                        </div>
                    </div>
                    <div class="cyber-stat-effect"></div>
                </div>
            </div>

            <!-- Withdraw Stats -->
            <div class="cyber-stat-card withdraw-card">
                <div class="cyber-stat-container">
                    <div class="cyber-stat-icon">
                        <i class="fas fa-arrow-down"></i>
                    </div>
                    <div class="cyber-stat-content">
                        <h3 class="cyber-stat-label">WITHDRAW</h3>
                        <p class="cyber-stat-sublabel">Rata-rata</p>
                        <div class="cyber-stat-value">
                            <span class="cyber-stat-number">3</span>
                            <span class="cyber-stat-unit">Menit</span>
                        </div>
                    </div>
                    <div class="cyber-stat-effect"></div>
                </div>
            </div>

            <!-- Member Online Stats -->
            <div class="cyber-stat-card members-card">
                <div class="cyber-stat-container">
                    <div class="cyber-stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="cyber-stat-content">
                        <h3 class="cyber-stat-label">MEMBER ONLINE</h3>
                        <p class="cyber-stat-sublabel">Real-time</p>
                        <div class="cyber-stat-value">
                            <span class="cyber-stat-number" id="memberCount">804779</span>
                            <span class="cyber-stat-unit">Member/jam</span>
                        </div>
                    </div>
                    <div class="cyber-stat-effect"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Login Popup Modal -->
<div id="loginPopup" class="fixed inset-0 bg-black bg-opacity-80 items-center justify-center z-50 hidden" style="display: none;">
    <div class="bg-gray-900 rounded-2xl shadow-2xl border border-cyan-400/30 max-w-md w-full mx-4 transform transition-all duration-300">
        <!-- Header -->
        <div class="bg-gradient-to-r from-cyan-500 to-purple-600 text-white px-6 py-4 rounded-t-2xl">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-bold flex items-center">
                    <i class="fas fa-lock mr-2"></i>
                    Login Diperlukan
                </h3>
                <button onclick="closeLoginPopup()" class="text-white hover:text-red-400 transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
        </div>
        
        <!-- Body -->
        <div class="p-6 text-center">
            <div class="mb-6">
                <div class="w-16 h-16 bg-gradient-to-r from-cyan-400 to-purple-400 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-user-lock text-2xl text-black"></i>
                </div>
                <h4 class="text-xl font-bold text-white mb-2">Silahkan Login Terlebih Dahulu</h4>
                <p class="text-gray-400">Anda perlu login untuk mengakses kategori <span id="categoryName" class="text-cyan-400 font-semibold"></span></p>
            </div>
            
            <!-- Action Buttons -->
            <div class="space-y-3">
                <button onclick="openLoginFromPopup()" class="w-full bg-gradient-to-r from-cyan-500 to-purple-600 text-white font-semibold py-3 px-6 rounded-lg hover:from-cyan-600 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Login Sekarang
                </button>
                <button onclick="openRegisterFromPopup()" class="w-full bg-gray-700 text-white font-semibold py-3 px-6 rounded-lg hover:bg-gray-600 transition-all duration-300">
                    <i class="fas fa-user-plus mr-2"></i>
                    Daftar Akun Baru
                </button>
                <button onclick="closeLoginPopup()" class="w-full text-gray-400 hover:text-white transition-colors py-2">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
@verbatim
<style>
    @keyframes smoothMarquee {
        0% { transform: translateX(100%); }
        100% { transform: translateX(-100%); }
    }
    
    .animate-smooth-marquee {
        animation: smoothMarquee 30s linear infinite;
    }
    
    /* Mobile responsive marquee */
    @media (max-width: 640px) {
        .animate-smooth-marquee {
            animation: smoothMarquee 35s linear infinite;
        }
    }
    
    .animate-fade-in-up {
        animation: fadeInUp 0.6s ease-out forwards;
        opacity: 0;
        transform: translateY(20px);
    }
    
    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Hide scrollbar for categories slider */
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    
    .scrollbar-hide::-webkit-scrollbar { 
        display: none;
    }

    /* Categories slider smooth scrolling */
    #categoriesSlider {
        scroll-behavior: smooth;
    }

    /* Login popup animations */
    #loginPopup {
        transition: opacity 0.3s ease, transform 0.3s ease;
    }
    
    #loginPopup > div {
        transition: transform 0.3s ease;
    }

    /* GIF Banner glow animation */
    @keyframes subtle-glow {
        0% {
            filter: brightness(1) saturate(1) drop-shadow(0 0 10px rgba(0, 255, 255, 0.3));
        }
        100% {
            filter: brightness(1.1) saturate(1.2) drop-shadow(0 0 20px rgba(255, 0, 128, 0.4));
        }
    }

    /* Jackpot Digital Styling */
    .jackpot-number {
        text-shadow: 
            0 0 5px currentColor,
            0 0 10px currentColor,
            0 0 15px currentColor,
            0 0 20px #ffd700;
        filter: drop-shadow(0 0 8px rgba(255, 215, 0, 0.8));
        animation: digital-flicker 0.1s infinite alternate;
    }

    @keyframes digital-flicker {
        0% { opacity: 1; }
        98% { opacity: 1; }
        99% { opacity: 0.98; }
        100% { opacity: 1; }
    }

    /* Game Populer Section Styles */
    @keyframes gridMove {
        0% { background-position: 0 0; }
        100% { background-position: 50px 50px; }
    }

    .cyber-title-container {
        position: relative;
    }

    .cyber-glow-text {
        animation: titleGlow 3s ease-in-out infinite alternate;
        text-shadow: 0 0 20px rgba(0, 255, 255, 0.5);
    }

    @keyframes titleGlow {
        0% { 
            text-shadow: 0 0 20px rgba(0, 255, 255, 0.5);
        }
        100% { 
            text-shadow: 0 0 30px rgba(255, 0, 128, 0.7), 0 0 40px rgba(139, 0, 255, 0.5);
        }
    }

    .cyber-underline {
        position: absolute;
        bottom: -8px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 3px;
        background: linear-gradient(90deg, transparent, #00FFFF, #FF0080, #8B00FF, transparent);
        border-radius: 2px;
        animation: underlineGlow 2s ease-in-out infinite alternate;
    }

    @keyframes underlineGlow {
        0% { box-shadow: 0 0 5px rgba(0, 255, 255, 0.5); }
        100% { box-shadow: 0 0 15px rgba(255, 0, 128, 0.8); }
    }

    /* Cyber Game Card Styles */
    .cyber-game-card {
        position: relative;
        transform: perspective(1000px) rotateX(0deg);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .cyber-game-container {
        position: relative;
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.9) 0%, rgba(26, 11, 26, 0.8) 100%);
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid rgba(0, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        transition: all 0.4s ease;
    }

    .cyber-game-card:hover {
        transform: perspective(1000px) rotateX(5deg) translateY(-10px);
    }

    .cyber-game-card:hover .cyber-game-container {
        border-color: rgba(0, 255, 255, 0.6);
        box-shadow: 
            0 20px 40px rgba(0, 0, 0, 0.3),
            0 0 30px rgba(0, 255, 255, 0.3);
    }

    /* Image Wrapper */
    .cyber-image-wrapper {
        position: relative;
        aspect-ratio: 16/10;
        overflow: hidden;
    }

    .cyber-game-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all 0.4s ease;
    }

    .cyber-game-card:hover .cyber-game-image {
        transform: scale(1.1);
        filter: brightness(1.2) saturate(1.3);
    }

    .cyber-image-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(0, 255, 255, 0.1) 0%, rgba(255, 0, 128, 0.1) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.3s ease;
    }

    .cyber-game-card:hover .cyber-image-overlay {
        opacity: 1;
    }

    .cyber-play-btn {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #00FFFF, #8B00FF);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 18px;
        transform: scale(0.8);
        transition: all 0.3s ease;
        box-shadow: 0 0 20px rgba(0, 255, 255, 0.5);
    }

    .cyber-game-card:hover .cyber-play-btn {
        transform: scale(1);
        animation: pulseGlow 1.5s ease-in-out infinite;
    }

    @keyframes pulseGlow {
        0%, 100% { 
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.5);
            transform: scale(1);
        }
        50% { 
            box-shadow: 0 0 30px rgba(255, 0, 128, 0.8);
            transform: scale(1.1);
        }
    }

    /* Hot Badge */
    .cyber-hot-badge {
        position: absolute;
        top: 8px;
        right: 8px;
        background: linear-gradient(135deg, #FF0040, #FF0080);
        padding: 4px 8px;
        border-radius: 12px;
        font-family: 'Courier New', monospace;
        color: white;
        font-weight: bold;
        font-size: 10px;
        animation: hotBadgePulse 2s ease-in-out infinite;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    @keyframes hotBadgePulse {
        0%, 100% { 
            box-shadow: 0 0 10px rgba(255, 0, 64, 0.5);
            transform: scale(1);
        }
        50% { 
            box-shadow: 0 0 20px rgba(255, 0, 128, 0.8);
            transform: scale(1.05);
        }
    }

    /* Game Info */
    .cyber-game-info {
        padding: 16px 16px 20px 16px;
        position: relative;
    }

    .cyber-game-title {
        color: #00FFFF;
        font-weight: bold;
        font-size: 14px;
        margin-bottom: 4px;
        font-family: 'Courier New', monospace;
        text-shadow: 0 0 10px rgba(0, 255, 255, 0.5);
    }

    .cyber-game-provider {
        color: #8B5CF6;
        font-size: 11px;
        margin-bottom: 8px;
        opacity: 0.8;
    }



    /* Cyber Effects */
    .cyber-border-effect {
        position: absolute;
        inset: -2px;
        background: linear-gradient(45deg, #00FFFF, #FF0080, #8B00FF, #00FFFF);
        border-radius: 18px;
        z-index: -1;
        opacity: 0;
        transition: opacity 0.3s ease;
        animation: borderRotate 3s linear infinite;
    }

    .cyber-game-card:hover .cyber-border-effect {
        opacity: 0.7;
    }

    @keyframes borderRotate {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .cyber-glow-effect {
        position: absolute;
        inset: 0;
        border-radius: 16px;
        background: radial-gradient(circle at center, rgba(0, 255, 255, 0.1) 0%, transparent 70%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .cyber-game-card:hover .cyber-glow-effect {
        opacity: 1;
    }

    /* View All Button */
    .cyber-view-all-btn {
        position: relative;
        padding: 12px 32px;
        background: linear-gradient(135deg, rgba(0, 255, 255, 0.1), rgba(139, 0, 255, 0.1));
        border: 2px solid rgba(0, 255, 255, 0.3);
        border-radius: 25px;
        color: #00FFFF;
        font-family: 'Courier New', monospace;
        font-weight: bold;
        font-size: 14px;
        letter-spacing: 1px;
        cursor: pointer;
        overflow: hidden;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .cyber-view-all-btn:hover {
        border-color: rgba(255, 0, 128, 0.6);
        color: #FF0080;
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 255, 255, 0.3);
    }

    .cyber-btn-text {
        position: relative;
        z-index: 10;
    }

    .cyber-btn-glow {
        position: absolute;
        inset: 0;
        background: linear-gradient(45deg, transparent, rgba(0, 255, 255, 0.3), transparent);
        transform: translateX(-100%);
        transition: transform 0.6s ease;
    }

    .cyber-view-all-btn:hover .cyber-btn-glow {
        transform: translateX(100%);
    }

    .cyber-btn-border {
        position: absolute;
        inset: -2px;
        background: linear-gradient(45deg, #00FFFF, #FF0080, #8B00FF, #00FFFF);
        border-radius: 27px;
        z-index: -1;
        opacity: 0;
        transition: opacity 0.3s ease;
        animation: borderGlowRotate 3s linear infinite;
    }

    .cyber-view-all-btn:hover .cyber-btn-border {
        opacity: 0.8;
    }

    @keyframes borderGlowRotate {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* Cyber Service Stats Styles */
    @keyframes pulseGrid {
        0%, 100% { opacity: 0.2; transform: scale(1); }
        50% { opacity: 0.4; transform: scale(1.02); }
    }

    .cyber-stats-title {
        animation: none;
        text-shadow: none;
    }

    @keyframes statsGlow {
        0% { 
            text-shadow: 0 0 20px rgba(0, 255, 255, 0.5);
        }
        100% { 
            text-shadow: 0 0 30px rgba(255, 0, 128, 0.7), 0 0 40px rgba(139, 0, 255, 0.5);
        }
    }

    .cyber-stats-underline {
        width: 120px;
        height: 4px;
        background: linear-gradient(90deg, transparent, #00FFFF, #FF0080, #8B00FF, transparent);
        margin: 0 auto;
        border-radius: 2px;
        animation: underlinePulse 2s ease-in-out infinite alternate;
    }

    @keyframes underlinePulse {
        0% { box-shadow: 0 0 5px rgba(0, 255, 255, 0.5); opacity: 0.8; }
        100% { box-shadow: 0 0 15px rgba(255, 0, 128, 0.8); opacity: 1; }
    }

    .cyber-stat-card {
        position: relative;
        height: 120px;
        perspective: 1000px;
    }

    .cyber-stat-container {
        position: relative;
        height: 100%;
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.6) 0%, rgba(0, 0, 0, 0.6) 100%);
        border: 2px solid rgba(0, 255, 255, 0.3);
        border-radius: 16px;
        padding: 20px;
        backdrop-filter: none;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: flex-start;
        text-align: left;
        gap: 16px;
    }

    .cyber-stat-card:hover .cyber-stat-container {
        transform: translateY(-10px) rotateX(5deg);
        border-color: rgba(0, 255, 255, 0.6);
        box-shadow: 
            0 20px 40px rgba(0, 0, 0, 0.4),
            0 0 30px rgba(0, 255, 255, 0.4);
    }

    .cyber-stat-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #00FFFF, #8B00FF);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 20px;
        color: white;
        animation: none;
        border: 2px solid rgba(255, 255, 255, 0.3);
    }

    @keyframes iconFloat {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
    }

    .cyber-stat-content {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .cyber-stat-label {
        color: #00FFFF;
        font-family: 'Courier New', monospace;
        font-weight: bold;
        font-size: 14px;
        letter-spacing: 1px;
        margin-bottom: 2px;
        text-shadow: none;
    }

    .cyber-stat-sublabel {
        color: #A855F7;
        font-family: 'Courier New', monospace;
        font-size: 12px;
        font-weight: 500;
        margin-bottom: 8px;
        opacity: 1;
        text-shadow: none;
    }

    .cyber-stat-value {
        display: flex;
        flex-direction: row;
        align-items: baseline;
        gap: 6px;
    }

    .cyber-stat-number {
        color: #FFD700;
        font-family: 'Courier New', monospace;
        font-size: 28px;
        font-weight: bold;
        line-height: 1;
        text-shadow: none;
        animation: none;
    }

    .cyber-stat-unit {
        color: #FFD700;
        font-family: 'Courier New', monospace;
        font-size: 12px;
        opacity: 0.9;
    }

    @keyframes numberGlow {
        0% { 
            text-shadow: 0 0 5px #FFD700, 0 0 10px #FFD700;
            transform: scale(1);
        }
        100% { 
            text-shadow: 0 0 10px #FFD700, 0 0 20px #FFD700, 0 0 30px #FFD700;
            transform: scale(1.02);
        }
    }

    .cyber-stat-effect {
        position: absolute;
        inset: -2px;
        background: linear-gradient(45deg, #00FFFF, #FF0080, #8B00FF, #00FFFF);
        border-radius: 18px;
        z-index: -1;
        opacity: 0;
        transition: opacity 0.3s ease;
        animation: borderRotateStats 4s linear infinite;
    }

    .cyber-stat-card:hover .cyber-stat-effect {
        opacity: 0.6;
    }

    @keyframes borderRotateStats {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* Card specific colors */
    .deposit-card:hover .cyber-stat-container {
        border-color: rgba(16, 185, 129, 0.6);
        box-shadow: 
            0 20px 40px rgba(0, 0, 0, 0.4),
            0 0 30px rgba(16, 185, 129, 0.4);
    }

    .deposit-card .cyber-stat-icon {
        background: linear-gradient(135deg, #10B981, #059669);
    }

    .withdraw-card:hover .cyber-stat-container {
        border-color: rgba(245, 158, 11, 0.6);
        box-shadow: 
            0 20px 40px rgba(0, 0, 0, 0.4),
            0 0 30px rgba(245, 158, 11, 0.4);
    }

    .withdraw-card .cyber-stat-icon {
        background: linear-gradient(135deg, #F59E0B, #D97706);
    }

    .members-card:hover .cyber-stat-container {
        border-color: rgba(139, 92, 246, 0.6);
        box-shadow: 
            0 20px 40px rgba(0, 0, 0, 0.4),
            0 0 30px rgba(139, 92, 246, 0.4);
    }

    .members-card .cyber-stat-icon {
        background: linear-gradient(135deg, #8B5CF6, #7C3AED);
    }

    /* Sticky Announcement Ticker - positioned below header */
    .sticky-announcement {
        position: sticky;
        top: 64px; /* Position below header (header height is 64px/h-16) */
        z-index: 25; /* Lower than header (header is z-30) but higher than content */
        backdrop-filter: blur(10px);
        border-bottom: 1px solid rgba(0, 255, 255, 0.2);
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        width: 100%;
        left: 0;
        right: 0;
    }

    /* Sticky support handled globally; removed @supports to avoid linter issues */

    /* Fallback removed to avoid @supports; retain default sticky via class elsewhere */

    /* Responsive Design */
    @media (max-width: 640px) {
        .cyber-game-title {
            font-size: 12px;
        }
        
        .cyber-game-provider {
            font-size: 10px;
        }
        
        .cyber-play-btn {
            width: 40px;
            height: 40px;
            font-size: 14px;
        }
        
        /* Stats responsive */
        .cyber-stat-card {
            height: 100px;
        }
        
        .cyber-stat-container {
            padding: 16px;
            gap: 12px;
        }
        
        .cyber-stat-icon {
            width: 40px;
            height: 40px;
            font-size: 16px;
        }
        
        .cyber-stat-label {
            font-size: 12px;
        }
        
        .cyber-stat-sublabel {
            font-size: 11px;
        }
        
        .cyber-stat-number {
            font-size: 20px;
        }
        
        .cyber-stat-unit {
            font-size: 10px;
        }
        
        /* Mobile sticky announcement positioning */
        .sticky-announcement {
            top: 64px; /* Header height remains same on mobile */
        }
    }

    /* Desktop layout refinements */
    @media (min-width: 1024px) {
        .max-w-7xl, .max-w-6xl { margin-left: auto; margin-right: auto; }
        .gif-banner-img { border-radius: 12px; }
        .cyber-game-card { will-change: transform; }
        .cyber-game-card:hover .cyber-game-container { transform: translateY(-6px); }
        .cyber-game-container { border-radius: 14px; }
        .cyber-view-all-btn { border-width: 1.5px; }
        .cyber-stat-container { border-width: 1.5px; border-radius: 14px; }
        .sticky-announcement { border-radius: 0 0 12px 12px; }
    }

    /* Desktop: centered, narrower jackpot banner and aligned digits */
    @media (min-width: 1024px) {
        .jackpot-frame { max-width: 1100px; margin-left: auto; margin-right: auto; }
        .gif-banner-img { object-position: center; }
        .jackpot-overlay { padding-right: 3rem; }
        .jackpot-currency { font-size: 1rem; }
        #jackpot-amount { font-size: 1.4rem; letter-spacing: .08em; }
    }
</style>
@endverbatim


<script>
    // Smooth Marquee Animation
    function initSmoothMarquee() {
        const marqueeContent = document.getElementById('marqueeContent');
        if (marqueeContent) {
            const originalContent = marqueeContent.innerHTML;
            marqueeContent.innerHTML = originalContent + originalContent;
            
            marqueeContent.addEventListener('animationiteration', function() {
                this.style.animationPlayState = 'paused';
                setTimeout(() => {
                    this.style.animationPlayState = 'running';
                }, 100);
            });
        }
    }

    // Banner Slider
    let currentSlide = 0;
    const slides = document.querySelectorAll('#bannerSlider > div');
    const totalSlides = slides.length;
    const slider = document.getElementById('bannerSlider');
    const indicators = document.querySelectorAll('.slider-indicator');
    
    function updateSlider() {
        slider.style.transform = `translateX(-${currentSlide * 100}%)`;
        
        indicators.forEach((indicator, index) => {
            if (index === currentSlide) {
                indicator.classList.add('bg-opacity-100');
                indicator.classList.remove('bg-opacity-50');
            } else {
                indicator.classList.remove('bg-opacity-100');
                indicator.classList.add('bg-opacity-50');
            }
        });
    }
    
    function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides;
        updateSlider();
    }
    
    function prevSlide() {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        updateSlider();
    }
    
    // Event listeners
    document.getElementById('nextSlide').addEventListener('click', nextSlide);
    document.getElementById('prevSlide').addEventListener('click', prevSlide);
    
    // Indicator clicks
    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', () => {
            currentSlide = index;
            updateSlider();
        });
    });
    
    // Auto-slide
    setInterval(nextSlide, 5000);
    
    // Scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationDelay = `${Math.random() * 0.5}s`;
                entry.target.classList.add('animate-fade-in-up');
            }
        });
    }, observerOptions);
    
    document.querySelectorAll('.game-card, .game-category-card, .cyber-glow-hover').forEach(card => {
        observer.observe(card);
    });

    // Random Jackpot Animation
    function initJackpotAnimation() {
        const jackpotElement = document.getElementById('jackpot-amount');
        if (!jackpotElement) return;

        // Base jackpot amount (1.2 - 2.5 billion IDR)
        let baseAmount = 1200000000 + Math.random() * 1300000000;
        
        // Create digital beep sound effect (using Web Audio API)
        function playDigitalBeep() {
            try {
                const audioContext = new (window.AudioContext || window.webkitAudioContext)();
                const oscillator = audioContext.createOscillator();
                const gainNode = audioContext.createGain();
                
                oscillator.connect(gainNode);
                gainNode.connect(audioContext.destination);
                
                oscillator.frequency.setValueAtTime(800, audioContext.currentTime);
                oscillator.frequency.exponentialRampToValueAtTime(1200, audioContext.currentTime + 0.1);
                
                gainNode.gain.setValueAtTime(0.1, audioContext.currentTime);
                gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.1);
                
                oscillator.start();
                oscillator.stop(audioContext.currentTime + 0.1);
            } catch (e) {
                // Fallback if Web Audio API not supported
                console.log('Audio not supported');
            }
        }
        
        function updateJackpot() {
            // Add random increment (10k - 100k IDR every update)
            const increment = 10000 + Math.random() * 90000;
            baseAmount += increment;
            
            // Reset if too high (above 5 billion)
            if (baseAmount > 5000000000) {
                baseAmount = 1200000000 + Math.random() * 1300000000;
            }
            
            // Format number with dots as thousands separator
            const formattedAmount = Math.floor(baseAmount).toLocaleString('id-ID');
            
            // Add digital flicker effect during update
            jackpotElement.style.opacity = '0.7';
            jackpotElement.style.transform = 'scale(0.98)';
            
            // Play beep sound effect
            playDigitalBeep();
            
            setTimeout(() => {
                jackpotElement.textContent = formattedAmount;
                jackpotElement.style.opacity = '1';
                jackpotElement.style.transform = 'scale(1)';
                
                // Add brief glow effect
                jackpotElement.style.filter = 'brightness(1.3) drop-shadow(0 0 10px #ffd700)';
                setTimeout(() => {
                    jackpotElement.style.filter = '';
                }, 200);
            }, 100);
        }
        
        // Update jackpot every 2-4 seconds
        function scheduleNextUpdate() {
            const interval = 2000 + Math.random() * 2000; // 2-4 seconds
            setTimeout(() => {
                updateJackpot();
                scheduleNextUpdate();
            }, interval);
        }
        
        // Start the animation
        updateJackpot(); // Initial update
        scheduleNextUpdate();
    }

    // Initialize jackpot animation when page loads
    initJackpotAnimation();
    
    // Member Count Animation
    function initMemberCountAnimation() {
        const memberCountElement = document.getElementById('memberCount');
        if (!memberCountElement) return;

        // Base member count (800k - 900k)
        let baseMemberCount = 800000 + Math.random() * 100000;
        
        function updateMemberCount() {
            // Add random increment/decrement (-500 to +1500)
            const change = Math.random() * 2000 - 500;
            baseMemberCount += change;
            
            // Keep within realistic bounds (700k - 950k)
            if (baseMemberCount > 950000) {
                baseMemberCount = 950000;
            } else if (baseMemberCount < 700000) {
                baseMemberCount = 700000;
            }
            
            // Format number
            const formattedCount = Math.floor(baseMemberCount).toLocaleString('id-ID');
            
            // Add flicker effect during update
            memberCountElement.style.opacity = '0.8';
            memberCountElement.style.transform = 'scale(0.98)';
            
            setTimeout(() => {
                memberCountElement.textContent = formattedCount;
                memberCountElement.style.opacity = '1';
                memberCountElement.style.transform = 'scale(1)';
                
                // Add brief glow effect
                memberCountElement.style.textShadow = '0 0 15px #FFD700, 0 0 25px #FFD700, 0 0 35px #FFD700';
                setTimeout(() => {
                    memberCountElement.style.textShadow = '';
                }, 200);
            }, 100);
        }
        
        // Update member count every 3-6 seconds
        function scheduleNextMemberUpdate() {
            const interval = 3000 + Math.random() * 3000; // 3-6 seconds
            setTimeout(() => {
                updateMemberCount();
                scheduleNextMemberUpdate();
            }, interval);
        }
        
        // Start the animation
        updateMemberCount(); // Initial update
        scheduleNextMemberUpdate();
    }

    // Initialize member count animation
    initMemberCountAnimation();

    // Handle category click
    window.handleCategoryClick = function(categoryName) {
        const isAuthenticated = document.body.getAttribute('data-authenticated') === 'true';
        if (isAuthenticated) {
            console.log('Accessing category:', categoryName);
        } else {
            document.getElementById('categoryName').textContent = categoryName;
            showLoginPopup();
        }
    };

    // Handle game click
    window.handleGameClick = function(gameName) {
        const isAuthenticated = document.body.getAttribute('data-authenticated') === 'true';
        if (isAuthenticated) {
            console.log('Playing game:', gameName);
            // Add game launch logic here
        } else {
            document.getElementById('categoryName').textContent = `game ${gameName}`;
            showLoginPopup();
        }
    };

    // Handle view all games
    window.handleViewAllGames = function() {
        const isAuthenticated = document.body.getAttribute('data-authenticated') === 'true';
        if (isAuthenticated) {
            console.log('Viewing all games');
            // Redirect to games page or show all games
        } else {
            document.getElementById('categoryName').textContent = 'semua game';
            showLoginPopup();
        }
    };

    function showLoginPopup() {
        const popup = document.getElementById('loginPopup');
        popup.classList.remove('hidden');
        popup.style.display = 'flex';
        popup.style.opacity = '0';
        popup.style.transform = 'scale(0.9)';
        
        setTimeout(() => {
            popup.style.opacity = '1';
            popup.style.transform = 'scale(1)';
        }, 50);
        
        document.body.style.overflow = 'hidden';
    }

    function closeLoginPopup() {
        const popup = document.getElementById('loginPopup');
        popup.style.opacity = '0';
        popup.style.transform = 'scale(0.9)';
        
        setTimeout(() => {
            popup.classList.add('hidden');
            popup.style.display = 'none';
            document.body.style.overflow = '';
        }, 300);
    }

    function openLoginFromPopup() {
        closeLoginPopup();
        setTimeout(() => {
            openLoginModal();
        }, 300);
    }

    function openRegisterFromPopup() {
        closeLoginPopup();
        setTimeout(() => {
            openLoginModal();
            setTimeout(() => {
                const registerTab = document.getElementById('registerTab');
                if (registerTab) {
                    registerTab.click();
                }
            }, 100);
        }, 300);
    }

    document.addEventListener('click', function(event) {
        const popup = document.getElementById('loginPopup');
        if (event.target === popup) {
            closeLoginPopup();
        }
    });

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeLoginPopup();
        }
    });
    
    // Initialize when DOM is ready
    document.addEventListener('DOMContentLoaded', function() {
        initSmoothMarquee();
        
        // Set category icon colors
        document.querySelectorAll('.category-icon').forEach(function(icon) {
            const color = icon.getAttribute('data-color');
            if (color) {
                icon.style.color = color;
            }
        });
    });
</script>
@endpush
