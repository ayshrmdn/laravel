@extends('layouts.admin')

@section('title', 'Manajemen User')

@section('content')
<div class="min-h-screen bg-black text-white p-4">
    <div class="max-w-7xl mx-auto">
        
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-cyan-400 to-purple-400 bg-clip-text text-transparent">
                    <i class="fas fa-users mr-3"></i>Manajemen User
                </h1>
                <p class="text-gray-400 mt-2">Kelola semua pengguna yang terdaftar di situs</p>
            </div>
            <a href="{{ route('admin.users.create') }}" class="cyber-btn-primary">
                <i class="fas fa-plus mr-2"></i>Tambah User
            </a>
        </div>

        <!-- Search and Filters -->
        <div class="cyber-card mb-8">
            <form method="GET" action="{{ route('admin.users.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="md:col-span-2">
                    <label class="cyber-label">Cari User</label>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Username, nama, email, atau telepon..." 
                           class="cyber-input">
                </div>
                
                <div>
                    <label class="cyber-label">Status</label>
                    <select name="status" class="cyber-select">
                        <option value="">Semua Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>
                
                <div class="md:col-span-3 flex justify-end space-x-2">
                    <button type="submit" class="cyber-btn-secondary">
                        <i class="fas fa-search mr-2"></i>Cari
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="cyber-btn-outline">Reset</a>
                </div>
            </form>
        </div>

        <!-- Users Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
            @forelse($users as $user)
                <div class="cyber-card group hover:scale-105 transition-all duration-300">
                    <!-- User Header -->
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-r from-cyan-400 to-purple-400 flex items-center justify-center text-black font-bold text-lg">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-white group-hover:text-cyan-400 transition-colors">
                                {{ $user->name }}
                            </h3>
                            <p class="text-sm text-gray-400">{{ $user->username }}</p>
                        </div>
                        
                        <!-- Status Badge -->
                        <span class="cyber-badge-{{ $user->is_online ? 'success' : 'warning' }}">
                            {{ $user->is_online ? 'Online' : 'Offline' }}
                        </span>
                    </div>

                    <!-- User Info -->
                    <div class="space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400">Email:</span>
                            <span class="text-cyan-400">{{ $user->email }}</span>
                        </div>
                        
                        @if($user->phone)
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400">Telepon:</span>
                            <span class="text-purple-400">{{ $user->phone }}</span>
                        </div>
                        @endif

                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400">Bergabung:</span>
                            <span class="text-yellow-400">{{ $user->created_at->format('d M Y') }}</span>
                        </div>

                        @if($user->last_seen_at)
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400">Terakhir Online:</span>
                            <span class="text-green-400">{{ $user->last_seen_at->diffForHumans() }}</span>
                        </div>
                        @endif
                    </div>

                    <!-- Actions -->
                    <div class="mt-4 pt-4 border-t border-gray-700 flex justify-between">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.users.show', $user) }}" 
                               class="cyber-btn-sm cyber-btn-outline" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.users.edit', $user) }}" 
                               class="cyber-btn-sm cyber-btn-secondary" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                        
                        <div class="flex space-x-2">
                            <!-- Delete -->
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" 
                                  onsubmit="return confirm('Yakin ingin menghapus user ini?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="cyber-btn-sm cyber-btn-danger" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="cyber-card text-center py-12">
                        <i class="fas fa-users text-6xl text-gray-600 mb-4"></i>
                        <h3 class="text-xl font-bold text-gray-400 mb-2">Belum Ada User</h3>
                        <p class="text-gray-500 mb-6">Mulai dengan menambahkan user pertama Anda.</p>
                        <a href="{{ route('admin.users.create') }}" class="cyber-btn-primary">
                            <i class="fas fa-plus mr-2"></i>Tambah User Pertama
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($users->hasPages())
            <div class="mt-8 flex justify-center">
                <div class="cyber-pagination">
                    {{ $users->appends(request()->query())->links() }}
                </div>
            </div>
        @endif
    </div>
</div>

<style>
/* Cyber Pagination */
.cyber-pagination nav {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
}

.cyber-pagination a,
.cyber-pagination span {
    padding: 8px 12px;
    border-radius: 8px;
    background: rgba(0, 255, 255, 0.1);
    border: 1px solid rgba(0, 255, 255, 0.2);
    color: #00FFFF;
    text-decoration: none;
    transition: all 0.3s ease;
    font-size: 14px;
    font-weight: 500;
}

.cyber-pagination a:hover {
    background: rgba(0, 255, 255, 0.2);
    border-color: rgba(0, 255, 255, 0.4);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 255, 255, 0.3);
}

.cyber-pagination .current {
    background: linear-gradient(135deg, #00FFFF, #8B00FF);
    color: black;
    font-weight: 600;
    box-shadow: 0 0 15px rgba(0, 255, 255, 0.5);
}

.cyber-pagination .disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.cyber-pagination .disabled:hover {
    background: rgba(0, 255, 255, 0.1);
    border-color: rgba(0, 255, 255, 0.2);
    transform: none;
    box-shadow: none;
}

/* Responsive Pagination */
@media (max-width: 640px) {
    .cyber-pagination nav {
        gap: 4px;
    }
    
    .cyber-pagination a,
    .cyber-pagination span {
        padding: 6px 8px;
        font-size: 12px;
    }
}
</style>

@endsection
