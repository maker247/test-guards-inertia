<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password'];

    protected $guard = 'admin';

    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn(mixed $value, array $attributes) => bcrypt($value)
        );
    }
}
