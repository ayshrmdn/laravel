@extends('layouts.admin')

@section('title', 'Edit Game')

@section('content')
<div class="min-h-screen bg-black text-white p-4">
    <div class="max-w-4xl mx-auto">
        
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center space-x-4 mb-4">
                <a href="{{ route('admin.games.index') }}" class="cyber-btn-outline">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-cyan-400 to-purple-400 bg-clip-text text-transparent">
                    <i class="fas fa-edit mr-3"></i>Edit Game: {{ $game->name }}
                </h1>
            </div>
            <p class="text-gray-400">Edit informasi game yang sudah ada</p>
        </div>

        <form action="{{ route('admin.games.update', $game) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                <!-- Left Column - Basic Info -->
                <div class="cyber-card">
                    <h2 class="text-xl font-bold text-cyan-400 mb-6">
                        <i class="fas fa-info-circle mr-2"></i>Informasi Dasar
                    </h2>
                    
                    <div class="space-y-6">
                        <!-- Game Name -->
                        <div>
                            <label class="cyber-label">Nama Game *</label>
                            <input type="text" name="name" value="{{ old('name', $game->name) }}" required 
                                   class="cyber-input @error('name') border-red-500 @enderror" 
                                   placeholder="Masukkan nama game">
                            @error('name')
                                <p class="cyber-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Provider -->
                        <div>
                            <label class="cyber-label">Provider *</label>
                            <select name="provider_id" required class="cyber-select @error('provider_id') border-red-500 @enderror">
                                <option value="">Pilih Provider</option>
                                @foreach($providers as $provider)
                                    <option value="{{ $provider->id }}" {{ old('provider_id', $game->provider_id) == $provider->id ? 'selected' : '' }}>
                                        {{ $provider->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('provider_id')
                                <p class="cyber-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div>
                            <label class="cyber-label">Kategori *</label>
                            <select name="category_id" required class="cyber-select @error('category_id') border-red-500 @enderror">
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $game->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="cyber-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Game URL -->
                        <div>
                            <label class="cyber-label">URL Game</label>
                            <input type="url" name="game_url" value="{{ old('game_url', $game->game_url) }}" 
                                   class="cyber-input @error('game_url') border-red-500 @enderror" 
                                   placeholder="https://example.com/game-play">
                            @error('game_url')
                                <p class="cyber-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Right Column - Settings & Media -->
                <div class="cyber-card">
                    <h2 class="text-xl font-bold text-purple-400 mb-6">
                        <i class="fas fa-cog mr-2"></i>Pengaturan & Media
                    </h2>
                    
                    <div class="space-y-6">
                        <!-- Current Image -->
                        @if($game->image_url)
                            <div>
                                <label class="cyber-label">Gambar Saat Ini</label>
                                <div class="bg-gray-800 rounded-lg p-4">
                                    <img src="{{ $game->image_url }}" alt="Current Image" 
                                         class="w-32 h-40 object-cover rounded border border-cyan-500/30">
                                </div>
                            </div>
                        @endif

                        <!-- Image URL -->
                        <div>
                            <label class="cyber-label">URL Gambar Game *</label>
                            <input type="url" name="image_url" value="{{ old('image_url', $game->image_url) }}" required 
                                   class="cyber-input @error('image_url') border-red-500 @enderror" 
                                   placeholder="https://example.com/game-image.jpg"
                                   onchange="previewImage('image_url', 'imagePreview')">
                            @error('image_url')
                                <p class="cyber-error">{{ $message }}</p>
                            @enderror
                            <div id="imagePreview" class="mt-2 hidden">
                                <img src="" alt="Preview" class="w-32 h-40 object-cover rounded border border-cyan-500/30">
                            </div>
                        </div>

                        <!-- Sort Order -->
                        <div>
                            <label class="cyber-label">Urutan Tampilan</label>
                            <input type="number" name="sort_order" value="{{ old('sort_order', $game->sort_order) }}" 
                                   class="cyber-input @error('sort_order') border-red-500 @enderror" 
                                   placeholder="0">
                            @error('sort_order')
                                <p class="cyber-error">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-gray-500 mt-1">Angka lebih kecil akan ditampilkan lebih dulu</p>
                        </div>

                        <!-- Status Flags -->
                        <div class="space-y-4">
                            <div>
                                <label class="cyber-label">Status Game</label>
                                <div class="space-y-3">
                                    <div class="flex items-center space-x-3">
                                        <input type="hidden" name="is_active" value="0">
                                        <input type="checkbox" name="is_active" value="1" 
                                               {{ old('is_active', $game->is_active) ? 'checked' : '' }}
                                               class="cyber-checkbox">
                                        <span class="text-gray-300">Game aktif</span>
                                    </div>
                                    
                                    <div class="flex items-center space-x-3">
                                        <input type="hidden" name="is_popular" value="0">
                                        <input type="checkbox" name="is_popular" value="1" 
                                               {{ old('is_popular', $game->is_popular) ? 'checked' : '' }}
                                               class="cyber-checkbox">
                                        <span class="text-gray-300">Game populer</span>
                                    </div>
                                    
                                    <div class="flex items-center space-x-3">
                                        <input type="hidden" name="is_new" value="0">
                                        <input type="checkbox" name="is_new" value="1" 
                                               {{ old('is_new', $game->is_new) ? 'checked' : '' }}
                                               class="cyber-checkbox">
                                        <span class="text-gray-300">Game baru</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="cyber-card">
                <div class="flex justify-between items-center">
                    <div class="text-sm text-gray-400">
                        <i class="fas fa-info-circle mr-1"></i>
                        Fields dengan tanda (*) wajib diisi
                    </div>
                    <div class="flex space-x-4">
                        <a href="{{ route('admin.games.index') }}" class="cyber-btn-outline">
                            <i class="fas fa-times mr-2"></i>Batal
                        </a>
                        <button type="submit" class="cyber-btn-primary">
                            <i class="fas fa-save mr-2"></i>Update Game
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(inputId, previewId) {
    const input = document.getElementById(inputId) || document.querySelector(`input[name="${inputId}"]`);
    const preview = document.getElementById(previewId);
    
    if (input && input.value && preview) {
        const img = preview.querySelector('img');
        img.src = input.value;
        preview.classList.remove('hidden');
        
        // Handle error if image fails to load
        img.onerror = function() {
            preview.classList.add('hidden');
        };
    }
}
</script>
@endsection
