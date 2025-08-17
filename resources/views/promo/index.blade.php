@extends('layouts.main')

@section('title', 'Promo Terbaru - ' . \App\Models\Setting::get('site_name', 'MPOELOT'))

@section('content')
<!-- Sticky Announcement (match home style) -->
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
                            Selamat Datang Di BOSCUAN69. Sebagai Penyedia Game Online Resmi Deposit Pulsa Tanpa Potongan Dan Depo Qris & Emoney Terpercaya...
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
            <div class="inline-block relative promo-title-wrap">
                <h1 class="promo-heading text-3xl md:text-4xl" data-text="PROMO">PROMO</h1>
                <div class="promo-scanline"></div>
            </div>
            <div class="cyber-stats-underline"></div>
        </div>

        <!-- Promo Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
            @forelse($promos as $promo)
            @php
                $desc = $promo->description ?? '';
                $autoTitle = $desc ? Str::upper(Str::limit($desc, 28, '')) : 'PROMO SPESIAL';
                $title = $promo->title ?: $autoTitle;
            @endphp
            <div class="group relative bg-gradient-to-br from-gray-900/90 to-gray-800/80 border border-cyan-500/30 rounded-xl overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:shadow-xl promo-card">
                <div class="relative">
                    <img src="{{ asset('storage/' . $promo->image_path) }}" alt="Promo" class="promo-image">
                </div>
                <div class="p-4">
                    <h3 class="promo-title">{{ $title }}</h3>
                    <div class="promo-desc-box">
                        <p class="promo-desc clamped" data-full-text="{{ $promo->description }}">{{ $promo->description }}</p>
                    </div>
                    <button class="mt-2 text-cyan-400 hover:text-pink-400 text-xs font-semibold read-more-btn" data-state="collapsed" style="display:none;">
                        Selengkapnya
                    </button>
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
    @keyframes gridMove { 0% { background-position: 0 0; } 100% { background-position: 50px 50%; } }

    /* Full-width image on mobile (no crop) */
    .promo-image { width: 100%; height: auto; object-fit: contain; max-height: 70vh; background: rgba(0,0,0,0.2); }
    @media (min-width: 640px) { /* sm and up */
        .promo-image { height: 14rem; object-fit: cover; }
    }

    /* Cyberpunk animated heading */
    .promo-title-wrap { position: relative; padding: 6px 10px; }
    .promo-heading {
        position: relative; font-weight: 900; letter-spacing: 0.12em; text-transform: uppercase;
        background: linear-gradient(90deg, #22D3EE, #C084FC, #FB7185, #22D3EE);
        -webkit-background-clip: text; background-clip: text; color: transparent;
        animation: promoGradient 6s linear infinite;
        text-shadow: 0 0 20px rgba(34,211,238,.45), 0 0 35px rgba(139,0,255,.35);
        filter: drop-shadow(0 0 10px rgba(0,255,255,.25));
    }
    .promo-heading::before,
    .promo-heading::after { content: attr(data-text); position: absolute; inset: 0; pointer-events: none; mix-blend-mode: screen; opacity: .6; text-shadow: none; color: #00FFFF; }
    .promo-heading::before { transform: translateX(-1px); color: #00FFFF; animation: glitchShift 2.8s steps(8,end) infinite; }
    .promo-heading::after  { transform: translateX(1px);  color: #FF0080; animation: glitchShift 2.8s steps(6,end) infinite reverse; }

    @keyframes promoGradient { 0% { background-position: 200% 0; } 100% { background-position: 0 0; } }
    @keyframes glitchShift { 0% { clip-path: inset(0 0 82% 0);} 20% { clip-path: inset(10% 0 68% 0);} 40% { clip-path: inset(40% 0 40% 0);} 60% { clip-path: inset(65% 0 15% 0);} 80% { clip-path: inset(90% 0 0 0);} 100% { clip-path: inset(0 0 82% 0);} }

    .promo-scanline { position: absolute; inset: 0; pointer-events: none; background: linear-gradient(90deg, transparent, rgba(255,255,255,.18), transparent); transform: translateX(-100%); animation: scanMove 2.8s linear infinite; }
    @keyframes scanMove { 0% { transform: translateX(-100%);} 100% { transform: translateX(100%);} }

    /* Card title under image */
    .promo-title { font-weight: 800; letter-spacing: 0.06em; font-size: 1rem; background: linear-gradient(90deg, #22D3EE, #C084FC, #FB7185, #22D3EE); -webkit-background-clip: text; background-clip: text; color: transparent; animation: promoShimmer 4s linear infinite; text-shadow: 0 0 18px rgba(34,211,238,.35); margin-bottom: .5rem; }
    @keyframes promoShimmer { 0% { background-position: 200% 0; } 100% { background-position: 0 0; } }

    /* Glassmorphism desc box */
    .promo-desc-box { background: linear-gradient(135deg, rgba(0,255,255,.06), rgba(139,0,255,.06)); border: 1px solid rgba(0,255,255,.25); border-radius: 12px; padding: 10px 12px; backdrop-filter: blur(6px); }
    .promo-desc { color: #D1D5DB; font-size: .9rem; line-height: 1.5; text-shadow: 0 0 6px rgba(34,211,238,.15); white-space: pre-line; display: -webkit-box; -webkit-box-orient: vertical; overflow: hidden; }
    .promo-desc.clamped { -webkit-line-clamp: 2; } .promo-desc.expanded { display: block; }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const marquee = document.getElementById('promoMarquee');
        if (marquee) {
            const content = marquee.innerHTML; marquee.innerHTML = content + content;
            marquee.addEventListener('animationiteration', function() { this.style.animationPlayState = 'paused'; setTimeout(() => { this.style.animationPlayState = 'running'; }, 100); });
        }

        document.querySelectorAll('.promo-desc').forEach(function(p){
            const btn = p.closest('.p-4').querySelector('.read-more-btn'); if (!btn) return;
            requestAnimationFrame(() => { const isOverflowing = p.scrollHeight > p.offsetHeight + 2; if (isOverflowing) { btn.style.display = 'inline-block'; } });
        });

        document.querySelectorAll('.read-more-btn').forEach(function(btn){
            btn.addEventListener('click', function(){
                const paragraph = this.previousElementSibling.querySelector('.promo-desc');
                const isCollapsed = this.getAttribute('data-state') === 'collapsed';
                if (isCollapsed) { paragraph.classList.remove('clamped'); paragraph.classList.add('expanded'); paragraph.textContent = paragraph.getAttribute('data-full-text'); this.textContent = 'Sembunyikan'; this.setAttribute('data-state', 'expanded'); }
                else { paragraph.classList.remove('expanded'); paragraph.classList.add('clamped'); const full = paragraph.getAttribute('data-full-text') || ''; paragraph.textContent = full; this.textContent = 'Selengkapnya'; this.setAttribute('data-state', 'collapsed'); }
            });
        });
    });
</script>
@endpush