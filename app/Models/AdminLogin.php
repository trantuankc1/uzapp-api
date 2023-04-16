<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminLogin extends Authenticatable
{
    use HasFactory;

    public $table = 'admin_login';

    protected string $guard = 'admin';
}
