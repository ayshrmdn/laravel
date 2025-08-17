@extends('layouts.admin')

@section('title', 'Metode Pembayaran')
@section('subtitle', 'Kelola ikon bank/e-wallet yang tampil di halaman utama')

@section('content')
<div class="space-y-6">
    <div class="cyber-card p-6">
        <form action="{{ route('admin.payment-methods.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            @csrf
            <div class="lg:col-span-2 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-white mb-2">Icon Bank/E-Wallet</label>
                    <input type="file" name="icon" accept="image/*" class="block w-full cyber-input @error('icon') border-red-300 @enderror" required>
                    <p class="text-xs text-gray-500 mt-1">PNG/JPG/WEBP/SVG (maks 4MB). Direkomendasikan ukuran 120x120.</p>
                    @error('icon')<p class="text-sm text-red-500 mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-white mb-2">Nama (opsional)</label>
                        <input type="text" name="name" class="block w-full cyber-input" placeholder="BCA, BNI, Dana, dll">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-white mb-2">Urutan</label>
                        <input type="number" name="sort_order" value="0" min="0" class="block w-full cyber-input">
                    </div>
                </div>
            </div>
            <div class="lg:col-span-1 flex items-end sm:items-start">
                <button type="submit" class="w-full px-6 py-3 bg-gradient-to-r from-cyan-500 to-purple-600 text-white font-medium rounded-lg hover:from-cyan-600 hover:to-purple-700">
                    <i class="fas fa-upload mr-2"></i>Tambah Ikon
                </button>
            </div>
        </form>
    </div>

    <div class="cyber-card p-6">
        <h2 class="text-lg font-semibold text-white mb-4">Daftar Metode Pembayaran</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 xl:grid-cols-6 gap-5">
            @foreach($methods as $method)
            <div class="border border-cyan-500/30 rounded-xl p-4 bg-gradient-to-br from-gray-900/80 to-gray-800/60 text-center flex flex-col">
                <img src="{{ asset('storage/' . $method->icon_path) }}" class="mx-auto h-12 object-contain" alt="{{ $method->name }}">
                <div class="text-xs text-gray-300 mt-2 truncate flex items-center justify-center gap-2">
                    <span class="inline-flex items-center text-[10px] font-mono {{ $method->is_online ? 'text-green-400' : 'text-red-400' }}">
                        <span class="w-2 h-2 rounded-full mr-1 {{ $method->is_online ? 'bg-green-400' : 'bg-red-500' }}"></span>
                        {{ $method->is_online ? 'ONLINE' : 'OFFLINE' }}
                    </span>
                    <span class="text-gray-400">•</span>
                    <span>{{ $method->name ?: 'Tanpa Nama' }}</span>
                </div>
                <div class="mt-3 space-y-2">
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
                     <form action="{{ route('admin.payment-methods.destroy', $method) }}" method="POST" onsubmit="return confirm('Hapus ikon ini?')" class="flex justify-center">
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
        <div class="mt-4">{{ $methods->links() }}</div>
    </div>
</div>
@endsection