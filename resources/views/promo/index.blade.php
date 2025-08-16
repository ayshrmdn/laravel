@extends('layouts.main')

@section('title', 'Promo Terbaru - ' . \App\Models\Setting::get('site_name', 'MPOELOT'))

@section('content')
<!-- Sticky Announcement (reuse style from home) -->
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
                <div id="promoMarquee" class="flex animate-smooth-marquee whitespace-nowrap">
                    <div class="flex items-center">
                        <span class="mx-4 sm:mx-8 text-xs sm:text-sm font-bold text-white">
                            Temukan promo terbaik dan terbaru kami. Nikmati bonus menarik setiap hari!
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-cyan-400 via-pink-400 to-red-400"></div>
</div>

<div class="bg-gray-900 relative overflow-hidden">
    <div class="absolute inset-0 opacity-30">
        <div class="absolute inset-0" style="background-image: linear-gradient(rgba(0, 255, 255, 0.08) 1px, transparent 1px), linear-gradient(90deg, rgba(0, 255, 255, 0.08) 1px, transparent 1px); background-size: 50px 50px; animation: gridMove 20s linear infinite;"></div>
    </div>

    <div class="relative z-10 max-w-6xl mx-auto px-4 py-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 via-purple-400 to-pink-400 mb-2">PROMO</h1>
            <div class="cyber-stats-underline"></div>
        </div>

        <!-- Promo Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
            @forelse($promos as $promo)
            <div class="group relative bg-gradient-to-br from-gray-900/90 to-gray-800/80 border border-cyan-500/30 rounded-xl overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                <div class="relative">
                    <img src="{{ asset('storage/' . $promo->image_path) }}" alt="Promo" class="w-full h-48 md:h-56 object-cover">
                    @auth('admin')
                    <form action="{{ route('admin.promos.toggle-visibility', $promo) }}" method="POST" class="absolute top-3 right-3">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="bg-black/40 text-white text-xs px-3 py-1 rounded-full border border-cyan-400/40 hover:bg-black/60 transition">
                            <i class="fas fa-eye mr-1"></i>{{ $promo->is_visible ? 'Hide' : 'Show' }}
                        </button>
                    </form>
                    @else
                    <button onclick="alert('Hubungi admin untuk menyembunyikan/menampilkan promo ini')" class="absolute top-3 right-3 bg-black/40 text-white text-xs px-3 py-1 rounded-full border border-cyan-400/40 hover:bg-black/60 transition">
                        <i class="fas fa-eye mr-1"></i>Hide/Show
                    </button>
                    @endauth
                </div>
                <div class="p-4">
                    <p class="text-sm text-gray-300 leading-relaxed">{{ $promo->description }}</p>
                </div>
            </div>
            @empty
            <div class="col-span-full">
                <div class="text-center text-gray-400">Belum ada promo tersedia.</div>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

@push('scripts')
<style>
    @keyframes smoothMarquee { 0% { transform: translateX(100%);} 100% { transform: translateX(-100%);} }
    .animate-smooth-marquee { animation: smoothMarquee 30s linear infinite; }
    @media (max-width: 640px) { .animate-smooth-marquee { animation: smoothMarquee 35s linear infinite; } }
    @keyframes gridMove { 0% { background-position: 0 0; } 100% { background-position: 50px 50px; } }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const marquee = document.getElementById('promoMarquee');
        if (marquee) {
            const content = marquee.innerHTML;
            marquee.innerHTML = content + content;
            marquee.addEventListener('animationiteration', function() {
                this.style.animationPlayState = 'paused';
                setTimeout(() => { this.style.animationPlayState = 'running'; }, 100);
            });
        }
    });
</script>
@endpush