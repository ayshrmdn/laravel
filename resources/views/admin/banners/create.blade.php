@extends('layouts.admin')

@section('title', 'Tambah Banner')

@section('content')
<div class="min-h-screen bg-black text-white p-4">
    <div class="max-w-4xl mx-auto">
        
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center space-x-4 mb-4">
                <a href="{{ route('admin.banners.index') }}" class="cyber-btn-outline">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-cyan-400 to-purple-400 bg-clip-text text-transparent">
                    <i class="fas fa-plus-circle mr-3"></i>Tambah Banner Baru
                </h1>
            </div>
            <p class="text-gray-400">Buat banner baru untuk slider di halaman utama</p>
        </div>

        <!-- Form -->
        <div class="cyber-card">
        <form method="POST" action="{{ route('admin.banners.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Image Upload -->
            <div>
                <label class="cyber-label">Gambar Banner *</label>
                <div class="border-2 border-dashed border-gray-600 rounded-lg p-6 text-center hover:border-cyan-400 transition-colors">
                    <input type="file" name="image" accept="image/*" id="image" class="hidden" required>
                    <label for="image" class="cursor-pointer">
                        <div id="image-preview" class="mb-4">
                            <i class="fas fa-image text-4xl text-gray-500 mb-2"></i>
                            <p class="text-gray-400">Klik untuk upload gambar banner</p>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF, SVG (Max: 2MB)</p>
                        </div>
                    </label>
                </div>
                @error('image')
                    <p class="cyber-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Order -->
            <div>
                <label class="cyber-label">Urutan Tampil *</label>
                <input type="number" name="order" value="{{ old('order', 0) }}" min="0" required
                    class="cyber-input @error('order') border-red-500 @enderror">
                <p class="text-xs text-gray-500 mt-1">Angka yang lebih kecil akan muncul terlebih dahulu</p>
                @error('order')
                    <p class="cyber-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div>
                <label class="cyber-label">Status</label>
                <div class="flex items-center space-x-3">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }}
                        class="cyber-checkbox">
                    <span class="text-gray-300">Banner aktif</span>
                </div>
                <p class="text-xs text-gray-500 mt-1">Banner yang aktif akan ditampilkan di halaman utama</p>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-between items-center pt-6 border-t border-gray-700">
                <div class="text-sm text-gray-400">
                    <i class="fas fa-info-circle mr-1"></i>
                    Fields dengan tanda (*) wajib diisi
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('admin.banners.index') }}" class="cyber-btn-outline">
                        <i class="fas fa-times mr-2"></i>Batal
                    </a>
                    <button type="submit" class="cyber-btn-primary">
                        <i class="fas fa-save mr-2"></i>Simpan Banner
                    </button>
                </div>
            </div>
        </form>
    </div>
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
                    <div class="mt-2 text-sm text-cyan-400">
                        <i class="fas fa-check-circle mr-1"></i>
                        Gambar berhasil dipilih
                    </div>
                </div>
            `;
        };
        
        reader.readAsDataURL(input.files[0]);
    }
}

document.getElementById('image').addEventListener('change', function(e) {
    previewImage(this, 'image-preview');
});
</script>
@endsection
