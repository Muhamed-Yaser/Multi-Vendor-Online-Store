<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable  implements MustVerifyEmail
{
    use HasFactory ;
    protected $table = 'admins';
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
    ];
}