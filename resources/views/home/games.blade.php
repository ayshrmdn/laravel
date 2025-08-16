@extends('layouts.main')

@section('title', 'Games - MPOELOT')

@section('content')
<!-- Page Header -->
<div class="bg-gradient-to-r from-green-800 to-green-900 py-12">
    <div class="container mx-auto px-4">
        <div class="text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">
                @if($category)
                    {{ ucfirst($category) }} Games
                @else
                    Semua Games
                @endif
            </h1>
            <p class="text-gray-300 text-lg">
                @if($category === 'popular')
                    Game-game paling populer dengan jackpot terbesar
                @elseif($category === 'slots')
                    Koleksi slot terlengkap dari provider terbaik
                @elseif($category === 'sportsbook')
                    Taruhan olahraga dengan odds terbaik
                @elseif($category === 'lottery')
                    Permainan lottery dengan hadiah jutaan rupiah
                @elseif($category === 'poker')
                    Permainan poker profesional
                @elseif($category === 'arcade')
                    Game arcade seru dan menghibur
                @else
                    Temukan game favoritmu di sini
                @endif
            </p>
        </div>
    </div>
</div>

<!-- Breadcrumb -->
<div class="bg-white bg-opacity-10 py-3">
    <div class="container mx-auto px-4">
        <nav class="flex text-sm text-gray-300">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <span class="mx-2">/</span>
            <span class="text-white">
                @if($category)
                    {{ ucfirst($category) }} Games
                @else
                    All Games
                @endif
            </span>
        </nav>
    </div>
</div>

<!-- Game Filters -->
<div class="py-6 px-4">
    <div class="container mx-auto">
        <div class="flex flex-wrap gap-4 justify-center mb-8">
            <a href="{{ route('games') }}" class="filter-btn {{ !$category ? 'active' : '' }}">
                Semua Game
            </a>
            <a href="{{ route('games', 'popular') }}" class="filter-btn {{ $category === 'popular' ? 'active' : '' }}">
                <i class="fas fa-star mr-2"></i>Popular
            </a>
            <a href="{{ route('games', 'slots') }}" class="filter-btn {{ $category === 'slots' ? 'active' : '' }}">
                <i class="fas fa-dice mr-2"></i>Slots
            </a>
            <a href="{{ route('games', 'sportsbook') }}" class="filter-btn {{ $category === 'sportsbook' ? 'active' : '' }}">
                <i class="fas fa-trophy mr-2"></i>Sportsbook
            </a>
            <a href="{{ route('games', 'lottery') }}" class="filter-btn {{ $category === 'lottery' ? 'active' : '' }}">
                <i class="fas fa-coins mr-2"></i>Lottery
            </a>
            <a href="{{ route('games', 'poker') }}" class="filter-btn {{ $category === 'poker' ? 'active' : '' }}">
                <i class="fas fa-heart mr-2"></i>Poker
            </a>
            <a href="{{ route('games', 'arcade') }}" class="filter-btn {{ $category === 'arcade' ? 'active' : '' }}">
                <i class="fas fa-gamepad mr-2"></i>Arcade
            </a>
        </div>
    </div>
</div>

<!-- Games Grid -->
<div class="py-8 px-4">
    <div class="container mx-auto">
        @if(count($games) > 0)
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4 md:gap-6">
                @foreach($games as $game)
                <div class="game-card bg-white bg-opacity-10 backdrop-filter backdrop-blur-lg rounded-xl overflow-hidden hover:bg-opacity-20 transition-all duration-300 transform hover:-translate-y-2">
                    <div class="relative">
                        <img src="{{ $game['image'] }}" alt="{{ $game['name'] }}" class="w-full h-32 md:h-40 object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-60"></div>
                        
                        <!-- Play Button Overlay -->
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity duration-300">
                            <button class="bg-gradient-to-r from-green-500 to-green-600 text-white p-3 rounded-full hover:from-green-600 hover:to-green-700 transition-all duration-200 transform hover:scale-110">
                                <i class="fas fa-play text-xl"></i>
                            </button>
                        </div>
                        
                        <!-- Provider Badge -->
                        <div class="absolute top-2 left-2 bg-black bg-opacity-70 text-white px-2 py-1 rounded text-xs">
                            {{ $game['provider'] }}
                        </div>
                    </div>
                    
                    <div class="p-3">
                        <h3 class="text-white font-semibold text-sm mb-2 truncate">{{ $game['name'] }}</h3>
                        <button class="w-full bg-gradient-to-r from-green-500 to-green-600 text-white py-2 px-3 rounded-lg text-sm font-semibold hover:from-green-600 hover:to-green-700 transition-all duration-200">
                            Main Sekarang
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Load More Button -->
            <div class="text-center mt-12">
                <button class="bg-gradient-to-r from-yellow-400 to-yellow-600 text-white px-8 py-3 rounded-full font-semibold hover:from-yellow-500 hover:to-yellow-700 transition-all duration-200 shadow-lg hover:shadow-xl">
                    Muat Lebih Banyak
                </button>
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="w-24 h-24 bg-white bg-opacity-10 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-gamepad text-4xl text-gray-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-white mb-2">Tidak Ada Game</h3>
                <p class="text-gray-300 mb-6">Maaf, belum ada game di kategori ini saat ini.</p>
                <a href="{{ route('home') }}" class="bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:from-green-600 hover:to-green-700 transition-all duration-200">
                    Kembali ke Home
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Popular Categories CTA -->
@if($category !== 'popular')
<section class="py-12 px-4">
    <div class="container mx-auto">
        <div class="bg-gradient-to-r from-green-600 to-green-700 rounded-2xl p-8 text-center">
            <h2 class="text-2xl md:text-3xl font-bold text-white mb-4">
                Coba Game Populer Lainnya!
            </h2>
            <p class="text-green-100 mb-6">
                Jangan lewatkan game-game populer dengan jackpot terbesar
            </p>
            <a href="{{ route('games', 'popular') }}" class="bg-gradient-to-r from-yellow-400 to-yellow-600 text-white px-8 py-3 rounded-full font-semibold hover:from-yellow-500 hover:to-yellow-700 transition-all duration-200 shadow-lg hover:shadow-xl inline-block">
                Lihat Game Populer
            </a>
        </div>
    </div>
</section>
@endif

@endsection

@push('scripts')
<style>
    .filter-btn {
        @apply bg-white bg-opacity-10 text-white px-4 py-2 rounded-full transition-all duration-200 hover:bg-opacity-20;
    }
    
    .filter-btn.active {
        @apply bg-gradient-to-r from-yellow-400 to-yellow-600 text-white;
    }
    
    .game-card {
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
</style>

<script>
    // Animate cards on load
    document.addEventListener('DOMContentLoaded', function() {
        const gameCards = document.querySelectorAll('.game-card');
        gameCards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });
    });
    
    // Search functionality (if needed)
    function searchGames() {
        // Implement search functionality
    }
    
    // Lazy loading for images
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }
</script>
@endpush
