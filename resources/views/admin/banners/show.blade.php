@extends('layouts.admin')

@section('title', 'Detail Banner')

@section('content')
<div class="min-h-screen bg-black text-white p-4">
    <div class="max-w-7xl mx-auto">
        
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.banners.index') }}" class="cyber-btn-outline">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                <div>
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-cyan-400 to-purple-400 bg-clip-text text-transparent">
                        <i class="fas fa-image mr-3"></i>Detail Banner
                    </h1>
                    <p class="text-gray-400 mt-2">Informasi lengkap banner</p>
                </div>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('admin.banners.edit', $banner) }}" class="cyber-btn-secondary">
                    <i class="fas fa-edit mr-2"></i>Edit Banner
                </a>
            </div>
        </div>

    <!-- Banner Preview -->
    <div class="cyber-card mb-8 overflow-hidden">
        <h2 class="text-xl font-bold text-cyan-400 mb-6 flex items-center">
            <i class="fas fa-eye mr-3"></i>Preview Banner
        </h2>
        <div class="relative h-64 md:h-80 rounded-lg overflow-hidden border border-cyan-400">
            @if($banner->image)
                <!-- Debug info -->
                <div class="absolute top-2 left-2 bg-black bg-opacity-75 text-white text-xs p-2 rounded z-20">
                    Image: {{ $banner->image }}<br>
                    URL: {{ asset('storage/' . $banner->image) }}
                </div>
                
                <!-- Gambar banner dengan styling yang lebih sederhana -->
                <div class="w-full h-full bg-gray-900">
                    <img src="{{ asset('storage/' . $banner->image) }}" 
                         alt="Banner Preview" 
                         class="w-full h-full object-cover"
                         style="max-width: 100%; height: auto; display: block;">
                </div>
                
                <!-- Overlay dengan opacity yang lebih rendah -->
                <div class="absolute inset-0 bg-black bg-opacity-30"></div>
                
                <!-- Konten di atas gambar -->
                <div class="absolute inset-0 flex items-center justify-center text-center text-white px-6">
                    <div class="bg-black bg-opacity-60 p-6 rounded-lg">
                        <h2 class="text-2xl md:text-4xl font-bold mb-4 text-cyan-400">{{ $banner->title ?? 'Banner Title' }}</h2>
                        @if($banner->description)
                        <p class="text-lg md:text-xl text-gray-300">{{ $banner->description }}</p>
                        @endif
                    </div>
                </div>
            @else
                <div class="w-full h-full bg-gradient-to-r from-gray-800 to-gray-900 flex items-center justify-center">
                    <div class="text-center">
                        <i class="fas fa-image text-gray-600 text-6xl mb-4"></i>
                        <p class="text-gray-400 text-lg">Tidak ada gambar banner</p>
                        <p class="text-gray-500 text-sm">Image field: {{ $banner->image ?? 'null' }}</p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Banner Details -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Basic Information -->
        <div class="cyber-card">
            <h3 class="text-xl font-bold text-cyan-400 mb-6 flex items-center">
                <i class="fas fa-info-circle mr-3"></i>Informasi Dasar
            </h3>
            <div class="space-y-4">
                <div>
                    <label class="cyber-label">Judul</label>
                    <p class="text-white">{{ $banner->title ?? 'Tidak ada judul' }}</p>
                </div>
                
                @if($banner->description)
                <div>
                    <label class="cyber-label">Deskripsi</label>
                    <p class="text-gray-300">{{ $banner->description }}</p>
                </div>
                @endif
                
                <div>
                    <label class="cyber-label">Teks Tombol</label>
                    <p class="text-purple-400">{{ $banner->button_text ?? 'Tidak ada teks tombol' }}</p>
                </div>
                
                @if($banner->button_url)
                <div>
                    <label class="cyber-label">URL Tombol</label>
                    <a href="{{ $banner->button_url }}" target="_blank" class="text-cyan-400 hover:text-cyan-300 break-all">
                        {{ $banner->button_url }}
                        <i class="fas fa-external-link-alt ml-1"></i>
                    </a>
                </div>
                @endif
            </div>
        </div>

        <!-- Settings & Status -->
        <div class="cyber-card">
            <h3 class="text-xl font-bold text-purple-400 mb-6 flex items-center">
                <i class="fas fa-cog mr-3"></i>Pengaturan & Status
            </h3>
            <div class="space-y-4">
                <div>
                    <label class="cyber-label">Urutan Tampil</label>
                    <span class="cyber-badge-success">
                        {{ $banner->order }}
                    </span>
                </div>
                
                <div>
                    <label class="cyber-label">Status</label>
                    <div>
                        @if($banner->is_active)
                            <span class="cyber-badge-success">
                                <i class="fas fa-check mr-1"></i>Aktif
                            </span>
                        @else
                            <span class="cyber-badge-danger">
                                <i class="fas fa-times mr-1"></i>Nonaktif
                            </span>
                        @endif
                    </div>
                </div>
                
                <div>
                    <label class="cyber-label">Dibuat</label>
                    <p class="text-cyan-400">
                        {{ $banner->created_at->format('d M Y, H:i') }}
                        <span class="text-gray-400">({{ $banner->created_at->diffForHumans() }})</span>
                    </p>
                </div>
                
                <div>
                    <label class="cyber-label">Terakhir Diupdate</label>
                    <p class="text-purple-400">
                        {{ $banner->updated_at->format('d M Y, H:i') }}
                        <span class="text-gray-400">({{ $banner->updated_at->diffForHumans() }})</span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="cyber-card mt-8">
        <h3 class="text-xl font-bold text-yellow-400 mb-6 flex items-center">
            <i class="fas fa-tools mr-3"></i>Aksi Banner
        </h3>
        <div class="flex items-center space-x-4">
            <!-- Toggle Status -->
            <form method="POST" action="{{ route('admin.banners.toggle-status', $banner) }}" class="inline">
                @csrf
                @method('PATCH')
                <button type="submit" class="cyber-btn-{{ $banner->is_active ? 'warning' : 'success' }}">
                    <i class="fas {{ $banner->is_active ? 'fa-toggle-off' : 'fa-toggle-on' }} mr-2"></i>
                    {{ $banner->is_active ? 'Nonaktifkan' : 'Aktifkan' }} Banner
                </button>
            </form>
            
            <!-- Delete -->
            <form method="POST" action="{{ route('admin.banners.destroy', $banner) }}" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus banner ini? Tindakan ini tidak dapat dibatalkan.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="cyber-btn-danger">
                    <i class="fas fa-trash mr-2"></i>Hapus Banner
                </button>
            </form>
        </div>
    </div>
    </div>
</div>

<script>
// Debug gambar
document.addEventListener('DOMContentLoaded', function() {
    const img = document.querySelector('img[alt="Banner Preview"]');
    if (img) {
        img.addEventListener('load', function() {
            console.log('Gambar berhasil dimuat:', this.src);
        });
        img.addEventListener('error', function() {
            console.error('Gagal memuat gambar:', this.src);
            this.style.border = '2px solid red';
            this.style.backgroundColor = 'red';
        });
    }
});
</script>
@endsection
