<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Masyarakat extends Authenticatable
{
    use Notifiable;

    protected $table = 'masyarakat';
    protected $primaryKey = 'nik';
    public $incrementing = false; // NIK bukan auto-increment
    protected $fillable = ['nik', 'nama', 'username', 'password', 'telp', 'email', 'alamat'];

    protected $hidden = ['password'];
}


