<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'name',
        'full_name',
        'email',
        'password',
        'phone',
        'bank_name',
        'bank_type',
        'account_number',
        'referral_code',
        'referred_by',
        'is_active',
        'is_online',
        'last_seen_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
            'is_online' => 'boolean',
            'last_seen_at' => 'datetime',
        ];
    }

    /**
     * Generate a unique referral code for the user
     */
    public function generateReferralCode(): string
    {
        do {
            $code = 'REF' . strtoupper(substr(md5(uniqid()), 0, 6));
        } while (self::where('referral_code', $code)->exists());
        
        return $code;
    }

    /**
     * Get the user who referred this user
     */
    public function referrer()
    {
        return $this->belongsTo(User::class, 'referred_by', 'referral_code');
    }

    /**
     * Get users referred by this user
     */
    public function referrals()
    {
        return $this->hasMany(User::class, 'referred_by', 'referral_code');
    }

    /**
     * Check if user is active
     */
    public function isActive(): bool
    {
        return $this->is_active;
    }

    /**
     * Get chats for this user
     */
    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    /**
     * Get messages sent by this user
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
