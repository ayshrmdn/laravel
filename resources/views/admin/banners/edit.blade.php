@extends('layouts.admin')

@section('title', 'Edit Banner')

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
                    <i class="fas fa-edit mr-3"></i>Edit Banner
                </h1>
            </div>
            <p class="text-gray-400">Edit banner urutan {{ $banner->order }}</p>
        </div>

        <!-- Form -->
        <div class="cyber-card">
            <form method="POST" action="{{ route('admin.banners.update', $banner) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                
                <!-- Current Image Preview -->
                @if($banner->image)
                <div>
                    <label class="cyber-label">Gambar Saat Ini</label>
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $banner->image) }}" alt="Banner {{ $banner->order }}" class="h-32 w-auto rounded-lg border border-cyan-400 shadow-lg">
                    </div>
                </div>
                @endif

                <!-- Image Upload -->
                <div>
                    <label for="image" class="cyber-label">Gambar Banner Baru (Opsional)</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-600 border-dashed rounded-lg hover:border-cyan-400 transition-colors duration-200 bg-gray-800">
                        <div class="space-y-1 text-center">
                            <div id="image-preview" class="hidden">
                                <img id="preview-img" src="" alt="Preview" class="mx-auto h-32 w-auto rounded-lg shadow-lg">
                            </div>
                            <div id="upload-placeholder">
                                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                                <div class="flex text-sm text-gray-300">
                                    <label for="image" class="relative cursor-pointer rounded-md font-medium text-cyan-400 hover:text-cyan-300 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-cyan-400">
                                        <span>Upload gambar baru</span>
                                        <input id="image" name="image" type="file" accept="image/*" class="sr-only">
                                    </label>
                                    <p class="pl-1">atau drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF hingga 2MB</p>
                            </div>
                        </div>
                    </div>
                    @error('image')
                        <p class="cyber-error">{{ $message }}</p>
                    @enderror
                </div>



            <!-- Order -->
            <div>
                <label for="order" class="cyber-label">Urutan Tampil *</label>
                <input type="number" name="order" id="order" value="{{ old('order', $banner->order) }}" min="0" required
                    class="cyber-input @error('order') border-red-500 @enderror">
                <p class="mt-1 text-sm text-gray-400">Angka yang lebih kecil akan muncul terlebih dahulu</p>
                @error('order')
                    <p class="cyber-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div>
                <div class="flex items-center">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $banner->is_active) ? 'checked' : '' }}
                        class="cyber-checkbox">
                    <label for="is_active" class="ml-2 text-gray-300">
                        Banner aktif
                    </label>
                </div>
                <p class="mt-1 text-sm text-gray-400">Banner yang aktif akan ditampilkan di halaman utama</p>
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-700">
                <a href="{{ route('admin.banners.index') }}" class="cyber-btn-outline">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
                <button type="submit" class="cyber-btn-primary">
                    <i class="fas fa-save mr-2"></i>Update Banner
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('image-preview').classList.remove('hidden');
            document.getElementById('upload-placeholder').classList.add('hidden');
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endsection
