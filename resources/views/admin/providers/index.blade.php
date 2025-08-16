@extends('layouts.admin')

@section('title', 'Kelola Provider')

@section('content')
<div class="min-h-screen bg-black text-white p-4">
    <div class="max-w-7xl mx-auto">
        
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-cyan-400 to-purple-400 bg-clip-text text-transparent">
                    <i class="fas fa-building mr-3"></i>Kelola Provider
                </h1>
                <p class="text-gray-400 mt-2">Manage game providers and their icons</p>
            </div>
            <a href="{{ route('admin.providers.create') }}" class="cyber-btn-primary">
                <i class="fas fa-plus mr-2"></i>Tambah Provider
            </a>
        </div>

        <!-- Search & Filters -->
        <div class="cyber-card mb-8">
            <form method="GET" action="{{ route('admin.providers.index') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Search -->
                    <div>
                        <label class="cyber-label">Cari Provider</label>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Nama atau deskripsi provider..." 
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
                        <a href="{{ route('admin.providers.index') }}" class="cyber-btn-outline">Reset</a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Provider Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($providers as $provider)
                <div class="cyber-card group hover:scale-105 transition-all duration-300">
                    <!-- Provider Logo -->
                    <div class="relative mb-4">
                        <div class="w-full h-32 bg-gradient-to-br from-gray-800 to-gray-900 rounded-lg overflow-hidden">
                            @if($provider->logo_url && !str_contains($provider->logo_url, 'placeholder'))
                                <img src="{{ $provider->logo_url }}" alt="{{ $provider->name }}" 
                                     class="w-full h-full object-contain p-4">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <div class="text-center">
                                        <i class="fas fa-building text-3xl text-gray-500 mb-2"></i>
                                        <p class="text-xs text-gray-500">No Logo</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Status Badge -->
                        <span class="absolute top-2 right-2 {{ $provider->is_active ? 'cyber-badge-success' : 'cyber-badge-danger' }}">
                            {{ $provider->is_active ? 'Aktif' : 'Tidak Aktif' }}
                        </span>
                    </div>

                    <!-- Provider Info -->
                    <div class="space-y-3">
                        <h3 class="text-lg font-bold text-white group-hover:text-cyan-400 transition-colors">
                            {{ $provider->name }}
                        </h3>
                        


                        <!-- Stats -->
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400">Games:</span>
                            <span class="text-cyan-400 font-semibold">{{ $provider->games_count ?? $provider->games()->count() }}</span>
                        </div>

                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400">Sort Order:</span>
                            <span class="text-purple-400">{{ $provider->sort_order }}</span>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mt-4 pt-4 border-t border-gray-700 flex justify-between">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.providers.show', $provider) }}" 
                               class="cyber-btn-sm cyber-btn-outline" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.providers.edit', $provider) }}" 
                               class="cyber-btn-sm cyber-btn-secondary" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                        
                        <div class="flex space-x-2">
                            <!-- Toggle Status -->
                            <button onclick="toggleStatus({{ $provider->id }})" 
                                    class="cyber-btn-sm {{ $provider->is_active ? 'cyber-btn-warning' : 'cyber-btn-success' }}" 
                                    title="{{ $provider->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                <i class="fas fa-{{ $provider->is_active ? 'eye-slash' : 'eye' }}"></i>
                            </button>
                            
                            <!-- Delete -->
                            <form action="{{ route('admin.providers.destroy', $provider) }}" method="POST" 
                                  onsubmit="return confirm('Yakin ingin menghapus provider ini?')" class="inline">
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
                        <i class="fas fa-building text-6xl text-gray-600 mb-4"></i>
                        <h3 class="text-xl font-bold text-gray-400 mb-2">Belum Ada Provider</h3>
                        <p class="text-gray-500 mb-6">Mulai dengan menambahkan provider pertama Anda.</p>
                        <a href="{{ route('admin.providers.create') }}" class="cyber-btn-primary">
                            <i class="fas fa-plus mr-2"></i>Tambah Provider Pertama
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($providers->hasPages())
            <div class="mt-8 flex justify-center">
                {{ $providers->links() }}
            </div>
        @endif
    </div>
</div>

<script>
function toggleStatus(providerId) {
    fetch(`/admin/providers/${providerId}/toggle-status`, {
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
