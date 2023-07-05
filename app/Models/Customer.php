<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    const _NAME = 'name';
    const _PHONE = 'phone';
    const _EMAIL = 'email';
    const _ADDRESS ='address';
    protected $fillable = [
        self::_NAME,
        self::_PHONE,
        self::_EMAIL,
        self::_ADDRESS,
    ];

}
