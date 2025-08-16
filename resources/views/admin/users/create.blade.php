@extends('layouts.admin')

@section('title', 'Tambah User')

@section('content')
<div class="min-h-screen bg-black text-white p-4">
    <div class="max-w-4xl mx-auto">
        
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center space-x-4 mb-4">
                <a href="{{ route('admin.users.index') }}" class="cyber-btn-outline">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-cyan-400 to-purple-400 bg-clip-text text-transparent">
                    <i class="fas fa-user-plus mr-3"></i>Tambah User Baru
                </h1>
            </div>
            <p class="text-gray-400">Buat akun pengguna baru untuk sistem</p>
        </div>

        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-8">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                <!-- Left Column - Basic Info -->
                <div class="cyber-card">
                    <h2 class="text-xl font-bold text-cyan-400 mb-6">
                        <i class="fas fa-info-circle mr-2"></i>Informasi Dasar
                    </h2>
                    
                    <div class="space-y-6">
                        <!-- Name -->
                        <div>
                            <label class="cyber-label">Nama Lengkap *</label>
                            <input type="text" name="full_name" value="{{ old('full_name') }}" required 
                                   class="cyber-input @error('full_name') border-red-500 @enderror" 
                                   placeholder="Masukkan nama lengkap">
                            @error('full_name')
                                <p class="cyber-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Username -->
                        <div>
                            <label class="cyber-label">Username *</label>
                            <input type="text" name="username" value="{{ old('username') }}" required 
                                   class="cyber-input @error('username') border-red-500 @enderror" 
                                   placeholder="Masukkan username">
                            @error('username')
                                <p class="cyber-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="cyber-label">Email *</label>
                            <input type="email" name="email" value="{{ old('email') }}" required 
                                   class="cyber-input @error('email') border-red-500 @enderror" 
                                   placeholder="Masukkan email">
                            @error('email')
                                <p class="cyber-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div>
                            <label class="cyber-label">Nomor Telepon</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" 
                                   class="cyber-input @error('phone') border-red-500 @enderror" 
                                   placeholder="Masukkan nomor telepon">
                            @error('phone')
                                <p class="cyber-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Right Column - Security -->
                <div class="cyber-card">
                    <h2 class="text-xl font-bold text-purple-400 mb-6">
                        <i class="fas fa-lock mr-2"></i>Keamanan
                    </h2>
                    
                    <div class="space-y-6">
                        <!-- Password -->
                        <div>
                            <label class="cyber-label">Password *</label>
                            <input type="password" name="password" required 
                                   class="cyber-input @error('password') border-red-500 @enderror" 
                                   placeholder="Masukkan password">
                            @error('password')
                                <p class="cyber-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password Confirmation -->
                        <div>
                            <label class="cyber-label">Konfirmasi Password *</label>
                            <input type="password" name="password_confirmation" required 
                                   class="cyber-input @error('password_confirmation') border-red-500 @enderror" 
                                   placeholder="Ulangi password">
                            @error('password_confirmation')
                                <p class="cyber-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="cyber-label">Status Akun</label>
                            <div class="flex items-center space-x-3">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }}
                                       class="cyber-checkbox">
                                <span class="text-gray-300">Akun aktif</span>
                            </div>
                        </div>

                        <!-- Email Verified -->
                        <div>
                            <label class="cyber-label">Verifikasi Email</label>
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" name="email_verified" value="1" {{ old('email_verified', 1) ? 'checked' : '' }}
                                       class="cyber-checkbox">
                                <span class="text-gray-300">Email sudah terverifikasi</span>
                            </div>
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
                        <a href="{{ route('admin.users.index') }}" class="cyber-btn-outline">
                            <i class="fas fa-times mr-2"></i>Batal
                        </a>
                        <button type="submit" class="cyber-btn-primary">
                            <i class="fas fa-save mr-2"></i>Simpan User
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
