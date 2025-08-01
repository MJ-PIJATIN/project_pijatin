<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class SuperAdmin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'super_admin';

    protected $fillable = [
        'email', 
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}