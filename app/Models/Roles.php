<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;
    const _ID = 'id';
    const _NAME = 'name';
    const _DESCRIPTION = 'description';

     protected $fillable = [
         self::_ID,
         self::_NAME,
         self::_DESCRIPTION
     ];

}
