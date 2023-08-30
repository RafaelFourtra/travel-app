<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransaksiModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'transaksi_setorans';
    protected $fillable = [
        'kode_transaksi',
        'jamaah_id',
        'paket_id',
        'namajamaah',
        'harga_paket',
        'saldo',
        'is_lunas',
        'keterangan',
        'tanggal_transaksi'
    ];

    public function Jamaah(): HasMany
    {
        return $this->hasMany(JamaahModel::class, 'id', 'jamaah_id');
    }

    public function Paket(): HasMany
    {
        return $this->hasMany(Paket::class, 'id', 'paket_id');
    }
}
