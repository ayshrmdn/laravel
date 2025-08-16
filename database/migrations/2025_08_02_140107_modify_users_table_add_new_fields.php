<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Add new fields
            $table->string('username')->unique()->after('id');
            $table->string('full_name')->after('name');
            $table->string('phone')->nullable()->after('email');
            $table->string('bank_name')->nullable()->after('phone');
            $table->string('bank_type')->nullable()->after('bank_name');
            $table->string('account_number')->nullable()->after('bank_type');
            $table->string('referral_code')->nullable()->after('account_number');
            $table->string('referred_by')->nullable()->after('referral_code');
            $table->boolean('is_active')->default(true)->after('referred_by');
            
            // Modify existing columns
            $table->string('name')->nullable()->change(); // Keep name but make nullable since we have full_name
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'username',
                'full_name', 
                'phone',
                'bank_name',
                'bank_type',
                'account_number',
                'referral_code',
                'referred_by',
                'is_active'
            ]);
        });
    }
};
