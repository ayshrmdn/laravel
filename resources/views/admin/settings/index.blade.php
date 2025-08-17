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
    </form>

    <!-- Payment Methods Management (outside main form) -->
    <div class="cyber-card p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="cyber-section-title">
                <i class="fas fa-building-columns mr-3"></i>
                Metode Pembayaran
            </div>
            <a href="{{ route('admin.payment-methods.index') }}" class="cyber-btn-secondary">
                <i class="fas fa-external-link-alt mr-2"></i>Halaman Lengkap
            </a>
        </div>
        <form action="{{ route('admin.payment-methods.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            @csrf
            <div class="lg:col-span-2 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-white mb-2">Icon Bank/E-Wallet</label>
                    <input type="file" name="icon" accept="image/*" class="block w-full cyber-input @error('icon') border-red-300 @enderror" required>
                    <p class="text-xs text-gray-500 mt-1">PNG/JPG/WEBP/SVG (maks 4MB). Disarankan ukuran 120x120.</p>
                    @error('icon')<p class="text-sm text-red-500 mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-white mb-2">Nama (opsional)</label>
                        <input type="text" name="name" class="block w-full cyber-input" placeholder="BCA, BNI, Dana, dll">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-white mb-2">Urutan</label>
                        <input type="number" name="sort_order" value="0" min="0" class="block w-full cyber-input">
                    </div>
                    <div class="pt-6">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="is_online" value="1" checked class="form-checkbox text-emerald-500">
                            <span class="ml-2 text-white">Status Online</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-1 flex items-end">
                <button type="submit" class="w-full px-6 py-3 bg-gradient-to-r from-cyan-500 to-purple-600 text-white font-medium rounded-lg hover:from-cyan-600 hover:to-purple-700">
                    <i class="fas fa-upload mr-2"></i>Tambah Ikon
                </button>
            </div>
        </form>

        <div class="mt-6 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
            @foreach(($paymentMethods ?? []) as $method)
            <div class="border border-cyan-500/30 rounded-lg p-4 bg-gradient-to-br from-gray-900/80 to-gray-800/60 text-center">
                <div class="relative">
                    <img src="{{ asset('storage/' . $method->icon_path) }}" class="mx-auto h-12 object-contain {{ $method->is_online ? '' : 'opacity-60 grayscale' }}" alt="{{ $method->name }}">
                    <span class="absolute -top-1 -right-1 w-3 h-3 rounded-full {{ $method->is_online ? 'bg-green-400' : 'bg-red-500' }}"></span>
                </div>
                <div class="text-xs text-gray-300 mt-2 truncate flex items-center justify-center gap-2">
                    <span class="inline-flex items-center text-[10px] font-mono {{ $method->is_online ? 'text-green-400' : 'text-red-400' }}">
                        <span class="w-2 h-2 rounded-full mr-1 {{ $method->is_online ? 'bg-green-400' : 'bg-red-500' }}"></span>
                        {{ $method->is_online ? 'ONLINE' : 'OFFLINE' }}
                    </span>
                    <span class="text-gray-400">•</span>
                    <span>{{ $method->name ?: 'Tanpa Nama' }}</span>
                </div>
                <div class="flex items-center justify-center gap-2 mt-3">
                    <form action="{{ route('admin.payment-methods.update', $method) }}" method="POST" enctype="multipart/form-data" class="flex-1">
                        @csrf
                        @method('PUT')
                        <input type="file" name="icon" accept="image/*" class="block w-full text-xs text-gray-300">
                        <input type="text" name="name" value="{{ $method->name }}" class="block w-full cyber-input text-xs mt-2" placeholder="Nama">
                        <div class="grid grid-cols-2 gap-2 mt-2">
                            <input type="number" name="sort_order" value="{{ $method->sort_order }}" class="cyber-input text-xs" min="0">
                            <label class="inline-flex items-center justify-center border border-cyan-500/30 rounded-lg">
                                <input type="checkbox" name="is_online" value="1" {{ $method->is_online ? 'checked' : '' }} class="form-checkbox text-emerald-500">
                                <span class="ml-2 text-white">Online</span>
                            </label>
                            <label class="inline-flex items-center justify-center border border-cyan-500/30 rounded-lg">
                                <input type="checkbox" name="is_active" value="1" {{ $method->is_active ? 'checked' : '' }} class="form-checkbox text-cyan-500">
                                <span class="ml-2 text-white">Tampil</span>
                            </label>
                        </div>
                        <button type="submit" class="w-full mt-2 px-3 py-2 bg-gradient-to-r from-cyan-500 to-purple-600 text-white text-xs rounded">
                            <i class="fas fa-save mr-1"></i>Simpan
                        </button>
                    </form>
                    <form action="{{ route('admin.payment-methods.destroy', $method) }}" method="POST" onsubmit="return confirm('Hapus ikon ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="px-3 py-2 bg-red-600 text-white text-xs rounded hover:bg-red-700">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
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
