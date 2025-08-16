@extends('layouts.admin')

@section('title', 'Kelola Kategori')

@section('content')
<div class="min-h-screen bg-black text-white p-4">
    <div class="max-w-7xl mx-auto">
        
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-cyan-400 to-purple-400 bg-clip-text text-transparent">
                    <i class="fas fa-tags mr-3"></i>Kelola Kategori
                </h1>
                <p class="text-gray-400 mt-2">Manage game categories with icons and colors</p>
            </div>
            <a href="{{ route('admin.categories.create') }}" class="cyber-btn-primary">
                <i class="fas fa-plus mr-2"></i>Tambah Kategori
            </a>
        </div>

        <!-- Search & Filters -->
        <div class="cyber-card mb-8">
            <form method="GET" action="{{ route('admin.categories.index') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Search -->
                    <div>
                        <label class="cyber-label">Cari Kategori</label>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Nama kategori..." 
                               class="cyber-input">
                    </div>

                    <!-- Status Filter -->
                    <div>
                        <label class="cyber-label">Status</label>
                        <select name="status" class="cyber-select">
                            <option value="">Semua Status</option>
                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-end space-x-2">
                        <button type="submit" class="cyber-btn-secondary">
                            <i class="fas fa-search mr-2"></i>Cari
                        </button>
                        <a href="{{ route('admin.categories.index') }}" class="cyber-btn-outline">Reset</a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Categories Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($categories as $category)
                <div class="cyber-card group hover:scale-105 transition-all duration-300">
                    <!-- Category Icon & Color -->
                    <div class="relative mb-4">
                        <div class="w-full h-32 rounded-lg overflow-hidden flex items-center justify-center category-bg" 
                             data-color="{{ $category->color }}">
                            
                            @if($category->image_url && !str_contains($category->image_url, 'placeholder'))
                                <img src="{{ $category->image_url }}" alt="{{ $category->name }}" 
                                     class="w-full h-full object-cover">
                            @else
                                <div class="text-center">
                                    <i class="{{ $category->icon_class }} text-4xl mb-2 category-icon" data-color="{{ $category->color }}"></i>
                                    <div class="w-8 h-1 mx-auto rounded category-line" data-color="{{ $category->color }}"></div>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Status Badge -->
                        <span class="absolute top-2 right-2 {{ $category->is_active ? 'cyber-badge-success' : 'cyber-badge-danger' }}">
                            {{ $category->is_active ? 'Aktif' : 'Tidak Aktif' }}
                        </span>
                    </div>

                    <!-- Category Info -->
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-bold text-white group-hover:text-cyan-400 transition-colors">
                                {{ $category->name }}
                            </h3>
                            <div class="w-4 h-4 rounded-full border-2 border-white category-color" data-color="{{ $category->color }}"></div>
                        </div>
                        


                        <!-- Icon Display -->
                        <div class="flex items-center space-x-2 text-sm">
                            <span class="text-gray-400">Icon:</span>
                            <i class="{{ $category->icon_class }} text-cyan-400"></i>
                            <code class="text-xs bg-gray-800 px-2 py-1 rounded">{{ $category->icon }}</code>
                        </div>

                        <!-- Stats -->
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400">Games:</span>
                            <span class="text-cyan-400 font-semibold">{{ $category->games_count ?? $category->games()->count() }}</span>
                        </div>

                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400">Sort Order:</span>
                            <span class="text-purple-400">{{ $category->sort_order }}</span>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mt-4 pt-4 border-t border-gray-700 flex justify-between">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.categories.edit', $category) }}" 
                               class="cyber-btn-sm cyber-btn-secondary" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                        
                        <div class="flex space-x-2">
                            <!-- Toggle Status -->
                            <button data-category-id="{{ $category->id }}" class="toggle-status-btn cyber-btn-sm {{ $category->is_active ? 'cyber-btn-warning' : 'cyber-btn-success' }}" title="{{ $category->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                <i class="fas fa-{{ $category->is_active ? 'eye-slash' : 'eye' }}"></i>
                            </button>
                            
                            <!-- Delete -->
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" 
                                  onsubmit="return confirm('Yakin ingin menghapus kategori ini?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="cyber-btn-sm cyber-btn-danger" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="cyber-card text-center py-12">
                        <i class="fas fa-tags text-6xl text-gray-600 mb-4"></i>
                        <h3 class="text-xl font-bold text-gray-400 mb-2">Belum Ada Kategori</h3>
                        <p class="text-gray-500 mb-6">Mulai dengan menambahkan kategori pertama Anda.</p>
                        <a href="{{ route('admin.categories.create') }}" class="cyber-btn-primary">
                            <i class="fas fa-plus mr-2"></i>Tambah Kategori Pertama
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($categories->hasPages())
            <div class="mt-8 flex justify-center">
                {{ $categories->links() }}
            </div>
        @endif
    </div>
</div>

<script>
// Add event listeners for toggle status buttons
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.toggle-status-btn').forEach(button => {
        button.addEventListener('click', function() {
            const categoryId = this.getAttribute('data-category-id');
            toggleStatus(categoryId);
        });
    });
});

function toggleStatus(categoryId) {
    fetch(`/admin/categories/${categoryId}/toggle-status`, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Show success message
            showNotification(data.message, 'success');
            // Reload page after a short delay
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        } else {
            showNotification('Terjadi kesalahan!', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan!', 'error');
    });
}

function showNotification(message, type) {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg text-white font-semibold transition-all duration-300 ${
        type === 'success' ? 'bg-green-600' : 'bg-red-600'
    }`;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    // Remove after 3 seconds
    setTimeout(() => {
        notification.remove();
    }, 3000);
}
</script>
@endsection
