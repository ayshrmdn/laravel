<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Game;
use App\Models\Setting;
use App\Models\PaymentMethod;

class HomeController extends Controller
{
    public function index()
    {
        // Get popular games from database
        $popularGames = Game::with(['provider', 'category'])
            ->where('is_active', true)
            ->where('is_popular', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->limit(8)
            ->get();

        // If no popular games found, get any active games
        if ($popularGames->isEmpty()) {
            $popularGames = Game::with(['provider', 'category'])
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->orderBy('name')
                ->limit(8)
                ->get();
        }

        // Transform to array format
        $popularGames = $popularGames->map(function($game) {
            return [
                'id' => $game->id,
                'name' => $game->name,
                'image' => $game->image_url,
                'provider' => $game->provider->name
            ];
        });

        $slots = [
            [
                'id' => 1,
                'name' => 'Mahjong Ways',
                'image' => 'https://via.placeholder.com/200x150/8BC34A/white?text=Mahjong+Ways',
                'provider' => 'PG Soft'
            ],
            [
                'id' => 2,
                'name' => 'MPOPLAY Money Train',
                'image' => 'https://via.placeholder.com/200x150/2196F3/white?text=Money+Train',
                'provider' => 'Relax Gaming'
            ]
        ];

        // Get banners from database, fallback to default if none exist
        $banners = Banner::active()->ordered()->get();
        
        if ($banners->isEmpty()) {
            $banners = collect([
                (object)[
                    'image' => null,
                    'order' => 1,
                    'is_active' => true
                ],
                (object)[
                    'image' => null,
                    'order' => 2,
                    'is_active' => true
                ]
            ]);
        }

        // Get active categories for category slider
        $categories = Category::where('is_active', true)
                             ->orderBy('sort_order')
                             ->orderBy('name')
                             ->get();

        // Get GIF banner from settings
                $gifBanner = Setting::get('gif_banner');

                $paymentMethods = PaymentMethod::where('is_active', true)->orderBy('sort_order')->get();
 
        $siteLongDescription = Setting::get('site_long_description', "MPOELOT adalah situs slot online terpercaya dengan koleksi game resmi RTP tinggi, transaksi cepat, dan layanan 24/7. Nikmati pengalaman bermain yang aman, adil, serta promosi menarik setiap hari. Dukung deposit via bank & e-wallet populer. Main dengan bijak dan raih jackpot!");
 
        return view('home.index', compact('popularGames', 'slots', 'banners', 'categories', 'gifBanner', 'paymentMethods', 'siteLongDescription'));
  }
 
    public function dashboard(Request $request)
    {
        $user = $request->user();

        // Reuse data but remove banners and categories for logged-in dashboard
        $popularGames = Game::with(['provider', 'category'])
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->limit(8)
            ->get()
            ->map(fn($g) => [
                'id' => $g->id,
                'name' => $g->name,
                'image' => $g->image_url,
                'provider' => optional($g->provider)->name,
            ]);

        $paymentMethods = PaymentMethod::where('is_active', true)->orderBy('sort_order')->get();
        $gifBanner = Setting::get('gif_banner');
        $siteLongDescription = Setting::get('site_long_description');

        // Example balance (replace with real wallet integration)
        $balance = 0;

        return view('home.dashboard', compact('user', 'popularGames', 'paymentMethods', 'gifBanner', 'siteLongDescription', 'balance'));
    }
}
