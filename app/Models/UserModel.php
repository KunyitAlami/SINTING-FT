<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = 'user';

    protected $fillable = [
        'nama',
        'NIM',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    public $timestamps = false;
}