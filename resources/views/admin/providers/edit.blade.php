@extends('layouts.admin')

@section('title', 'Edit Provider')

@section('content')
<div class="min-h-screen bg-black text-white p-4">
    <div class="max-w-4xl mx-auto">
        
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center space-x-4 mb-4">
                <a href="{{ route('admin.providers.index') }}" class="cyber-btn-outline">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-cyan-400 to-purple-400 bg-clip-text text-transparent">
                    <i class="fas fa-edit mr-3"></i>Edit Provider: {{ $provider->name }}
                </h1>
            </div>
            <p class="text-gray-400">Edit informasi provider dan upload gambar/logo baru</p>
        </div>

        <form action="{{ route('admin.providers.update', $provider) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                <!-- Left Column - Basic Info -->
                <div class="cyber-card">
                    <h2 class="text-xl font-bold text-cyan-400 mb-6">
                        <i class="fas fa-info-circle mr-2"></i>Informasi Dasar
                    </h2>
                    
                    <div class="space-y-6">
                        <!-- Provider Name -->
                        <div>
                            <label class="cyber-label">Nama Provider *</label>
                            <input type="text" name="name" value="{{ old('name', $provider->name) }}" required 
                                   class="cyber-input @error('name') border-red-500 @enderror" 
                                   placeholder="Masukkan nama provider">
                            @error('name')
                                <p class="cyber-error">{{ $message }}</p>
                            @enderror
                        </div>



                        <!-- Sort Order -->
                        <div>
                            <label class="cyber-label">Urutan Tampilan</label>
                            <input type="number" name="sort_order" value="{{ old('sort_order', $provider->sort_order) }}" 
                                   class="cyber-input @error('sort_order') border-red-500 @enderror" 
                                   placeholder="0">
                            @error('sort_order')
                                <p class="cyber-error">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-gray-500 mt-1">Angka lebih kecil akan ditampilkan lebih dulu</p>
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="cyber-label">Status</label>
                            <div class="flex items-center space-x-3">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" value="1" 
                                       {{ old('is_active', $provider->is_active) ? 'checked' : '' }}
                                       class="cyber-checkbox">
                                <span class="text-gray-300">Provider aktif</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Images -->
                <div class="cyber-card">
                    <h2 class="text-xl font-bold text-purple-400 mb-6">
                        <i class="fas fa-images mr-2"></i>Gambar & Logo
                    </h2>
                    
                    <div class="space-y-6">
                        <!-- Current Logo -->
                        @if($provider->logo_url && !str_contains($provider->logo_url, 'placeholder'))
                            <div>
                                <label class="cyber-label">Logo Saat Ini</label>
                                <div class="bg-gray-800 rounded-lg p-4 mb-4">
                                    <img src="{{ $provider->logo_url }}" alt="Current Logo" 
                                         class="max-h-24 mx-auto object-contain">
                                </div>
                            </div>
                        @endif

                        <!-- Logo Upload -->
                        <div>
                            <label class="cyber-label">{{ $provider->logo_url ? 'Ganti Logo' : 'Upload Logo' }}</label>
                            <div class="border-2 border-dashed border-gray-600 rounded-lg p-6 text-center hover:border-cyan-400 transition-colors">
                                <input type="file" name="logo" accept="image/*" id="logo-upload" class="hidden" 
                                       onchange="previewImage(this, 'logo-preview')">
                                <label for="logo-upload" class="cursor-pointer">
                                    <div id="logo-preview" class="mb-4">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-500 mb-2"></i>
                                        <p class="text-gray-400">Klik untuk upload logo baru</p>
                                        <p class="text-xs text-gray-500">PNG, JPG, GIF, SVG (Max: 2MB)</p>
                                    </div>
                                </label>
                            </div>
                            @error('logo')
                                <p class="cyber-error">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-gray-500 mt-1">Rekomendasi: 150x80 pixels untuk hasil terbaik</p>
                        </div>


                    </div>
                </div>
            </div>

            <!-- Provider Stats -->
            <div class="cyber-card">
                <h2 class="text-xl font-bold text-green-400 mb-4">
                    <i class="fas fa-chart-bar mr-2"></i>Statistik Provider
                </h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-cyan-400">{{ $provider->games()->count() }}</div>
                        <div class="text-sm text-gray-400">Total Games</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-green-400">{{ $provider->games()->where('is_active', true)->count() }}</div>
                        <div class="text-sm text-gray-400">Active Games</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-purple-400">{{ $provider->games()->where('is_popular', true)->count() }}</div>
                        <div class="text-sm text-gray-400">Popular Games</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-yellow-400">{{ $provider->games()->where('is_new', true)->count() }}</div>
                        <div class="text-sm text-gray-400">New Games</div>
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
                        <a href="{{ route('admin.providers.index') }}" class="cyber-btn-outline">
                            <i class="fas fa-times mr-2"></i>Batal
                        </a>
                        <button type="submit" class="cyber-btn-primary">
                            <i class="fas fa-save mr-2"></i>Update Provider
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.innerHTML = `
                <div class="relative">
                    <img src="${e.target.result}" alt="Preview" class="max-w-full max-h-48 mx-auto rounded-lg shadow-lg">
                    <div class="mt-2 text-sm text-green-400">
                        <i class="fas fa-check-circle mr-1"></i>
                        Gambar baru berhasil dipilih
                    </div>
                </div>
            `;
        };
        
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
