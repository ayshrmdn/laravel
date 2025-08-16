@extends('layouts.admin')

@section('title', 'Pengaturan Situs')
@section('subtitle', 'Kelola logo dan informasi dasar website')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white mb-2">Pengaturan Situs</h1>
            <p class="text-cyan-400">Kelola logo dan informasi dasar website</p>
        </div>
    </div>



    <form id="settings-form" action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')
        
        <!-- Logo Management Section -->
        <div class="cyber-card">
            <div class="cyber-section-title mb-4">
                <i class="fas fa-image mr-3"></i>
                Logo Situs
            </div>
            
            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Upload Section -->
                    <div class="space-y-4">
                        <div>
                            <label for="logo" class="block text-sm font-medium text-white mb-2">
                                Upload Logo Baru
                            </label>
                            <div class="relative">
                                <input type="file" 
                                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-gradient-to-r file:from-red-500 file:to-purple-600 file:text-white hover:file:from-red-600 hover:file:to-purple-700 file:cursor-pointer cyber-input @error('logo') border-red-300 @enderror" 
                                       id="logo" name="logo" accept="image/*">
                            </div>
                            <p class="mt-2 text-xs text-gray-500">Format: JPG, PNG, GIF, SVG (Maksimal: 2MB)</p>
                            @error('logo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Preview Upload -->
                        <div id="logo-preview" class="hidden">
                            <label class="block text-sm font-medium text-white mb-2">Preview Logo Baru</label>
                            <div class="border-2 border-dashed border-gray-200 rounded-lg p-6 bg-gray-50">
                                <img id="preview-image" src="" alt="Preview" class="max-h-24 mx-auto">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Current Logo -->
                    <div class="space-y-4">
                        <label class="block text-sm font-medium text-white">Logo Saat Ini</label>
                        <div class="border-2 border-dashed border-gray-200 rounded-lg p-6 bg-gray-50 flex items-center justify-center min-h-32">
                            @if($settings['logo'])
                                @if(str_starts_with($settings['logo'], 'images/'))
                                    <img src="{{ asset($settings['logo']) }}" alt="Current Logo" class="max-h-24">
                                @else
                                    <img src="{{ asset('storage/' . $settings['logo']) }}" alt="Current Logo" class="max-h-24">
                                @endif
                            @else
                                <div class="text-center">
                                    <i class="fas fa-image text-gray-400 text-3xl mb-2"></i>
                                    <p class="text-gray-500 text-sm">Belum ada logo</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Support Agent Image Management Section -->
        <div class="cyber-card">
            <div class="cyber-section-title mb-4">
                <i class="fas fa-headset mr-3"></i>
                Support Agent Image
            </div>
            
            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Upload Section -->
                    <div class="space-y-4">
                        <div>
                            <label for="support_agent_image" class="block text-sm font-medium text-white mb-2">
                                Upload Support Agent Image
                            </label>
                            <div class="relative">
                                <input type="file" 
                                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-gradient-to-r file:from-cyan-500 file:to-blue-600 file:text-white hover:file:from-cyan-600 hover:file:to-blue-700 file:cursor-pointer cyber-input @error('support_agent_image') border-red-300 @enderror" 
                                       id="support_agent_image" name="support_agent_image" accept="image/*">
                            </div>
                            <p class="mt-2 text-xs text-gray-500">Format: JPG, PNG, GIF (Maksimal: 2MB) - Recommended: 100x100px</p>
                            @error('support_agent_image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Preview Upload -->
                        <div id="support-agent-preview" class="hidden">
                            <label class="block text-sm font-medium text-white mb-2">Preview Support Agent Image</label>
                            <div class="border-2 border-dashed border-gray-200 rounded-lg p-6 bg-gray-50">
                                <img id="preview-support-agent" src="" alt="Preview" class="max-h-24 mx-auto rounded-full">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Current Support Agent Image -->
                    <div class="space-y-4">
                        <label class="block text-sm font-medium text-white">Support Agent Image Saat Ini</label>
                        <div class="border-2 border-dashed border-gray-200 rounded-lg p-6 bg-gray-50 flex items-center justify-center min-h-32">
                            @if($settings['support_agent_image'])
                                <img src="{{ asset('storage/' . $settings['support_agent_image']) }}" alt="Current Support Agent" class="max-h-24 rounded-full">
                            @else
                                <div class="text-center">
                                    <i class="fas fa-headset text-gray-400 text-3xl mb-2"></i>
                                    <p class="text-gray-500 text-sm">Belum ada support agent image</p>
                                    <p class="text-gray-400 text-xs">Akan menggunakan icon default</p>
                                </div>
                            @endif
                        </div>
                        
                        @if($settings['support_agent_image'])
                        <div class="flex justify-center">
                            <button type="button" onclick="deleteSupportAgentImage()" class="cyber-btn-outline text-sm">
                                <i class="fas fa-trash mr-2"></i>Hapus Support Agent Image
                            </button>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- GIF Banner Management Section -->
                    <div class="cyber-card">
            <div class="cyber-section-title mb-4">
                <i class="fas fa-film mr-3"></i>
                GIF Banner Horizontal
            </div>
            
            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Upload Section -->
                    <div class="space-y-4">
                        <div>
                            <label for="gif_banner" class="block text-sm font-medium text-white mb-2">
                                Upload GIF Banner Baru
                            </label>
                            <div class="relative">
                                <input type="file" 
                                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-gradient-to-r file:from-purple-500 file:to-pink-600 file:text-white hover:file:from-purple-600 hover:file:to-pink-700 file:cursor-pointer cyber-input @error('gif_banner') border-red-300 @enderror" 
                                       id="gif_banner" name="gif_banner" accept=".gif">
                            </div>
                            <p class="mt-2 text-xs text-gray-500">Format: GIF only (Maksimal: 10MB)</p>
                            @error('gif_banner')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Preview Upload -->
                        <div id="gif-preview" class="hidden">
                            <label class="block text-sm font-medium text-white mb-2">Preview GIF Baru</label>
                            <div class="border-2 border-dashed border-gray-200 rounded-lg p-6 bg-gray-50">
                                <img id="preview-gif" src="" alt="Preview GIF" class="max-h-32 mx-auto">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Current GIF Banner -->
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <label class="block text-sm font-medium text-white">GIF Banner Saat Ini</label>
                            @if($settings['gif_banner'])
                                <button onclick="deleteGifBanner()" class="text-red-400 hover:text-red-300 text-sm">
                                    <i class="fas fa-trash mr-1"></i>Hapus
                                </button>
                            @endif
                        </div>
                        <div class="border-2 border-dashed border-gray-200 rounded-lg p-6 bg-gray-50 flex items-center justify-center min-h-32">
                            @if($settings['gif_banner'])
                                <img src="{{ asset('storage/' . $settings['gif_banner']) }}" alt="Current GIF Banner" class="max-h-32 rounded-lg">
                            @else
                                <div class="text-center">
                                    <i class="fas fa-film text-gray-400 text-3xl mb-2"></i>
                                    <p class="text-gray-500 text-sm">Belum ada GIF banner</p>
                                    <p class="text-gray-400 text-xs mt-1">GIF akan tampil di bawah kategori slide</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Promo Quick Upload Section -->
        <div class="cyber-card">
            <div class="cyber-section-title mb-4">
                <i class="fas fa-fire mr-3"></i>
                Promo Situs
            </div>
            <div class="p-6 space-y-6">
                <div class="flex items-center justify-between">
                    <p class="text-gray-300 text-sm">Kelola promo situs, upload gambar dan deskripsi singkat.</p>
                    <a href="{{ route('admin.promos.index') }}" class="text-cyan-400 hover:text-cyan-300 text-sm"><i class="fas fa-external-link-alt mr-1"></i>Kelola Promo</a>
                </div>
                <form action="{{ route('admin.promos.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    @csrf
                    <div class="lg:col-span-2 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-white mb-2">Gambar Promo</label>
                            <input type="file" name="image" accept="image/*" class="block w-full cyber-input @error('image') border-red-300 @enderror" required>
                            @error('image')<p class="text-sm text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-white mb-2">Deskripsi Promo</label>
                            <textarea name="description" rows="3" class="block w-full cyber-input" placeholder="Masukkan deskripsi singkat promo"></textarea>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-white mb-2">Urutan</label>
                                <input type="number" name="sort_order" value="0" min="0" class="block w-full cyber-input">
                            </div>
                            <div class="flex items-center mt-6">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="is_visible" value="1" checked class="form-checkbox text-cyan-500">
                                    <span class="ml-2 text-white">Tampilkan</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-1 flex items-end">
                        <button type="submit" class="w-full px-6 py-3 bg-gradient-to-r from-cyan-500 to-purple-600 text-white font-medium rounded-lg hover:from-cyan-600 hover:to-purple-700">
                            <i class="fas fa-upload mr-2"></i>Upload Promo
                        </button>
                    </div>
                </form>
            </div>

                <div class="pt-4">
                    <h3 class="text-white font-semibold mb-4">Daftar Promo</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($promos as $promo)
                        <div class="border border-cyan-500/30 rounded-lg overflow-hidden bg-gradient-to-br from-gray-900/90 to-gray-800/80">
                            <img src="{{ asset('storage/' . $promo->image_path) }}" class="w-full h-40 object-cover" alt="Promo">
                            <div class="p-4 space-y-3">
                                <p class="text-sm text-gray-300 min-h-[48px]">{{ $promo->description }}</p>
                                <div class="flex items-center justify-between text-xs text-gray-400">
                                    <span>Urutan: {{ $promo->sort_order }}</span>
                                    <span>Status: <span class="{{ $promo->is_visible ? 'text-green-400' : 'text-red-400' }}">{{ $promo->is_visible ? 'Tampil' : 'Tersembunyi' }}</span></span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <form action="{{ route('admin.promos.update', $promo) }}" method="POST" enctype="multipart/form-data" class="flex-1 space-y-2">
                                        @csrf
                                        @method('PUT')
                                        <input type="file" name="image" accept="image/*" class="block w-full cyber-input text-xs">
                                        <textarea name="description" rows="2" class="block w-full cyber-input text-xs" placeholder="Ubah deskripsi">{{ $promo->description }}</textarea>
                                        <div class="grid grid-cols-2 gap-2">
                                            <input type="number" name="sort_order" value="{{ $promo->sort_order }}" min="0" class="block w-full cyber-input text-xs">
                                            <label class="inline-flex items-center justify-center border border-cyan-500/30 rounded-lg">
                                                <input type="checkbox" name="is_visible" value="1" {{ $promo->is_visible ? 'checked' : '' }} class="form-checkbox text-cyan-500">
                                                <span class="ml-2 text-white">Tampilkan</span>
                                            </label>
                                        </div>
                                        <div class="flex gap-2">
                                            <button type="submit" class="px-3 py-2 bg-gradient-to-r from-cyan-500 to-purple-600 text-white text-xs rounded">
                                                <i class="fas fa-save mr-1"></i>Simpan
                                            </button>
                                            <a href="{{ route('admin.promos.toggle-visibility', $promo) }}" onclick="event.preventDefault(); document.getElementById('toggle-{{ $promo->id }}').submit();" class="px-3 py-2 bg-gray-700 text-white text-xs rounded">
                                                {{ $promo->is_visible ? 'Sembunyikan' : 'Tampilkan' }}
                                            </a>
                                        </div>
                                    </form>
                                    <form action="{{ route('admin.promos.destroy', $promo) }}" method="POST" onsubmit="return confirm('Hapus promo ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="px-3 py-2 bg-red-600 text-white text-xs rounded hover:bg-red-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    <form id="toggle-{{ $promo->id }}" action="{{ route('admin.promos.toggle-visibility', $promo) }}" method="POST" class="hidden">
                                        @csrf
                                        @method('PATCH')
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-span-full text-center text-gray-400">Belum ada promo yang diupload.</div>
                        @endforelse
                    </div>
                    <div class="mt-4">{{ $promos->links() }}</div>
                </div>

        <!-- Site Information Section -->
        <div class="cyber-card overflow-hidden">
            <div class="px-6 py-4 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-gray-200">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-info-circle text-white text-sm"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-white">Informasi Situs</h3>
                </div>
            </div>
            
            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <label for="site_name" class="block text-sm font-medium text-white mb-2">
                            Nama Situs
                        </label>
                        <input type="text" 
                               class="block w-full px-4 py-3 cyber-input shadow-sm focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors @error('site_name') border-red-300 @enderror" 
                               id="site_name" name="site_name" 
                               value="{{ old('site_name', $settings['site_name']) }}"
                               placeholder="Masukkan nama situs">
                        @error('site_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="site_description" class="block text-sm font-medium text-white mb-2">
                            Deskripsi Situs
                        </label>
                        <input type="text" 
                               class="block w-full px-4 py-3 cyber-input shadow-sm focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors @error('site_description') border-red-300 @enderror" 
                               id="site_description" name="site_description" 
                               value="{{ old('site_description', $settings['site_description']) }}"
                               placeholder="Masukkan deskripsi situs">
                        @error('site_description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-between cyber-card p-6">
            <div class="text-sm text-gray-500">
                <i class="fas fa-info-circle mr-1"></i>
                Pastikan untuk menyimpan perubahan setelah mengedit
            </div>
            <div class="flex items-center space-x-3">
                <button type="reset" class="px-6 py-3 cyber-input text-white font-medium hover:bg-gray-50 focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                    <i class="fas fa-undo mr-2"></i>Reset
                </button>
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-red-500 to-purple-600 text-white font-medium rounded-lg hover:from-red-600 hover:to-purple-700 focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors shadow-sm">
                    <i class="fas fa-save mr-2"></i>Simpan Pengaturan
                </button>
            </div>
        </div>
</div>

@push('scripts')
<script>
    // Preview uploaded logo with modern UI
    document.getElementById('logo').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const previewContainer = document.getElementById('logo-preview');
        const previewImage = document.getElementById('preview-image');
        
        if (file) {
            // Validate file size (2MB max)
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran file terlalu besar. Maksimal 2MB.');
                this.value = '';
                previewContainer.classList.add('hidden');
                return;
            }
            
            // Validate file type
            const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml'];
            if (!allowedTypes.includes(file.type)) {
                alert('Format file tidak didukung. Gunakan JPG, PNG, GIF, atau SVG.');
                this.value = '';
                previewContainer.classList.add('hidden');
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.classList.remove('hidden');
                
                // Add smooth fade-in animation
                previewContainer.style.opacity = '0';
                setTimeout(() => {
                    previewContainer.style.transition = 'opacity 0.3s ease-in-out';
                    previewContainer.style.opacity = '1';
                }, 10);
            }
            reader.readAsDataURL(file);
        } else {
            previewContainer.classList.add('hidden');
        }
    });

    // Reset form with smooth animation
    document.querySelector('button[type="reset"]').addEventListener('click', function(e) {
        e.preventDefault();
        
        // Show confirmation
        if (confirm('Apakah Anda yakin ingin mereset semua perubahan?')) {
            const previewContainer = document.getElementById('logo-preview');
            const form = this.closest('form');
            
            // Hide preview with animation
            previewContainer.style.transition = 'opacity 0.3s ease-in-out';
            previewContainer.style.opacity = '0';
            
            setTimeout(() => {
                previewContainer.classList.add('hidden');
                form.reset();
            }, 300);
        }
    });

    // Add loading state to submit button (only for main settings form)
    const settingsForm = document.getElementById('settings-form');
    if (settingsForm) {
        settingsForm.addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                const originalText = submitBtn.innerHTML;
                
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';
                
                // Re-enable after 5 seconds as fallback
                setTimeout(() => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                }, 5000);
            }
        });
    }

    // Preview uploaded GIF with modern UI
    document.getElementById('gif_banner').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const previewContainer = document.getElementById('gif-preview');
        const previewGif = document.getElementById('preview-gif');
        
        if (file) {
            // Validate file size (10MB max)
            if (file.size > 10 * 1024 * 1024) {
                alert('Ukuran file terlalu besar. Maksimal 10MB.');
                this.value = '';
                previewContainer.classList.add('hidden');
                return;
            }
            
            // Validate file type (GIF only)
            if (file.type !== 'image/gif') {
                alert('Format file tidak didukung. Gunakan GIF only.');
                this.value = '';
                previewContainer.classList.add('hidden');
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                previewGif.src = e.target.result;
                previewContainer.classList.remove('hidden');
                
                // Add smooth fade-in animation
                previewContainer.style.opacity = '0';
                setTimeout(() => {
                    previewContainer.style.transition = 'opacity 0.3s ease-in-out';
                    previewContainer.style.opacity = '1';
                }, 10);
            }
            reader.readAsDataURL(file);
        } else {
            previewContainer.classList.add('hidden');
        }
    });

    // Preview support agent image
    document.getElementById('support_agent_image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const previewContainer = document.getElementById('support-agent-preview');
        const previewImage = document.getElementById('preview-support-agent');
        
        if (file) {
            // Validate file size (2MB max)
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran file terlalu besar. Maksimal 2MB.');
                this.value = '';
                previewContainer.classList.add('hidden');
                return;
            }
            
            // Validate file type (images only)
            if (!file.type.startsWith('image/')) {
                alert('Format file tidak didukung. Gunakan gambar (JPG, PNG, GIF).');
                this.value = '';
                previewContainer.classList.add('hidden');
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.classList.remove('hidden');
                
                // Add smooth fade-in animation
                previewContainer.style.opacity = '0';
                setTimeout(() => {
                    previewContainer.style.transition = 'opacity 0.3s ease-in-out';
                    previewContainer.style.opacity = '1';
                }, 10);
            }
            reader.readAsDataURL(file);
        } else {
            previewContainer.classList.add('hidden');
        }
    });

    // Delete Support Agent Image function
    function deleteSupportAgentImage() {
        if (confirm('Yakin ingin menghapus Support Agent Image?')) {
            fetch('{{ route("admin.settings.support-agent.delete") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Reload page to show updated state
                    location.reload();
                } else {
                    alert('Gagal menghapus Support Agent Image: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menghapus Support Agent Image');
            });
        }
    }

    // Delete GIF Banner function
    function deleteGifBanner() {
        if (confirm('Yakin ingin menghapus GIF banner?')) {
            fetch('{{ route("admin.settings.gif-banner.delete") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success || response.ok) {
                    alert('GIF Banner berhasil dihapus!');
                    window.location.reload();
                } else {
                    alert('Gagal menghapus GIF Banner!');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menghapus GIF Banner!');
            });
        }
    }
</script>
@endpush
@endsection
