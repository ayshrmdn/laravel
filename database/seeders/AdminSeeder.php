<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Super Admin
        Admin::create([
            'name' => 'Super Admin',
            'email' => 'admin@boscuan.com',
            'password' => Hash::make('admin123'),
            'role' => 'super_admin',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Create Regular Admin
        Admin::create([
            'name' => 'Admin Boscuan',
            'email' => 'staff@boscuan.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Create Demo Admin
        Admin::create([
            'name' => 'Demo Admin',
            'email' => 'demo@boscuan.com',
            'password' => Hash::make('demo123'),
            'role' => 'admin',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        echo "✅ Admin accounts created:\n";
        echo "📧 admin@boscuan.com | 🔑 admin123 (Super Admin)\n";
        echo "📧 staff@boscuan.com | 🔑 password123 (Admin)\n";
        echo "📧 demo@boscuan.com  | 🔑 demo123 (Admin)\n";
    }
}
