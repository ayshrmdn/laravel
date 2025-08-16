@extends('layouts.admin')

@section('title', 'Tambah Provider')

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
                    <i class="fas fa-plus-circle mr-3"></i>Tambah Provider Baru
                </h1>
            </div>
            <p class="text-gray-400">Tambahkan provider game baru dengan logo dan informasi lengkap</p>
        </div>

        <form action="{{ route('admin.providers.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            
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
                            <input type="text" name="name" value="{{ old('name') }}" required 
                                   class="cyber-input @error('name') border-red-500 @enderror" 
                                   placeholder="Masukkan nama provider">
                            @error('name')
                                <p class="cyber-error">{{ $message }}</p>
                            @enderror
                        </div>



                        <!-- Sort Order -->
                        <div>
                            <label class="cyber-label">Urutan Tampilan</label>
                            <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" 
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
                                       {{ old('is_active', 1) ? 'checked' : '' }}
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
                        <!-- Logo Upload -->
                        <div>
                            <label class="cyber-label">Logo Provider</label>
                            <div class="border-2 border-dashed border-gray-600 rounded-lg p-6 text-center hover:border-cyan-400 transition-colors">
                                <input type="file" name="logo" accept="image/*" id="logo-upload" class="hidden" 
                                       onchange="previewImage(this, 'logo-preview')">
                                <label for="logo-upload" class="cursor-pointer">
                                    <div id="logo-preview" class="mb-4">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-500 mb-2"></i>
                                        <p class="text-gray-400">Klik untuk upload logo</p>
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
                            <i class="fas fa-save mr-2"></i>Simpan Provider
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
                        Gambar berhasil dipilih
                    </div>
                </div>
            `;
        };
        
        reader.readAsDataURL(input.files[0]);
    }
}

// Auto-generate slug from name
document.querySelector('input[name="name"]').addEventListener('input', function(e) {
    // Auto-focus could be added here if needed
});
</script>
@endsection
