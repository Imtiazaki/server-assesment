<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileResult extends Model
{
    use HasFactory;
    protected $table = 'profile';

    protected $fillable = [
        'email',
        'nama',
        'jenis_kelamin',
        'jabatan',
        'perusahaan',
        'tanggal_lahir',
        'jadwal',
      ];
    protected $hidden = [
        'token',
    ];
}
