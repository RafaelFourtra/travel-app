<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JamaahModel extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'data_jamaahs';
    protected $fillable = [
        'user_id',
        'nij',
        'namajamaah',
        'jenis_kelamin',
        'alamat',
        'no_ktp',
        'no_passport',
        'no_hp',
        'tempat_lahir',
        'tgl_lahir',
        'keterangan',
    ];
    
}
