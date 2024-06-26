<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $table = 'jadwal';
    protected $fillable = [
        'kursus',
        'peserta',
        'keterangan',
        'jenis_modul',
        'link',
        'tanggal_mulai',
        'tanggal_selesai',
      ];
}
