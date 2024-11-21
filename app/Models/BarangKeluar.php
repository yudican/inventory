<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    protected $guarded = [];
    protected $table = 'barang_keluars';

    public function dataBarang()
    {
        return $this->belongsTo(DataBarang::class);
    }
}
