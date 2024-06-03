<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $table = 'profile';

    protected $fillable = [
        'email',
        'nama',
        'token',
        'jenis_kelamin',
        'jabatan',
        'perusahaan',
        'mulai',
        'tanggal_lahir',
        'jadwal',
      ];
}
