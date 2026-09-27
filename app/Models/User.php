<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isBendahara()
    {
        return $this->role === 'bendahara';
    }

    public function isKetuaRW()
    {
        return $this->role === 'ketua_rw';
    }

    public function canManageUsers()
    {
        return in_array($this->role, ['admin', 'ketua_rw']);
    }

    public function canViewAllTransactions()
    {
        return in_array($this->role, ['admin', 'bendahara', 'ketua_rw']);
    }
}
