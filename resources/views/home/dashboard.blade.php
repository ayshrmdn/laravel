@extends('layouts.main')

@section('title', 'Beranda')

@section('content')
<div class="relative">
    <!-- Sticky Announcement Ticker (reuse from home) -->
    <div class="text-white shadow-lg overflow-hidden sticky-announcement" style="background: linear-gradient(90deg, #00FFFF 0%, #FF0080 25%, #8B00FF 50%, #FF0040 75%, #00FFFF 100%);">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-1 left-8 w-1.5 h-1.5 bg-white rounded-full animate-pulse"></div>
            <div class="absolute top-2 right-16 w-1 h-1 bg-white rounded-full animate-pulse" style="animation-delay: 0.5s;"></div>
            <div class="absolute bottom-1 left-1/3 w-1.5 h-1.5 bg-white rounded-full animate-pulse" style="animation-delay: 1s;"></div>
        </div>
        <div class="relative py-0.5">
            <div class="flex items-center min-h-6">
                <div class="flex-shrink-0 px-2 flex items-center">
                    <div class="bg-white bg-opacity-20 rounded-full p-0.5 animate-pulse">
                        <i class="fas fa-bullhorn text-xs text-cyan-100"></i>
                    </div>
                </div>
                <div class="flex-1 overflow-hidden">
                    <div class="flex animate-smooth-marquee whitespace-nowrap" id="marqueeDashboard">
                        <div class="flex items-center">
                            <span class="mx-4 sm:mx-8 text-xs sm:text-sm font-bold text-white">
                                Selamat datang di {{ \App\Models\Setting::get('site_name', 'MPOELOT') }} — nikmati pengalaman bermain aman, cepat, dan penuh bonus! Promo harian siap menanti kamu.
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-cyan-400 via-pink-400 to-red-400"></div>
    </div>

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
                    <div class="text-2xl md:text-3xl font-mono text-cyan-300 tracking-wider mt-1">Rp {{ number_format(optional(auth()->user())->balance ?? 0, 0, ',', '.') }}</div>
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

    <!-- Game Populer Section (match home) -->
    <div class="bg-gray-900 relative overflow-hidden mt-10">
        <div class="absolute inset-0 opacity-30">
            <div class="absolute inset-0" style="background-image: linear-gradient(rgba(0, 255, 255, 0.1) 1px, transparent 1px), linear-gradient(90deg, rgba(0, 255, 255, 0.1) 1px, transparent 1px); background-size: 50px 50px; animation: gridMove 20s linear infinite;"></div>
            <div class="absolute top-10 left-10 w-2 h-2 bg-cyan-400 rounded-full animate-pulse"></div>
            <div class="absolute top-20 right-16 w-1 h-1 bg-pink-400 rounded-full animate-pulse" style="animation-delay: 1s;"></div>
            <div class="absolute bottom-16 left-1/3 w-1.5 h-1.5 bg-purple-400 rounded-full animate-pulse" style="animation-delay: 2s;"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 py-8">
            <div class="text-center mb-8 flex items-center justify-center">
                <div class="cyber-title-container relative inline-block">
                    <h2 class="text-3xl md:text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 via-purple-400 to-pink-400 mb-2 cyber-glow-text">GAME POPULER</h2>
                </div>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
                @foreach($popularGames as $game)
                <div class="cyber-game-card group cursor-pointer" data-game-name="{{ $game['name'] }}">
                    <div class="cyber-game-container">
                        <div class="cyber-image-wrapper">
                            <img src="{{ $game['image'] }}" alt="{{ $game['name'] }}" class="cyber-game-image">
                            <div class="cyber-image-overlay">
                                <div class="cyber-play-btn"><i class="fas fa-play"></i></div>
                            </div>
                            <div class="cyber-hot-badge"><span class="text-xs font-bold">HOT</span></div>
                        </div>
                        <div class="cyber-game-info">
                            <h3 class="cyber-game-title">{{ $game['name'] }}</h3>
                            <p class="cyber-game-provider">{{ $game['provider'] }}</p>
                        </div>
                        <div class="cyber-border-effect"></div>
                        <div class="cyber-glow-effect"></div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-8">
                <button class="cyber-view-all-btn"><span class="cyber-btn-text">LIHAT SEMUA GAME</span><div class="cyber-btn-glow"></div><div class="cyber-btn-border"></div></button>
            </div>
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

@push('scripts')
@verbatim
<style>
@keyframes smoothMarquee { 0% { transform: translateX(100%);} 100% { transform: translateX(-100%);} }
.animate-smooth-marquee { animation: smoothMarquee 30s linear infinite; }
@media (max-width: 640px) { .animate-smooth-marquee { animation: smoothMarquee 35s linear infinite; } }
/* Grid background */
@keyframes gridMove { 0% { background-position: 0 0; } 100% { background-position: 50px 50%; } }

/* Reuse cyber game styles from home */
.cyber-game-card { position: relative; }
.cyber-game-container { position: relative; background: linear-gradient(135deg, rgba(255,255,255,.04), rgba(255,255,255,.02)); border: 1px solid rgba(0,255,255,.2); border-radius: 14px; overflow: hidden; transition: transform .25s ease, box-shadow .25s ease; }
.cyber-game-container:hover { transform: translateY(-4px); box-shadow: 0 10px 25px rgba(0,0,0,.35); }
.cyber-image-wrapper { position: relative; aspect-ratio: 1/1; background: #000; }
.cyber-game-image { width: 100%; height: 100%; object-fit: cover; }
.cyber-image-overlay { position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, rgba(0,255,255,.15), rgba(255,0,128,.15)); opacity: 0; transition: opacity .25s ease; }
.cyber-game-container:hover .cyber-image-overlay { opacity: 1; }
.cyber-play-btn { width: 48px; height: 48px; border-radius: 9999px; background: linear-gradient(135deg, #22D3EE, #C084FC); display:flex; align-items:center; justify-content:center; color:#111; box-shadow: 0 0 20px rgba(34,211,238,.5); }
.cyber-hot-badge { position: absolute; top: 8px; left: 8px; background: linear-gradient(135deg, #FB7185, #F59E0B); color: #111; border-radius: 9999px; padding: 2px 8px; font-weight: 700; box-shadow: 0 0 10px rgba(251,113,133,.45); }
.cyber-game-info { padding: 10px 12px; }
.cyber-game-title { color: #fff; font-weight: 800; letter-spacing: .02em; }
.cyber-game-provider { font-size: .75rem; color: #94A3B8; }
.cyber-border-effect { position: absolute; inset: 0; border-radius: 14px; pointer-events:none; box-shadow: inset 0 0 0 1px rgba(0,255,255,.15); }
.cyber-glow-effect { position: absolute; inset: 0; pointer-events:none; background: radial-gradient(60% 40% at 50% 0%, rgba(34,211,238,.12), transparent 60%); }

/* View All */
.cyber-view-all-btn { position: relative; padding: .75rem 1.25rem; border: 1px solid rgba(34,211,238,.3); border-radius: 9999px; color: #fff; background: linear-gradient(135deg, rgba(34,211,238,.15), rgba(192,132,252,.15)); overflow: hidden; }
.cyber-btn-text { position: relative; z-index:1; }
.cyber-btn-glow { position:absolute; inset:0; background: linear-gradient(90deg, transparent, rgba(255,255,255,.18), transparent); transform: translateX(-100%); animation: scanMove 2.8s linear infinite; }
.cyber-btn-border { position:absolute; inset:-1px; border-radius:9999px; box-shadow: inset 0 0 0 1px rgba(34,211,238,.35); pointer-events:none; }
@keyframes scanMove { 0% { transform: translateX(-100%);} 100% { transform: translateX(100%);} }
</style>
@endverbatim
@endpush