<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    protected $guarded = [];
    protected $table = 'barang_masuks';

    public function dataBarang()
    {
        return $this->belongsTo(DataBarang::class);
    }
}
