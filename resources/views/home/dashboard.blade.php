@extends('layouts.main')

@section('title', 'Beranda')

@section('content')
<div class="relative">
    <!-- Welcome / Balance Panel -->
    <div class="max-w-6xl mx-auto px-4 mt-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Welcome Card -->
            <div class="lg:col-span-2 bg-gradient-to-br from-gray-900/80 to-gray-800/60 border border-cyan-400/30 rounded-2xl p-6 relative overflow-hidden">
                <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: radial-gradient(circle at 25% 25%, rgba(0, 255, 255, 0.15) 2px, transparent 2px), radial-gradient(circle at 75% 75%, rgba(255, 0, 128, 0.15) 2px, transparent 2px); background-size: 60px 60px;"></div>
                <div class="relative z-10">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-full bg-gradient-to-r from-cyan-500 to-purple-600 flex items-center justify-center shadow-lg">
                            <i class="fas fa-user-astronaut text-white text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl md:text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 via-purple-400 to-pink-400">{{ now()->diffInHours($user->created_at) < 48 ? 'Selamat Datang, ' . ($user->full_name ?? $user->username) : 'Welcome Back, ' . ($user->full_name ?? $user->username) }}</h2>
                            
                        </div>
                    </div>
                    <div class="mt-4 text-gray-300 text-sm">Senang melihatmu di sini. Semoga harimu menyenangkan dan jackpot besar menantimu!</div>
                </div>
            </div>
            <!-- Balance & Actions -->
            <div class="bg-gradient-to-br from-gray-900/80 to-gray-800/60 border border-cyan-400/30 rounded-2xl p-6 flex flex-col justify-between">
                <div>
                    <div class="text-gray-300 text-sm">Saldo Kamu</div>
                    <div class="text-2xl md:text-3xl font-mono text-cyan-300 tracking-wider mt-1">Rp {{ number_format($balance, 0, ',', '.') }}</div>
                </div>
                <div class="grid grid-cols-2 gap-3 mt-4">
                    <a href="#" class="px-4 py-3 rounded-xl text-center font-semibold bg-gradient-to-r from-green-500 to-emerald-600 text-white hover:from-green-600 hover:to-emerald-700 transition">
                        <i class="fas fa-arrow-up mr-2"></i>Deposit
                    </a>
                    <a href="#" class="px-4 py-3 rounded-xl text-center font-semibold bg-gradient-to-r from-orange-500 to-red-600 text-white hover:from-orange-600 hover:to-red-700 transition">
                        <i class="fas fa-arrow-down mr-2"></i>Withdraw
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Popular Games (reuse) -->
    <div class="max-w-6xl mx-auto px-4 mt-10">
        <h3 class="text-xl font-semibold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 via-purple-400 to-pink-400 mb-4">Game Populer</h3>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
            @forelse($popularGames as $game)
                <div class="game-card border border-cyan-500/20 rounded-xl overflow-hidden bg-gradient-to-br from-gray-900/70 to-gray-800/50">
                    <div class="aspect-[16/10] bg-black/30">
                        <img src="{{ $game['image'] }}" alt="{{ $game['name'] }}" class="w-full h-full object-cover">
                    </div>
                    <div class="p-3">
                        <div class="text-white text-sm font-semibold truncate">{{ $game['name'] }}</div>
                        <div class="text-xs text-gray-400 mt-1">{{ $game['provider'] }}</div>
                    </div>
                </div>
            @empty
                <div class="col-span-4 text-center text-gray-400">Belum ada game.</div>
            @endforelse
        </div>
    </div>

    <!-- Payment Methods -->
    @if(isset($paymentMethods) && $paymentMethods->count())
    <div class="py-8">
        <div class="max-w-6xl mx-auto px-4">
            <div class="bg-gradient-to-br from-gray-900/80 to-gray-800/60 border border-cyan-400/20 rounded-2xl p-6">
                <div class="text-center mb-4">
                    <h3 class="text-lg font-semibold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 via-purple-400 to-pink-400">METODE PEMBAYARAN</h3>
                </div>
                <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-4 items-center justify-items-center">
                    @foreach($paymentMethods as $method)
                        <div class="relative text-center">
                            <img src="{{ asset('storage/' . $method->icon_path) }}" alt="{{ $method->name }}" class="h-10 sm:h-12 md:h-14 object-contain {{ $method->is_online ? 'opacity-100' : 'opacity-60 grayscale' }}" />
                            <span class="absolute -top-1 -right-1 w-3 h-3 rounded-full {{ $method->is_online ? 'bg-green-400' : 'bg-red-500' }}"></span>
                            <div class="mt-1 text-[10px] font-mono {{ $method->is_online ? 'text-green-400' : 'text-red-400' }}">{{ $method->is_online ? 'ONLINE' : 'OFFLINE' }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Long Site Description -->
    @if(!empty($siteLongDescription))
    <div class="py-8">
        <div class="max-w-6xl mx-auto px-4">
            <div class="bg-gradient-to-br from-gray-900/80 to-gray-800/60 border border-cyan-400/20 rounded-2xl p-6">
                <div class="text-center mb-4">
                    <h3 class="text-lg font-semibold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 via-purple-400 to-pink-400">SLOT ONLINE TERPERCAYA</h3>
                </div>
                <div class="text-gray-200 leading-relaxed whitespace-pre-line text-sm md:text-base">{{ $siteLongDescription }}</div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection