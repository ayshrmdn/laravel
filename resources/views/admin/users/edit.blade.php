@extends('layouts.admin')

@section('title', 'Edit User')

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
                    <i class="fas fa-user-edit mr-3"></i>Edit User
                </h1>
            </div>
            <p class="text-gray-400">Update informasi pengguna</p>
        </div>

        <!-- Edit Form -->
        <div class="cyber-card">
            <h3 class="text-xl font-bold text-cyan-400 mb-6 flex items-center">
                <i class="fas fa-user mr-3"></i>Informasi User
            </h3>
            
            <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Username -->
                    <div>
                        <label for="username" class="cyber-label">
                            Username <span class="text-red-400">*</span>
                        </label>
                        <input type="text" 
                               id="username" 
                               name="username" 
                               value="{{ old('username', $user->username) }}"
                               class="cyber-input @error('username') border-red-500 @enderror"
                               required>
                        @error('username')
                            <p class="cyber-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Full Name -->
                    <div>
                        <label for="full_name" class="cyber-label">
                            Nama Lengkap <span class="text-red-400">*</span>
                        </label>
                        <input type="text" 
                               id="full_name" 
                               name="full_name" 
                               value="{{ old('full_name', $user->full_name) }}"
                               class="cyber-input @error('full_name') border-red-500 @enderror"
                               required>
                        @error('full_name')
                            <p class="cyber-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="cyber-label">
                            Email <span class="text-red-400">*</span>
                        </label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               value="{{ old('email', $user->email) }}"
                               class="cyber-input @error('email') border-red-500 @enderror"
                               required>
                        @error('email')
                            <p class="cyber-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="cyber-label">
                            Nomor Telepon
                        </label>
                        <input type="text" 
                               id="phone" 
                               name="phone" 
                               value="{{ old('phone', $user->phone) }}"
                               class="cyber-input @error('phone') border-red-500 @enderror">
                        @error('phone')
                            <p class="cyber-error">{{ $message }}</p>
                        @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="cyber-label">
                        Password Baru (kosongkan jika tidak ingin mengubah)
                    </label>
                    <input type="password" 
                           id="password" 
                           name="password"
                           class="cyber-input @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="cyber-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="cyber-label">
                        Konfirmasi Password Baru
                    </label>
                    <input type="password" 
                           id="password_confirmation" 
                           name="password_confirmation"
                           class="cyber-input">
                </div>
            </div>

            <!-- Bank Information Section -->
            <div class="mt-8 pt-6 border-t border-gray-700">
                <h4 class="text-xl font-bold text-purple-400 mb-6 flex items-center">
                    <i class="fas fa-university mr-3"></i>Informasi Bank (Opsional)
                </h4>
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Bank Name -->
                    <div>
                        <label for="bank_name" class="cyber-label">
                            Nama Bank
                        </label>
                        <input type="text" 
                               id="bank_name" 
                               name="bank_name" 
                               value="{{ old('bank_name', $user->bank_name) }}"
                               class="cyber-input @error('bank_name') border-red-500 @enderror">
                        @error('bank_name')
                            <p class="cyber-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Bank Type -->
                    <div>
                        <label for="bank_type" class="cyber-label">
                            Bank / E-Wallet
                        </label>
                        <select id="bank_type" 
                                name="bank_type"
                                class="cyber-select @error('bank_type') border-red-500 @enderror">
                            <option value="">Pilih Bank / E-Wallet</option>
                            
                            <optgroup label="Bank Nasional">
                                <option value="Bank BCA" {{ old('bank_type', $user->bank_type) == 'Bank BCA' ? 'selected' : '' }}>Bank BCA</option>
                                <option value="Bank BRI" {{ old('bank_type', $user->bank_type) == 'Bank BRI' ? 'selected' : '' }}>Bank BRI</option>
                                <option value="Bank BNI" {{ old('bank_type', $user->bank_type) == 'Bank BNI' ? 'selected' : '' }}>Bank BNI</option>
                                <option value="Bank Mandiri" {{ old('bank_type', $user->bank_type) == 'Bank Mandiri' ? 'selected' : '' }}>Bank Mandiri</option>
                                <option value="Bank BTN" {{ old('bank_type', $user->bank_type) == 'Bank BTN' ? 'selected' : '' }}>Bank BTN</option>
                                <option value="Bank CIMB Niaga" {{ old('bank_type', $user->bank_type) == 'Bank CIMB Niaga' ? 'selected' : '' }}>Bank CIMB Niaga</option>
                                <option value="Bank Danamon" {{ old('bank_type', $user->bank_type) == 'Bank Danamon' ? 'selected' : '' }}>Bank Danamon</option>
                                <option value="Bank Permata" {{ old('bank_type', $user->bank_type) == 'Bank Permata' ? 'selected' : '' }}>Bank Permata</option>
                                <option value="Bank OCBC NISP" {{ old('bank_type', $user->bank_type) == 'Bank OCBC NISP' ? 'selected' : '' }}>Bank OCBC NISP</option>
                                <option value="Bank Maybank" {{ old('bank_type', $user->bank_type) == 'Bank Maybank' ? 'selected' : '' }}>Bank Maybank</option>
                                <option value="Bank Panin" {{ old('bank_type', $user->bank_type) == 'Bank Panin' ? 'selected' : '' }}>Bank Panin</option>
                                <option value="Bank UOB" {{ old('bank_type', $user->bank_type) == 'Bank UOB' ? 'selected' : '' }}>Bank UOB</option>
                                <option value="Bank Mega" {{ old('bank_type', $user->bank_type) == 'Bank Mega' ? 'selected' : '' }}>Bank Mega</option>
                                <option value="Bank BII Maybank" {{ old('bank_type', $user->bank_type) == 'Bank BII Maybank' ? 'selected' : '' }}>Bank BII Maybank</option>
                                <option value="Bank Sinarmas" {{ old('bank_type', $user->bank_type) == 'Bank Sinarmas' ? 'selected' : '' }}>Bank Sinarmas</option>
                            </optgroup>
                            
                            <optgroup label="Bank Syariah">
                                <option value="Bank Syariah Indonesia (BSI)" {{ old('bank_type', $user->bank_type) == 'Bank Syariah Indonesia (BSI)' ? 'selected' : '' }}>Bank Syariah Indonesia (BSI)</option>
                                <option value="Bank Muamalat" {{ old('bank_type', $user->bank_type) == 'Bank Muamalat' ? 'selected' : '' }}>Bank Muamalat</option>
                                <option value="Bank BCA Syariah" {{ old('bank_type', $user->bank_type) == 'Bank BCA Syariah' ? 'selected' : '' }}>Bank BCA Syariah</option>
                                <option value="Bank BRI Syariah" {{ old('bank_type', $user->bank_type) == 'Bank BRI Syariah' ? 'selected' : '' }}>Bank BRI Syariah</option>
                                <option value="Bank BNI Syariah" {{ old('bank_type', $user->bank_type) == 'Bank BNI Syariah' ? 'selected' : '' }}>Bank BNI Syariah</option>
                                <option value="Bank Mandiri Syariah" {{ old('bank_type', $user->bank_type) == 'Bank Mandiri Syariah' ? 'selected' : '' }}>Bank Mandiri Syariah</option>
                                <option value="Bank Mega Syariah" {{ old('bank_type', $user->bank_type) == 'Bank Mega Syariah' ? 'selected' : '' }}>Bank Mega Syariah</option>
                                <option value="Bank Panin Dubai Syariah" {{ old('bank_type', $user->bank_type) == 'Bank Panin Dubai Syariah' ? 'selected' : '' }}>Bank Panin Dubai Syariah</option>
                            </optgroup>
                            
                            <optgroup label="Bank Digital">
                                <option value="Bank Jago" {{ old('bank_type', $user->bank_type) == 'Bank Jago' ? 'selected' : '' }}>Bank Jago</option>
                                <option value="Bank Neo Commerce" {{ old('bank_type', $user->bank_type) == 'Bank Neo Commerce' ? 'selected' : '' }}>Bank Neo Commerce</option>
                                <option value="Bank Allo" {{ old('bank_type', $user->bank_type) == 'Bank Allo' ? 'selected' : '' }}>Bank Allo</option>
                                <option value="SeaBank" {{ old('bank_type', $user->bank_type) == 'SeaBank' ? 'selected' : '' }}>SeaBank</option>
                                <option value="Bank Blu BCA Digital" {{ old('bank_type', $user->bank_type) == 'Bank Blu BCA Digital' ? 'selected' : '' }}>Bank Blu BCA Digital</option>
                            </optgroup>
                            
                            <optgroup label="E-Wallet">
                                <option value="Dana" {{ old('bank_type', $user->bank_type) == 'Dana' ? 'selected' : '' }}>Dana</option>
                                <option value="OVO" {{ old('bank_type', $user->bank_type) == 'OVO' ? 'selected' : '' }}>OVO</option>
                                <option value="GoPay" {{ old('bank_type', $user->bank_type) == 'GoPay' ? 'selected' : '' }}>GoPay</option>
                                <option value="ShopeePay" {{ old('bank_type', $user->bank_type) == 'ShopeePay' ? 'selected' : '' }}>ShopeePay</option>
                                <option value="LinkAja" {{ old('bank_type', $user->bank_type) == 'LinkAja' ? 'selected' : '' }}>LinkAja</option>
                                <option value="QRIS" {{ old('bank_type', $user->bank_type) == 'QRIS' ? 'selected' : '' }}>QRIS</option>
                                <option value="PayPal" {{ old('bank_type', $user->bank_type) == 'PayPal' ? 'selected' : '' }}>PayPal</option>
                                <option value="Jenius" {{ old('bank_type', $user->bank_type) == 'Jenius' ? 'selected' : '' }}>Jenius</option>
                                <option value="Sakuku" {{ old('bank_type', $user->bank_type) == 'Sakuku' ? 'selected' : '' }}>Sakuku</option>
                                <option value="TrueMoney" {{ old('bank_type', $user->bank_type) == 'TrueMoney' ? 'selected' : '' }}>TrueMoney</option>
                            </optgroup>
                            
                            <optgroup label="Bank Daerah">
                                <option value="Bank DKI" {{ old('bank_type', $user->bank_type) == 'Bank DKI' ? 'selected' : '' }}>Bank DKI</option>
                                <option value="Bank BJB" {{ old('bank_type', $user->bank_type) == 'Bank BJB' ? 'selected' : '' }}>Bank BJB</option>
                                <option value="Bank Jateng" {{ old('bank_type', $user->bank_type) == 'Bank Jateng' ? 'selected' : '' }}>Bank Jateng</option>
                                <option value="Bank Jatim" {{ old('bank_type', $user->bank_type) == 'Bank Jatim' ? 'selected' : '' }}>Bank Jatim</option>
                                <option value="Bank Sumut" {{ old('bank_type', $user->bank_type) == 'Bank Sumut' ? 'selected' : '' }}>Bank Sumut</option>
                                <option value="Bank Sumsel Babel" {{ old('bank_type', $user->bank_type) == 'Bank Sumsel Babel' ? 'selected' : '' }}>Bank Sumsel Babel</option>
                                <option value="Bank Kalbar" {{ old('bank_type', $user->bank_type) == 'Bank Kalbar' ? 'selected' : '' }}>Bank Kalbar</option>
                                <option value="Bank Kalsel" {{ old('bank_type', $user->bank_type) == 'Bank Kalsel' ? 'selected' : '' }}>Bank Kalsel</option>
                                <option value="Bank Kaltim" {{ old('bank_type', $user->bank_type) == 'Bank Kaltim' ? 'selected' : '' }}>Bank Kaltim</option>
                                <option value="Bank Sulut" {{ old('bank_type', $user->bank_type) == 'Bank Sulut' ? 'selected' : '' }}>Bank Sulut</option>
                                <option value="Bank Papua" {{ old('bank_type', $user->bank_type) == 'Bank Papua' ? 'selected' : '' }}>Bank Papua</option>
                            </optgroup>
                        </select>
                        @error('bank_type')
                            <p class="cyber-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Account Number -->
                    <div>
                        <label for="account_number" class="cyber-label">
                            Nomor Rekening
                        </label>
                        <input type="text" 
                               id="account_number" 
                               name="account_number" 
                               value="{{ old('account_number', $user->account_number) }}"
                               class="cyber-input @error('account_number') border-red-500 @enderror">
                        @error('account_number')
                            <p class="cyber-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Referral Section -->
            <div class="mt-8 pt-6 border-t border-gray-700">
                <h4 class="text-xl font-bold text-green-400 mb-6 flex items-center">
                    <i class="fas fa-share-alt mr-3"></i>Informasi Referral
                </h4>
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Referral Code (Read Only) -->
                    <div>
                        <label for="referral_code" class="cyber-label">
                            Kode Referral (Otomatis)
                        </label>
                        <input type="text" 
                               id="referral_code" 
                               value="{{ $user->referral_code }}"
                               class="cyber-input bg-gray-800 text-gray-400"
                               readonly>
                    </div>

                    <!-- Referred By -->
                    <div>
                        <label for="referred_by" class="cyber-label">
                            Direferensikan Oleh (Kode Referral)
                        </label>
                        <input type="text" 
                               id="referred_by" 
                               name="referred_by" 
                               value="{{ old('referred_by', $user->referred_by) }}"
                               placeholder="Masukkan kode referral"
                               class="cyber-input @error('referred_by') border-red-500 @enderror">
                        @error('referred_by')
                            <p class="cyber-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="is_active" class="cyber-label">
                            Status Akun
                        </label>
                        <select id="is_active" 
                                name="is_active"
                                class="cyber-select">
                            <option value="1" {{ old('is_active', $user->is_active) == '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('is_active', $user->is_active) == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="mt-8 pt-6 border-t border-gray-700 flex items-center justify-end space-x-4">
                <a href="{{ route('admin.users.index') }}" class="cyber-btn-outline">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
                <button type="submit" class="cyber-btn-primary">
                    <i class="fas fa-save mr-2"></i>Update User
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
