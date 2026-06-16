<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'google_id',
        'avatar',
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
        ];
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        $adminEmails = [
            'admin@etalaseku.test',
            'admin@etalaseku.com',
        ];

        return $this->role === 'admin'
            || in_array(strtolower($this->email), array_map('strtolower', $adminEmails), true);
    }

    /**
     * Check if user registered via Google OAuth
     */
    public function isGoogleUser(): bool
    {
        return !empty($this->google_id);
    }

    /**
     * Check if user has a password set
     */
    public function hasPassword(): bool
    {
        return !empty($this->password);
    }

    /**
     * Get the store associated with the user.
     */
    public function store(): HasOne
    {
        return $this->hasOne(Store::class);
    }

    /**
     * Get the inclusive program applications for the user.
     */
    public function inclusiveProgramApplications(): HasMany
    {
        return $this->hasMany(InclusiveProgramApplication::class);
    }

    /**
     * Check if user has a store
     */
    public function hasStore(): bool
    {
        return $this->store()->exists();
    }

    /**
     * Get the wallet for the user.
     */
    public function wallet(): HasOne
    {
        return $this->hasOne(Wallet::class);
    }

    /**
     * Get the pages for the user.
     */
    public function pages(): HasMany
    {
        return $this->hasMany(Page::class)->orderBy('sort_order');
    }
}
