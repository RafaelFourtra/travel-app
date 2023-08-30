<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'settings';
    protected $fillable = [
        'nama_perusahaan',
        'npsn',
        'alamat',
        'email',
        'kepala',
        'bendahara',
        'logo',
    ];
}
