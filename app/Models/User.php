<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $fillable = [
        'id',
        'name',
        'username',
        'email',
        'password',
        'address',
        'phone',
        'website',
        'company',
    ];

    protected $casts = [
        'address' => 'array',
        'company' => 'array',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public $incrementing = false;

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function todos()
    {
        return $this->hasMany(Todo::class);
    }

    public function albums()
    {
        return $this->hasMany(Album::class);
    }
}
