<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Provider;
use App\Models\Category;
use App\Models\Game;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Skip providers and categories creation since they exist
        // Only create more games if count is less than 10
        $gamesCount = Game::count();
        if ($gamesCount >= 20) {
            echo "Games already seeded. Current count: $gamesCount\n";
            return;
        }

        // Create more sample games
        $games = [
            ['name' => 'Sweet Bonanza', 'slug' => 'sweet-bonanza', 'image_url' => 'https://images.unsplash.com/photo-1582731454938-0ffb5cb8ec91?w=300&h=400&fit=crop', 'provider_id' => 1, 'category_id' => 1, 'is_popular' => true, 'is_new' => false, 'is_active' => true, 'sort_order' => 1, 'game_url' => 'https://example.com/games/sweet-bonanza'],
            ['name' => 'Gates of Olympus', 'slug' => 'gates-of-olympus', 'image_url' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=300&h=400&fit=crop', 'provider_id' => 1, 'category_id' => 1, 'is_popular' => true, 'is_new' => true, 'is_active' => true, 'sort_order' => 2, 'game_url' => 'https://example.com/games/gates-of-olympus'],
            ['name' => 'Singapore Togel', 'slug' => 'singapore-togel', 'image_url' => 'https://images.unsplash.com/photo-1593444285043-66bb58eadd63?w=300&h=400&fit=crop', 'provider_id' => 8, 'category_id' => 2, 'is_popular' => true, 'is_new' => false, 'is_active' => true, 'sort_order' => 3, 'game_url' => 'https://example.com/games/singapore-togel'],
            ['name' => 'Live Blackjack', 'slug' => 'live-blackjack', 'image_url' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=300&h=400&fit=crop', 'provider_id' => 29, 'category_id' => 3, 'is_popular' => true, 'is_new' => false, 'is_active' => true, 'sort_order' => 4, 'game_url' => 'https://example.com/games/live-blackjack'],
            ['name' => 'Football Betting', 'slug' => 'football-betting', 'image_url' => 'https://images.unsplash.com/photo-1579952363873-27d3bfad9c0d?w=300&h=400&fit=crop', 'provider_id' => 24, 'category_id' => 4, 'is_popular' => true, 'is_new' => false, 'is_active' => true, 'sort_order' => 5, 'game_url' => 'https://example.com/games/football-betting'],
            ['name' => 'Mines', 'slug' => 'mines', 'image_url' => 'https://images.unsplash.com/photo-1551103782-8ab07afd45c1?w=300&h=400&fit=crop', 'provider_id' => 1, 'category_id' => 5, 'is_popular' => false, 'is_new' => true, 'is_active' => true, 'sort_order' => 6, 'game_url' => 'https://example.com/games/mines'],
            ['name' => 'Aviator', 'slug' => 'aviator', 'image_url' => 'https://images.unsplash.com/photo-1567593810070-7a3d471af022?w=300&h=400&fit=crop', 'provider_id' => 8, 'category_id' => 6, 'is_popular' => true, 'is_new' => true, 'is_active' => true, 'sort_order' => 7, 'game_url' => 'https://example.com/games/aviator'],
            ['name' => 'Texas Holdem', 'slug' => 'texas-holdem', 'image_url' => 'https://images.unsplash.com/photo-1541086030358-c4a79c413f56?w=300&h=400&fit=crop', 'provider_id' => 13, 'category_id' => 7, 'is_popular' => false, 'is_new' => false, 'is_active' => true, 'sort_order' => 8, 'game_url' => 'https://example.com/games/texas-holdem'],
            ['name' => 'Dota 2 Betting', 'slug' => 'dota2-betting', 'image_url' => 'https://images.unsplash.com/photo-1542751371-adc38448a05e?w=300&h=400&fit=crop', 'provider_id' => 26, 'category_id' => 8, 'is_popular' => false, 'is_new' => true, 'is_active' => true, 'sort_order' => 9, 'game_url' => 'https://example.com/games/dota2-betting'],
            ['name' => 'SV388 Cockfight', 'slug' => 'sv388-cockfight', 'image_url' => 'https://images.unsplash.com/photo-1548550023-2bdb3c5beed7?w=300&h=400&fit=crop', 'provider_id' => 44, 'category_id' => 9, 'is_popular' => true, 'is_new' => false, 'is_active' => true, 'sort_order' => 10, 'game_url' => 'https://example.com/games/sv388-cockfight'],
            
            // More slot games
            ['name' => 'Starlight Princess', 'slug' => 'starlight-princess', 'image_url' => 'https://images.unsplash.com/photo-1534796636912-3b95b3ab5986?w=300&h=400&fit=crop', 'provider_id' => 1, 'category_id' => 1, 'is_popular' => true, 'is_new' => false, 'is_active' => true, 'sort_order' => 11, 'game_url' => 'https://example.com/games/starlight-princess'],
            ['name' => 'Wild West Gold', 'slug' => 'wild-west-gold', 'image_url' => 'https://images.unsplash.com/photo-1606069555252-cf2194230c0c?w=300&h=400&fit=crop', 'provider_id' => 1, 'category_id' => 1, 'is_popular' => true, 'is_new' => true, 'is_active' => true, 'sort_order' => 12, 'game_url' => 'https://example.com/games/wild-west-gold'],
            ['name' => 'Mahjong Ways', 'slug' => 'mahjong-ways', 'image_url' => 'https://images.unsplash.com/photo-1626932334095-e7992ed0cf9e?w=300&h=400&fit=crop', 'provider_id' => 2, 'category_id' => 1, 'is_popular' => true, 'is_new' => false, 'is_active' => true, 'sort_order' => 13, 'game_url' => 'https://example.com/games/mahjong-ways'],
            ['name' => 'Fortune Ox', 'slug' => 'fortune-ox', 'image_url' => 'https://images.unsplash.com/photo-1548092372-0d1bd40894a3?w=300&h=400&fit=crop', 'provider_id' => 2, 'category_id' => 1, 'is_popular' => false, 'is_new' => true, 'is_active' => true, 'sort_order' => 14, 'game_url' => 'https://example.com/games/fortune-ox'],
            ['name' => 'Book of Dead', 'slug' => 'book-of-dead', 'image_url' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=300&h=400&fit=crop', 'provider_id' => 3, 'category_id' => 1, 'is_popular' => true, 'is_new' => false, 'is_active' => true, 'sort_order' => 15, 'game_url' => 'https://example.com/games/book-of-dead'],
            
            // More casino games
            ['name' => 'Live Roulette', 'slug' => 'live-roulette', 'image_url' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=300&h=400&fit=crop', 'provider_id' => 29, 'category_id' => 3, 'is_popular' => true, 'is_new' => false, 'is_active' => true, 'sort_order' => 16, 'game_url' => 'https://example.com/games/live-roulette'],
            ['name' => 'Live Baccarat', 'slug' => 'live-baccarat', 'image_url' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?w=300&h=400&fit=crop', 'provider_id' => 29, 'category_id' => 3, 'is_popular' => true, 'is_new' => true, 'is_active' => true, 'sort_order' => 17, 'game_url' => 'https://example.com/games/live-baccarat'],
            
            // More togel games
            ['name' => 'Hongkong Togel', 'slug' => 'hongkong-togel', 'image_url' => 'https://images.unsplash.com/photo-1593444285043-66bb58eadd63?w=300&h=400&fit=crop', 'provider_id' => 17, 'category_id' => 2, 'is_popular' => false, 'is_new' => false, 'is_active' => true, 'sort_order' => 18, 'game_url' => 'https://example.com/games/hongkong-togel'],
            ['name' => 'Sydney Togel', 'slug' => 'sydney-togel', 'image_url' => 'https://images.unsplash.com/photo-1593444285043-66bb58eadd63?w=300&h=400&fit=crop', 'provider_id' => 17, 'category_id' => 2, 'is_popular' => false, 'is_new' => true, 'is_active' => true, 'sort_order' => 19, 'game_url' => 'https://example.com/games/sydney-togel'],
            
            // Sports betting
            ['name' => 'Basketball Betting', 'slug' => 'basketball-betting', 'image_url' => 'https://images.unsplash.com/photo-1579952363873-27d3bfad9c0d?w=300&h=400&fit=crop', 'provider_id' => 24, 'category_id' => 4, 'is_popular' => false, 'is_new' => false, 'is_active' => true, 'sort_order' => 20, 'game_url' => 'https://example.com/games/basketball-betting']
        ];

        foreach ($games as $game) {
            // Check if game with same slug already exists
            if (!Game::where('slug', $game['slug'])->exists()) {
                Game::create($game);
            }
        }

        echo "Games seeded successfully! Total games: " . Game::count() . "\n";
    }
}
