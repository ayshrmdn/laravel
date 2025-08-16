@extends('layouts.admin')

@section('title', 'Dashboard')
@section('subtitle', 'Selamat datang di panel administrasi')

@section('content')
<div class="space-y-6">
    <!-- Welcome Card -->
    <div class="cyber-card text-center">
        <h2 class="text-2xl font-bold text-white mb-2">Selamat Datang, {{ auth('admin')->user()->name }}!</h2>
        <p class="text-cyan-400">Panel administrasi {{ \App\Models\Setting::get('site_name', 'MPOELOT') }}</p>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Games -->
        <div class="cyber-card text-center">
            <div class="w-16 h-16 bg-gradient-to-r from-cyan-400 to-purple-500 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-gamepad text-2xl text-white"></i>
            </div>
            <h3 class="text-2xl font-bold text-white">{{ \App\Models\Game::count() }}</h3>
            <p class="text-cyan-400">Total Game</p>
        </div>

        <!-- Total Users -->
        <div class="cyber-card text-center">
            <div class="w-16 h-16 bg-gradient-to-r from-pink-400 to-red-500 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-users text-2xl text-white"></i>
            </div>
            <h3 class="text-2xl font-bold text-white">{{ \App\Models\User::count() }}</h3>
            <p class="text-pink-400">Total User</p>
        </div>

        <!-- Active Games -->
        <div class="cyber-card text-center">
            <div class="w-16 h-16 bg-gradient-to-r from-green-400 to-blue-500 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-check-circle text-2xl text-white"></i>
            </div>
            <h3 class="text-2xl font-bold text-white">{{ \App\Models\Game::where('is_active', true)->count() }}</h3>
            <p class="text-green-400">Game Aktif</p>
        </div>

        <!-- Total Providers -->
        <div class="cyber-card text-center">
            <div class="w-16 h-16 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-building text-2xl text-white"></i>
            </div>
            <h3 class="text-2xl font-bold text-white">{{ \App\Models\Provider::count() }}</h3>
            <p class="text-yellow-400">Provider</p>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Games -->
        <div class="cyber-card">
            <h3 class="text-xl font-bold text-white mb-4">Game Terbaru</h3>
            <div class="space-y-3">
                @forelse(\App\Models\Game::with(['provider', 'category'])->latest()->take(5)->get() as $game)
                    <div class="flex items-center space-x-3 p-3 bg-black/20 rounded-lg">
                        <img src="{{ $game->image_url }}" alt="{{ $game->name }}" class="w-12 h-12 object-cover rounded">
                        <div class="flex-1">
                            <div class="text-white font-medium">{{ $game->name }}</div>
                            <div class="text-cyan-400 text-sm">{{ $game->provider->name }} • {{ $game->category->name }}</div>
                        </div>
                        <div class="text-right">
                            <span class="px-2 py-1 text-xs rounded {{ $game->is_active ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                                {{ $game->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <i class="fas fa-gamepad text-4xl text-gray-600 mb-2"></i>
                        <p class="text-gray-400">Belum ada game</p>
                    </div>
                @endforelse
                
                @if(\App\Models\Game::count() > 0)
                    <div class="text-center pt-4">
                        <a href="{{ route('admin.games.index') }}" class="cyber-btn-secondary">
                            <i class="fas fa-eye mr-2"></i>
                            Lihat Semua Game
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="cyber-card">
            <h3 class="text-xl font-bold text-white mb-4">Aksi Cepat</h3>
            <div class="grid grid-cols-1 gap-3">
                <a href="{{ route('admin.games.create') }}" class="flex items-center space-x-3 p-3 bg-cyan-500/10 border border-cyan-500/20 rounded-lg hover:bg-cyan-500/20 transition-colors">
                    <div class="w-10 h-10 bg-cyan-500/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-plus text-cyan-400"></i>
                    </div>
                    <div>
                        <div class="text-white font-medium">Tambah Game Baru</div>
                        <div class="text-cyan-400 text-sm">Tambahkan game slot atau casino</div>
                    </div>
                </a>

                <a href="{{ route('admin.users.index') }}" class="flex items-center space-x-3 p-3 bg-pink-500/10 border border-pink-500/20 rounded-lg hover:bg-pink-500/20 transition-colors">
                    <div class="w-10 h-10 bg-pink-500/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-users text-pink-400"></i>
                    </div>
                    <div>
                        <div class="text-white font-medium">Kelola User</div>
                        <div class="text-pink-400 text-sm">Manajemen pengguna situs</div>
                    </div>
                </a>

                <a href="{{ route('admin.banners.index') }}" class="flex items-center space-x-3 p-3 bg-purple-500/10 border border-purple-500/20 rounded-lg hover:bg-purple-500/20 transition-colors">
                    <div class="w-10 h-10 bg-purple-500/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-images text-purple-400"></i>
                    </div>
                    <div>
                        <div class="text-white font-medium">Kelola Banner</div>
                        <div class="text-purple-400 text-sm">Atur banner promosi</div>
                    </div>
                </a>

                <a href="{{ route('admin.settings.index') }}" class="flex items-center space-x-3 p-3 bg-orange-500/10 border border-orange-500/20 rounded-lg hover:bg-orange-500/20 transition-colors">
                    <div class="w-10 h-10 bg-orange-500/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-cog text-orange-400"></i>
                    </div>
                    <div>
                        <div class="text-white font-medium">Pengaturan Situs</div>
                        <div class="text-orange-400 text-sm">Konfigurasi situs web</div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- System Info -->
    <div class="cyber-card">
        <h3 class="text-xl font-bold text-white mb-4">Informasi Sistem</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <div class="text-gray-400 text-sm">Laravel Version</div>
                <div class="text-white font-medium">{{ app()->version() }}</div>
            </div>
            <div>
                <div class="text-gray-400 text-sm">PHP Version</div>
                <div class="text-white font-medium">{{ PHP_VERSION }}</div>
            </div>
            <div>
                <div class="text-gray-400 text-sm">Last Login</div>
                <div class="text-white font-medium">{{ now()->format('d M Y, H:i') }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
