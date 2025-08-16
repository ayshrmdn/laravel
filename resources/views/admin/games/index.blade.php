@extends('layouts.admin')

@section('title', 'Manajemen Game')
@section('subtitle', 'Kelola game slot dan provider di situs utama')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white mb-2">Manajemen Game</h1>
            <p class="text-cyan-400">Kelola game slot dan provider di situs utama</p>
        </div>
        <a href="{{ route('admin.games.create') }}" class="cyber-btn-primary">
            <i class="fas fa-plus mr-2"></i>
            Tambah Game
        </a>
    </div>

    <!-- Filters -->
    <div class="cyber-card">
        <form method="GET" action="{{ route('admin.games.index') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                <!-- Search -->
                <div>
                    <label class="cyber-label">Cari Game</label>
                    <div class="relative">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-cyan-400"></i>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               class="cyber-input pl-10" placeholder="Nama game, provider...">
                    </div>
                </div>

                <!-- Provider Filter -->
                <div>
                    <label class="cyber-label">Provider</label>
                    <select name="provider" class="cyber-select">
                        <option value="">Semua Provider</option>
                        @foreach($providers as $provider)
                            <option value="{{ $provider->id }}" {{ request('provider') == $provider->id ? 'selected' : '' }}>
                                {{ $provider->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Category Filter -->
                <div>
                    <label class="cyber-label">Kategori</label>
                    <select name="category" class="cyber-select">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>



                <!-- Status Filter -->
                <div>
                    <label class="cyber-label">Status</label>
                    <select name="status" class="cyber-select">
                        <option value="">Semua Status</option>
                        <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>
            </div>

            <div class="flex space-x-2">
                <button type="submit" class="cyber-btn-secondary">
                    <i class="fas fa-filter mr-2"></i>
                    Filter
                </button>
                <a href="{{ route('admin.games.index') }}" class="cyber-btn-ghost">
                    <i class="fas fa-times mr-2"></i>
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Games Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($games as $game)
            <div class="cyber-game-card group">
                <!-- Game Image -->
                <div class="relative overflow-hidden rounded-t-lg">
                    <img data-src="{{ $game->image_url }}" 
                         src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjQwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZGVmcz48bGluZWFyR3JhZGllbnQgaWQ9ImciIHgxPSIwJSIgeTE9IjAlIiB4Mj0iMTAwJSIgeTI9IjEwMCUiPjxzdG9wIHN0b3AtY29sb3I9IiMxYTBiMWEiLz48c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiMyZDFiNjkiLz48L2xpbmVhckdyYWRpZW50PjwvZGVmcz48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSJ1cmwoI2cpIi8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIyNCIgZmlsbD0iIzAwRkZGRiIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iPkxvYWRpbmcuLi48L3RleHQ+PC9zdmc+"
                         alt="{{ $game->name }}" 
                         class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-110 lazy-load"
                         onerror="handleImageError(this, '{{ addslashes($game->name) }}')"
                         data-fallback-attempted="false">
                    
                    <!-- Status Badge -->
                    <div class="absolute top-2 left-2">
                        <span class="status-badge {{ $game->is_active ? 'status-active' : 'status-inactive' }}">
                            {{ $game->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </div>

                    <!-- Feature Badges -->
                    <div class="absolute top-2 right-2 space-y-1">
                        @if($game->is_new)
                            <span class="feature-badge bg-pink-500">NEW</span>
                        @endif
                        @if($game->is_popular)
                            <span class="feature-badge bg-yellow-500">HOT</span>
                        @endif
                    </div>


                </div>

                <!-- Game Info -->
                <div class="p-4">
                    <h3 class="text-white font-semibold text-lg mb-2 truncate">{{ $game->name }}</h3>
                    
                    <!-- Provider & Category -->
                    <div class="flex items-center space-x-4 mb-3">
                        <div class="flex items-center space-x-1">
                            <img src="{{ $game->provider->logo_url ?: '/images/default-provider.png' }}" 
                                 alt="{{ $game->provider->name }}" 
                                 class="w-6 h-6 rounded object-cover"
                                 onerror="handleProviderImageError(this)"
                                 data-fallback-attempted="false">
                            <span class="text-cyan-400 text-sm">{{ $game->provider->name }}</span>
                        </div>
                        <div class="flex items-center space-x-1">
                            <i class="{{ $game->category->icon ?: 'fas fa-gamepad' }} text-purple-400 text-sm"></i>
                            <span class="text-purple-400 text-sm">{{ $game->category->name }}</span>
                        </div>
                    </div>

                    <!-- Game Controls -->
                    <div class="space-y-2 mb-3">
                        <!-- Status Toggles -->
                        <div class="flex items-center justify-between">
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="checkbox" {{ $game->is_active ? 'checked' : '' }} 
                                       onchange="toggleStatus({{ $game->id }})" 
                                       class="cyber-checkbox">
                                <span class="text-sm text-gray-300">Aktif</span>
                            </label>
                            
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="checkbox" {{ $game->is_popular ? 'checked' : '' }} 
                                       onchange="togglePopular({{ $game->id }})" 
                                       class="cyber-checkbox cyber-checkbox-popular">
                                <span class="text-sm text-orange-400">Populer</span>
                            </label>
                            
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="checkbox" {{ $game->is_new ? 'checked' : '' }} 
                                       onchange="toggleNew({{ $game->id }})" 
                                       class="cyber-checkbox cyber-checkbox-new">
                                <span class="text-sm text-pink-400">Baru</span>
                            </label>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.games.edit', $game) }}" class="cyber-btn-small text-cyan-400 hover:text-cyan-300" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="{{ route('admin.games.show', $game) }}" class="cyber-btn-small text-blue-400 hover:text-blue-300" title="View">
                            <i class="fas fa-eye"></i>
                        </a>
                        <button data-game-id="{{ $game->id }}" onclick="deleteGame(this.dataset.gameId)" 
                                class="cyber-btn-small text-red-400 hover:text-red-300" 
                                title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="cyber-card text-center py-12">
                    <i class="fas fa-gamepad text-6xl text-gray-600 mb-4"></i>
                    <h3 class="text-xl font-semibold text-white mb-2">Belum Ada Game</h3>
                    <p class="text-gray-400 mb-6">Mulai tambahkan game untuk situs Anda</p>
                    <a href="{{ route('admin.games.create') }}" class="cyber-btn-primary">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Game Pertama
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($games->hasPages())
        <div class="flex justify-center">
            <div class="cyber-pagination">
                {{ $games->appends(request()->query())->links() }}
            </div>
        </div>
    @endif
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="cyber-card max-w-md w-full mx-4">
        <div class="text-center">
            <i class="fas fa-exclamation-triangle text-red-400 text-6xl mb-4"></i>
            <h3 class="text-xl font-semibold text-white mb-2">Hapus Game</h3>
            <p class="text-gray-400 mb-6">Apakah Anda yakin ingin menghapus game ini? Tindakan ini tidak dapat dibatalkan.</p>
            <div class="flex space-x-4">
                <button onclick="closeDeleteModal()" class="cyber-btn-ghost flex-1">Batal</button>
                <form id="deleteForm" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="cyber-btn-danger w-full">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Cyber Game Card */
.cyber-game-card {
    background: linear-gradient(135deg, rgba(26, 11, 26, 0.8), rgba(45, 27, 105, 0.8));
    border: 1px solid rgba(0, 255, 255, 0.2);
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.cyber-game-card:hover {
    border-color: rgba(0, 255, 255, 0.5);
    box-shadow: 0 0 30px rgba(0, 255, 255, 0.2);
    transform: translateY(-5px);
}

/* Status Badges */
.status-badge {
    padding: 2px 8px;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
}

.status-active {
    background: linear-gradient(135deg, #10B981, #059669);
    color: white;
}

.status-inactive {
    background: linear-gradient(135deg, #EF4444, #DC2626);
    color: white;
}

/* Feature Badges */
.feature-badge {
    padding: 2px 6px;
    border-radius: 8px;
    font-size: 0.6rem;
    font-weight: 700;
    color: white;
    display: block;
    text-align: center;
}

/* Action Buttons */
.cyber-btn-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: rgba(0, 0, 0, 0.8);
    border: 1px solid currentColor;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.cyber-btn-icon:hover {
    background: currentColor;
    color: black !important;
    transform: scale(1.1);
}

.cyber-btn-icon-small {
    width: 32px;
    height: 32px;
    border-radius: 6px;
    background: rgba(0, 0, 0, 0.8);
    border: 1px solid currentColor;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
    font-size: 12px;
}

.cyber-btn-icon-small:hover {
    background: currentColor;
    color: black !important;
    transform: scale(1.05);
    box-shadow: 0 0 10px currentColor;
}

/* Cyber Checkboxes */
.cyber-checkbox {
    appearance: none;
    width: 18px;
    height: 18px;
    border: 2px solid #00FFFF;
    border-radius: 3px;
    background: rgba(0, 0, 0, 0.3);
    position: relative;
    cursor: pointer;
    transition: all 0.3s ease;
}

.cyber-checkbox:checked {
    background: linear-gradient(135deg, #00FFFF, #8B00FF);
    border-color: #00FFFF;
    box-shadow: 0 0 10px rgba(0, 255, 255, 0.5);
}

.cyber-checkbox:checked::after {
    content: '✓';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: black;
    font-weight: bold;
    font-size: 12px;
}

.cyber-checkbox-popular {
    border-color: #FF6B35;
}

.cyber-checkbox-popular:checked {
    background: linear-gradient(135deg, #FF6B35, #FF8E53);
    border-color: #FF6B35;
    box-shadow: 0 0 10px rgba(255, 107, 53, 0.5);
}

.cyber-checkbox-new {
    border-color: #FF0080;
}

.cyber-checkbox-new:checked {
    background: linear-gradient(135deg, #FF0080, #FF69B4);
    border-color: #FF0080;
    box-shadow: 0 0 10px rgba(255, 0, 128, 0.5);
}

.cyber-checkbox:hover {
    transform: scale(1.1);
    box-shadow: 0 0 15px currentColor;
}

/* Small Action Buttons */
.cyber-btn-small {
    width: 28px;
    height: 28px;
    border-radius: 4px;
    background: rgba(0, 0, 0, 0.6);
    border: 1px solid currentColor;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    font-size: 12px;
    text-decoration: none;
}

.cyber-btn-small:hover {
    background: currentColor;
    color: black !important;
    transform: scale(1.1);
    box-shadow: 0 0 8px currentColor;
}

/* Cyber Pagination */
.cyber-pagination nav {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
}

.cyber-pagination a,
.cyber-pagination span {
    padding: 8px 12px;
    border-radius: 8px;
    background: rgba(0, 255, 255, 0.1);
    border: 1px solid rgba(0, 255, 255, 0.2);
    color: #00FFFF;
    text-decoration: none;
    transition: all 0.3s ease;
    font-size: 14px;
    font-weight: 500;
}

.cyber-pagination a:hover {
    background: rgba(0, 255, 255, 0.2);
    border-color: rgba(0, 255, 255, 0.4);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 255, 255, 0.3);
}

.cyber-pagination .current {
    background: linear-gradient(135deg, #00FFFF, #8B00FF);
    color: black;
    font-weight: 600;
    box-shadow: 0 0 15px rgba(0, 255, 255, 0.5);
}

.cyber-pagination .disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.cyber-pagination .disabled:hover {
    background: rgba(0, 255, 255, 0.1);
    border-color: rgba(0, 255, 255, 0.2);
    transform: none;
    box-shadow: none;
}

/* Responsive Pagination */
@media (max-width: 640px) {
    .cyber-pagination nav {
        gap: 4px;
    }
    
    .cyber-pagination a,
    .cyber-pagination span {
        padding: 6px 8px;
        font-size: 12px;
    }
}
</style>

<script>
// Handle image loading errors to prevent infinite loops
function handleImageError(img, gameName) {
    if (img.dataset.fallbackAttempted === 'false') {
        img.dataset.fallbackAttempted = 'true';
        // Create a simple colored placeholder instead of loading external URL
        createImagePlaceholder(img, gameName);
    }
}

function handleProviderImageError(img) {
    if (img.dataset.fallbackAttempted === 'false') {
        img.dataset.fallbackAttempted = 'true';
        // Create simple provider icon placeholder
        createProviderPlaceholder(img);
    }
}

function createImagePlaceholder(img, gameName) {
    // Create a canvas element to generate placeholder
    const canvas = document.createElement('canvas');
    canvas.width = 300;
    canvas.height = 400;
    const ctx = canvas.getContext('2d');
    
    // Create gradient background
    const gradient = ctx.createLinearGradient(0, 0, 300, 400);
    gradient.addColorStop(0, '#1a0b1a');
    gradient.addColorStop(0.5, '#2d1b69');
    gradient.addColorStop(1, '#0d0d0d');
    
    ctx.fillStyle = gradient;
    ctx.fillRect(0, 0, 300, 400);
    
    // Add game name text
    ctx.fillStyle = '#00FFFF';
    ctx.font = 'bold 24px Arial';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    
    // Split long names
    const words = gameName.split(' ');
    if (words.length > 2) {
        ctx.fillText(words.slice(0, 2).join(' '), 150, 180);
        ctx.fillText(words.slice(2).join(' '), 150, 220);
    } else {
        ctx.fillText(gameName, 150, 200);
    }
    
    // Add icon
    ctx.fillStyle = '#8B00FF';
    ctx.font = '48px Arial';
    ctx.fillText('🎮', 150, 120);
    
    // Convert to data URL and set as src
    img.src = canvas.toDataURL();
}

function createProviderPlaceholder(img) {
    const canvas = document.createElement('canvas');
    canvas.width = 24;
    canvas.height = 24;
    const ctx = canvas.getContext('2d');
    
    // Background
    ctx.fillStyle = '#2d1b69';
    ctx.fillRect(0, 0, 24, 24);
    
    // Text
    ctx.fillStyle = '#00FFFF';
    ctx.font = 'bold 12px Arial';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    ctx.fillText('P', 12, 12);
    
    img.src = canvas.toDataURL();
}

function toggleStatus(gameId) {
    console.log('Toggling status for game ID:', gameId);
    
    fetch(`/admin/games/${gameId}/toggle-status`, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        console.log('Response status:', response.status);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('Response data:', data);
        if (data.success) {
            showNotification(data.message, 'success');
            setTimeout(() => location.reload(), 1000);
        } else {
            showNotification(data.message || 'Terjadi kesalahan!', 'error');
        }
    })
    .catch(error => {
        console.error('Error details:', error);
        showNotification(`Error: ${error.message}`, 'error');
    });
}

function togglePopular(gameId) {
    console.log('Toggling popular for game ID:', gameId);
    
    fetch(`/admin/games/${gameId}/toggle-popular`, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        console.log('Response status:', response.status);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('Response data:', data);
        if (data.success) {
            showNotification(data.message, 'success');
            setTimeout(() => location.reload(), 1000);
        } else {
            showNotification(data.message || 'Terjadi kesalahan!', 'error');
        }
    })
    .catch(error => {
        console.error('Error details:', error);
        showNotification(`Error: ${error.message}`, 'error');
    });
}

function toggleNew(gameId) {
    console.log('Toggling new for game ID:', gameId);
    
    fetch(`/admin/games/${gameId}/toggle-new`, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        console.log('Response status:', response.status);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('Response data:', data);
        if (data.success) {
            showNotification(data.message, 'success');
            setTimeout(() => location.reload(), 1000);
        } else {
            showNotification(data.message || 'Terjadi kesalahan!', 'error');
        }
    })
    .catch(error => {
        console.error('Error details:', error);
        showNotification(`Error: ${error.message}`, 'error');
    });
}

// Simple notification system
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 px-4 py-2 rounded-lg text-white font-semibold transition-all duration-300 transform translate-x-full`;
    
    // Set colors based on type
    switch (type) {
        case 'success':
            notification.className += ' bg-green-500';
            break;
        case 'error':
            notification.className += ' bg-red-500';
            break;
        default:
            notification.className += ' bg-blue-500';
    }
    
    notification.textContent = message;
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
    }, 100);
    
    // Remove after 3 seconds
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 3000);
}

function deleteGame(gameId) {
    document.getElementById('deleteForm').action = `/admin/games/${gameId}`;
    document.getElementById('deleteModal').classList.remove('hidden');
    document.getElementById('deleteModal').classList.add('flex');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
    document.getElementById('deleteModal').classList.remove('flex');
}

// Optimize page loading with lazy loading
document.addEventListener('DOMContentLoaded', function() {
    // Lazy load images that are not in viewport
    const lazyImages = document.querySelectorAll('img.lazy-load');
    
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    
                    // Load the actual image
                    if (img.dataset.src && !img.dataset.loaded) {
                        const tempImg = new Image();
                        tempImg.onload = function() {
                            img.src = img.dataset.src;
                            img.classList.add('loaded');
                            img.dataset.loaded = 'true';
                        };
                        tempImg.onerror = function() {
                            handleImageError(img, img.alt);
                        };
                        tempImg.src = img.dataset.src;
                    }
                    
                    imageObserver.unobserve(img);
                }
            });
        }, {
            rootMargin: '100px',
            threshold: 0.1
        });
        
        lazyImages.forEach(img => {
            imageObserver.observe(img);
        });
    } else {
        // Fallback for older browsers
        lazyImages.forEach(img => {
            if (img.dataset.src) {
                img.src = img.dataset.src;
            }
        });
    }
    
    // Add smooth loading animation
    const style = document.createElement('style');
    style.textContent = `
        .lazy-load {
            transition: opacity 0.3s ease;
        }
        .lazy-load:not(.loaded) {
            opacity: 0.7;
        }
        .lazy-load.loaded {
            opacity: 1;
        }
    `;
    document.head.appendChild(style);
});
</script>
@endsection
