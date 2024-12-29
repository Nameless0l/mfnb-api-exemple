<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
    public function isStylist(): bool
    {
        return $this->is_stylist;
    }
    public function isAdmin(): bool
    {
        return $this->is_admin;
    }
    public function isUser(): bool
    {
        return !$this->is_admin && !$this->is_stylist;
    }
    public function isVerified(): bool
    {
        return $this->email_verified_at !== null;
    }
    public function verify(): void
    {
        $this->email_verified_at = now();
        $this->save();
    }
    public function styliste()
    {
        return $this->hasOne(Styliste::class);
    }
}
