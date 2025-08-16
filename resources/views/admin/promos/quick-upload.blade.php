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
</div>