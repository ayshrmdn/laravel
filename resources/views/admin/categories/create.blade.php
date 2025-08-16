@extends('layouts.admin')

@section('title', 'Tambah Kategori')

@section('content')
<div class="min-h-screen bg-black text-white p-4">
    <div class="max-w-4xl mx-auto">
        
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center space-x-4 mb-4">
                <a href="{{ route('admin.categories.index') }}" class="cyber-btn-outline">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-cyan-400 to-purple-400 bg-clip-text text-transparent">
                    <i class="fas fa-plus-circle mr-3"></i>Tambah Kategori Baru
                </h1>
            </div>
            <p class="text-gray-400">Tambahkan kategori game baru dengan icon dan warna kustom</p>
        </div>

        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                <!-- Left Column - Basic Info -->
                <div class="cyber-card">
                    <h2 class="text-xl font-bold text-cyan-400 mb-6">
                        <i class="fas fa-info-circle mr-2"></i>Informasi Dasar
                    </h2>
                    
                    <div class="space-y-6">
                        <!-- Category Name -->
                        <div>
                            <label class="cyber-label">Nama Kategori *</label>
                            <input type="text" name="name" value="{{ old('name') }}" required 
                                   class="cyber-input @error('name') border-red-500 @enderror" 
                                   placeholder="Masukkan nama kategori">
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
                                <span class="text-gray-300">Kategori aktif</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Visual Settings -->
                <div class="cyber-card">
                    <h2 class="text-xl font-bold text-purple-400 mb-6">
                        <i class="fas fa-palette mr-2"></i>Pengaturan Visual
                    </h2>
                    
                    <div class="space-y-6">
                        <!-- Icon -->
                        <div>
                            <label class="cyber-label">Icon (FontAwesome) *</label>
                            <div class="flex items-center space-x-3">
                                <input type="text" name="icon" value="{{ old('icon', 'fas fa-gamepad') }}" required 
                                       class="cyber-input flex-1 @error('icon') border-red-500 @enderror" 
                                       placeholder="fas fa-gamepad"
                                       id="icon-input"
                                       onchange="updateIconPreview()">
                                <div class="w-12 h-12 bg-gray-800 rounded-lg flex items-center justify-center">
                                    <i id="icon-preview" class="fas fa-gamepad text-xl text-cyan-400"></i>
                                </div>
                            </div>
                            @error('icon')
                                <p class="cyber-error">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-gray-500 mt-1">Gunakan class FontAwesome, contoh: fas fa-gamepad</p>
                        </div>

                        <!-- Color -->
                        <div>
                            <label class="cyber-label">Warna Tema *</label>
                            <div class="flex items-center space-x-3">
                                <input type="color" name="color" value="{{ old('color', '#00FFFF') }}" required 
                                       class="w-16 h-12 border-2 border-gray-600 rounded-lg bg-transparent @error('color') border-red-500 @enderror"
                                       id="color-input"
                                       onchange="updateColorPreview()">
                                <input type="text" value="{{ old('color', '#00FFFF') }}" 
                                       class="cyber-input flex-1"
                                       id="color-text"
                                       onchange="updateColorFromText()"
                                       placeholder="#00FFFF">
                            </div>
                            @error('color')
                                <p class="cyber-error">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-gray-500 mt-1">Pilih warna yang akan digunakan untuk tema kategori</p>
                        </div>

                        <!-- Preview -->
                        <div>
                            <label class="cyber-label">Preview Kategori</label>
                            <div class="bg-gray-800 rounded-lg p-6">
                                <div class="text-center">
                                    <div id="preview-bg" class="w-24 h-24 mx-auto rounded-lg flex items-center justify-center mb-3" 
                                         style="background: linear-gradient(135deg, #00FFFF22 0%, #00FFFF44 100%);">
                                        <i id="preview-icon" class="fas fa-gamepad text-3xl" style="color: #00FFFF;"></i>
                                    </div>
                                    <div id="preview-name" class="text-white font-bold">Nama Kategori</div>
                                    <div class="w-8 h-1 mx-auto mt-2 rounded" id="preview-line" style="background-color: #00FFFF;"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Popular Color Choices -->
                        <div>
                            <label class="cyber-label">Warna Populer</label>
                            <div class="grid grid-cols-6 gap-2">
                                <button type="button" onclick="setColor('#00FFFF')" 
                                        class="w-8 h-8 rounded border-2 border-gray-600 hover:border-white transition-colors" 
                                        style="background-color: #00FFFF;" title="Cyan"></button>
                                <button type="button" onclick="setColor('#FF0080')" 
                                        class="w-8 h-8 rounded border-2 border-gray-600 hover:border-white transition-colors" 
                                        style="background-color: #FF0080;" title="Pink"></button>
                                <button type="button" onclick="setColor('#8B00FF')" 
                                        class="w-8 h-8 rounded border-2 border-gray-600 hover:border-white transition-colors" 
                                        style="background-color: #8B00FF;" title="Purple"></button>
                                <button type="button" onclick="setColor('#FFD700')" 
                                        class="w-8 h-8 rounded border-2 border-gray-600 hover:border-white transition-colors" 
                                        style="background-color: #FFD700;" title="Gold"></button>
                                <button type="button" onclick="setColor('#FF6B35')" 
                                        class="w-8 h-8 rounded border-2 border-gray-600 hover:border-white transition-colors" 
                                        style="background-color: #FF6B35;" title="Orange"></button>
                                <button type="button" onclick="setColor('#00FF41')" 
                                        class="w-8 h-8 rounded border-2 border-gray-600 hover:border-white transition-colors" 
                                        style="background-color: #00FF41;" title="Green"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Image Upload Section -->
            <div class="cyber-card">
                <h2 class="text-xl font-bold text-green-400 mb-6">
                    <i class="fas fa-image mr-2"></i>Gambar Kategori (Opsional)
                </h2>
                
                <div>
                    <label class="cyber-label">Upload Gambar Banner</label>
                    <div class="border-2 border-dashed border-gray-600 rounded-lg p-6 text-center hover:border-green-400 transition-colors">
                        <input type="file" name="image" accept="image/*" id="image-upload" class="hidden" 
                               onchange="previewImage(this, 'image-preview')">
                        <label for="image-upload" class="cursor-pointer">
                            <div id="image-preview" class="mb-4">
                                <i class="fas fa-image text-4xl text-gray-500 mb-2"></i>
                                <p class="text-gray-400">Klik untuk upload gambar (opsional)</p>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF, SVG (Max: 2MB)</p>
                            </div>
                        </label>
                    </div>
                    @error('image')
                        <p class="cyber-error">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500 mt-1">Jika tidak di-upload, icon dan warna akan digunakan sebagai tampilan</p>
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
                        <a href="{{ route('admin.categories.index') }}" class="cyber-btn-outline">
                            <i class="fas fa-times mr-2"></i>Batal
                        </a>
                        <button type="submit" class="cyber-btn-primary">
                            <i class="fas fa-save mr-2"></i>Simpan Kategori
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function updateIconPreview() {
    const iconInput = document.getElementById('icon-input');
    const iconPreview = document.getElementById('icon-preview');
    const previewIcon = document.getElementById('preview-icon');
    
    iconPreview.className = iconInput.value + ' text-xl text-cyan-400';
    previewIcon.className = iconInput.value + ' text-3xl';
}

function updateColorPreview() {
    const colorInput = document.getElementById('color-input');
    const colorText = document.getElementById('color-text');
    const previewBg = document.getElementById('preview-bg');
    const previewIcon = document.getElementById('preview-icon');
    const previewLine = document.getElementById('preview-line');
    
    const color = colorInput.value;
    colorText.value = color;
    
    previewBg.style.background = `linear-gradient(135deg, ${color}22 0%, ${color}44 100%)`;
    previewIcon.style.color = color;
    previewLine.style.backgroundColor = color;
}

function updateColorFromText() {
    const colorInput = document.getElementById('color-input');
    const colorText = document.getElementById('color-text');
    
    colorInput.value = colorText.value;
    updateColorPreview();
}

function setColor(color) {
    const colorInput = document.getElementById('color-input');
    const colorText = document.getElementById('color-text');
    
    colorInput.value = color;
    colorText.value = color;
    updateColorPreview();
}

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

// Update preview when name changes
document.querySelector('input[name="name"]').addEventListener('input', function(e) {
    document.getElementById('preview-name').textContent = e.target.value || 'Nama Kategori';
});

// Initialize preview
updateIconPreview();
updateColorPreview();
</script>
@endsection
