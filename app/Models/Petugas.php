<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class petugas extends Model
{
    use HasFactory;

    protected $table = 'petugas';
    protected $primaryKey = 'id';
    protected $fillable =
    [
        // 'id',
        'username',
        'email',
        'nama_petugas',
        'password',
        'level'

    ];
}
