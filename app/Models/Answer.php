<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $table = 'answers';
    protected $fillable = [
        'email',
        'nama',
        'modul',
        'tanggal',
        'selesai',
        'mulai',
        'jawaban',
      ];
}
