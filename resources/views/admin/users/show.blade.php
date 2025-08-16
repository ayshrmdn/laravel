@extends('layouts.admin')

@section('title', 'Detail User')

@section('content')
<div class="min-h-screen bg-black text-white p-4">
    <div class="max-w-7xl mx-auto">
        
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.users.index') }}" class="cyber-btn-outline">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                <div class="w-16 h-16 rounded-full bg-gradient-to-r from-cyan-400 to-purple-400 flex items-center justify-center text-black font-bold text-xl">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div>
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-cyan-400 to-purple-400 bg-clip-text text-transparent">
                        {{ $user->name }}
                    </h1>
                    <p class="text-gray-400">{{ $user->username }}</p>
                    <span class="cyber-badge-{{ $user->is_active ? 'success' : 'warning' }}">
                        {{ $user->is_active ? 'Aktif' : 'Tidak Aktif' }}
                    </span>
                </div>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('admin.users.edit', $user) }}" class="cyber-btn-secondary">
                    <i class="fas fa-edit mr-2"></i>Edit User
                </a>
            </div>
        </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Personal Information -->
        <div class="cyber-card">
            <h3 class="text-xl font-bold text-cyan-400 mb-6 flex items-center">
                <i class="fas fa-user mr-3"></i>Informasi Pribadi
            </h3>
            <div class="space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="cyber-label">Username</label>
                        <p class="text-cyan-400 font-mono">{{ $user->username }}</p>
                    </div>
                    <div>
                        <label class="cyber-label">Nama Lengkap</label>
                        <p class="text-white">{{ $user->full_name ?? 'Tidak diisi' }}</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="cyber-label">Email</label>
                        <p class="text-purple-400">{{ $user->email }}</p>
                    </div>
                    <div>
                        <label class="cyber-label">Telepon</label>
                        <p class="text-yellow-400">{{ $user->phone ?? 'Tidak diisi' }}</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="cyber-label">Status Akun</label>
                        <span class="cyber-badge-{{ $user->is_active ? 'success' : 'warning' }}">
                            {{ $user->is_active ? 'Aktif' : 'Tidak Aktif' }}
                        </span>
                    </div>
                    <div>
                        <label class="cyber-label">Email Terverifikasi</label>
                        <span class="cyber-badge-{{ $user->email_verified_at ? 'success' : 'warning' }}">
                            {{ $user->email_verified_at ? 'Terverifikasi' : 'Belum Terverifikasi' }}
                        </span>
                    </div>
                </div>
                <div>
                    <label class="cyber-label">Bergabung Sejak</label>
                    <p class="text-green-400">{{ $user->created_at->format('d M Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Bank Information -->
        <div class="cyber-card">
            <h3 class="text-xl font-bold text-purple-400 mb-6 flex items-center">
                <i class="fas fa-university mr-3"></i>Informasi Bank
            </h3>
            <div class="space-y-4">
                @if($user->bank_name)
                    <div>
                        <label class="cyber-label">Nama Bank</label>
                        <p class="text-cyan-400">{{ $user->bank_name }}</p>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="cyber-label">Tipe Bank</label>
                            <p class="text-purple-400">{{ $user->bank_type ?? 'Tidak ditentukan' }}</p>
                        </div>
                        <div>
                            <label class="cyber-label">Nomor Rekening</label>
                            <p class="text-yellow-400 font-mono">{{ $user->account_number ?? 'Tidak diisi' }}</p>
                        </div>
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-university text-6xl text-gray-600 mb-4"></i>
                        <p class="text-gray-500">Tidak ada informasi bank</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Referral Information -->
        <div class="cyber-card">
            <h3 class="text-xl font-bold text-green-400 mb-6 flex items-center">
                <i class="fas fa-share-alt mr-3"></i>Informasi Referral
            </h3>
            <div class="space-y-4">
                <div>
                    <label class="cyber-label">Kode Referral</label>
                    <div class="flex items-center space-x-2">
                        <code class="px-3 py-1 bg-gray-800 border border-cyan-400 rounded text-sm font-mono text-cyan-400">{{ $user->referral_code }}</code>
                        <button onclick="copyToClipboard('{{ $user->referral_code }}')" 
                                class="cyber-btn-sm cyber-btn-outline">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>
                </div>
                @if($user->referred_by)
                    <div>
                        <label class="cyber-label">Direferensikan Oleh</label>
                        <p class="text-white">
                            <code class="px-2 py-1 bg-gray-800 border border-purple-400 rounded text-sm font-mono text-purple-400">{{ $user->referred_by }}</code>
                            @if($user->referrer)
                                <span class="ml-2 text-gray-400">({{ $user->referrer->full_name ?? $user->referrer->username }})</span>
                            @endif
                        </p>
                    </div>
                @endif
                <div>
                    <label class="cyber-label">Total Referral</label>
                    <p class="text-green-400">{{ $user->referrals->count() }} pengguna</p>
                </div>
            </div>
        </div>

        <!-- Account Activity -->
        <div class="cyber-card">
            <h3 class="text-xl font-bold text-yellow-400 mb-6 flex items-center">
                <i class="fas fa-clock mr-3"></i>Aktivitas Akun
            </h3>
            <div class="space-y-4">
                <div>
                    <label class="cyber-label">Dibuat Pada</label>
                    <p class="text-cyan-400">{{ $user->created_at->format('d M Y \j\a\m H:i') }}</p>
                </div>
                <div>
                    <label class="cyber-label">Terakhir Diperbarui</label>
                    <p class="text-purple-400">{{ $user->updated_at->format('d M Y \j\a\m H:i') }}</p>
                </div>
                @if($user->email_verified_at)
                    <div>
                        <label class="cyber-label">Email Terverifikasi Pada</label>
                        <p class="text-green-400">{{ $user->email_verified_at->format('d M Y \j\a\m H:i') }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Referrals List -->
    @if($user->referrals->count() > 0)
    <div class="cyber-card">
        <h3 class="text-xl font-bold text-cyan-400 mb-6 flex items-center">
            <i class="fas fa-users mr-3"></i>Pengguna yang Direferensikan ({{ $user->referrals->count() }})
        </h3>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-700">
                        <th class="px-6 py-3 text-left text-xs font-medium text-cyan-400 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-cyan-400 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-cyan-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-cyan-400 uppercase tracking-wider">Bergabung</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @foreach($user->referrals as $referral)
                    <tr class="hover:bg-gray-800 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-r from-cyan-400 to-purple-400 flex items-center justify-center">
                                    <span class="text-black font-bold text-sm">{{ strtoupper(substr($referral->name, 0, 1)) }}</span>
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-white">{{ $referral->full_name ?? $referral->name }}</div>
                                    <div class="text-sm text-gray-400">{{ $referral->username }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-purple-400">{{ $referral->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="cyber-badge-{{ $referral->is_active ? 'success' : 'warning' }}">
                                {{ $referral->is_active ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">{{ $referral->created_at->format('d M Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
    </div>
</div>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Show a temporary success message
        const button = event.target.closest('button');
        const originalContent = button.innerHTML;
        button.innerHTML = '<i class="fas fa-check"></i>';
        button.classList.remove('cyber-btn-outline');
        button.classList.add('cyber-btn-success');
        
        setTimeout(() => {
            button.innerHTML = originalContent;
            button.classList.remove('cyber-btn-success');
            button.classList.add('cyber-btn-outline');
        }, 2000);
    });
}
</script>
@endsection
