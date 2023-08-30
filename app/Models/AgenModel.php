<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgenModel extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'data_agens';
    protected $fillable = [
        'nia',
        'namaagen',
        'jenis_kelamin',
        'alamat',
        'no_ktp',
        'no_passport',
        'no_hp',
        'tempat_lahir',
        'tgl_lahir',
        'keterangan',
        'jumlah_jamaah',
        'fee_jamaah',
        'jumlah_saldo',
    ];
}
