@extends('layouts.admin')

@section('title', 'Manajemen Banner')
@section('subtitle', 'Kelola banner slider di halaman utama')

@section('content')
<div class="min-h-screen bg-black text-white p-4">
    <div class="max-w-7xl mx-auto">
        
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-cyan-400 to-purple-400 bg-clip-text text-transparent">
                    <i class="fas fa-images mr-3"></i>Manajemen Banner
                </h1>
                <p class="text-gray-400 mt-2">Kelola banner slider di halaman utama situs</p>
            </div>
            <a href="{{ route('admin.banners.create') }}" class="cyber-btn-primary">
                <i class="fas fa-plus mr-2"></i>Tambah Banner
            </a>
        </div>

        <!-- Banners Table -->
        <div class="cyber-card p-0 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-700">
                    <thead>
                        <tr class="border-b border-gray-700">
                            <th class="px-6 py-3 text-left text-xs font-medium text-cyan-400 uppercase tracking-wider">Preview</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-cyan-400 uppercase tracking-wider">Urutan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-cyan-400 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-cyan-400 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @forelse($banners as $banner)
                        <tr class="hover:bg-gray-800 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($banner->image)
                            <img src="{{ asset('storage/' . $banner->image) }}" alt="Banner {{ $banner->order }}" class="w-24 h-16 object-cover rounded-lg border border-cyan-400 shadow-lg">
                            @else
                            <div class="w-24 h-16 bg-gray-800 border border-gray-600 rounded-lg flex items-center justify-center">
                                <i class="fas fa-image text-gray-600"></i>
                            </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="cyber-badge-success">
                                {{ $banner->order }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($banner->is_active)
                                <span class="cyber-badge-success">
                                    <i class="fas fa-check mr-1"></i>Aktif
                                </span>
                            @else
                                <span class="cyber-badge-danger">
                                    <i class="fas fa-times mr-1"></i>Nonaktif
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('admin.banners.show', $banner) }}" class="cyber-btn-sm cyber-btn-outline" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.banners.edit', $banner) }}" class="cyber-btn-sm cyber-btn-secondary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <!-- Toggle Status -->
                                <form method="POST" action="{{ route('admin.banners.toggle-status', $banner) }}" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="cyber-btn-sm {{ $banner->is_active ? 'cyber-btn-warning' : 'cyber-btn-success' }}" title="{{ $banner->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                        <i class="fas {{ $banner->is_active ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
                                    </button>
                                </form>
                                
                                <!-- Delete -->
                                <form method="POST" action="{{ route('admin.banners.destroy', $banner) }}" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus banner ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="cyber-btn-sm cyber-btn-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-gray-400">
                            <div class="flex flex-col items-center">
                                <i class="fas fa-image text-6xl mb-4 text-gray-600"></i>
                                <p class="text-xl font-bold text-gray-400 mb-2">Belum Ada Banner</p>
                                <p class="text-gray-500 mb-6">Klik tombol "Tambah Banner" untuk menambahkan banner pertama</p>
                                <a href="{{ route('admin.banners.create') }}" class="cyber-btn-primary">
                                    <i class="fas fa-plus mr-2"></i>Tambah Banner Pertama
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($banners->hasPages())
            <div class="mt-8 flex justify-center">
                <div class="cyber-pagination">
                    {{ $banners->appends(request()->query())->links() }}
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
