<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;


class DataVaksin extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'data_vaksins';
    protected $fillable = [
        'jamaah_id',
        'vaksin',
        'tanggal',
    ];

    public function Jamaah(): HasMany
    {
        return $this->hasMany(JamaahModel::class, 'id', 'jamaah_id');
    }


}
