<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangStock extends Model
{
    protected $guarded = [];
    protected $table = 'barang_stocks';

    public function dataBarang()
    {
        return $this->belongsTo(DataBarang::class);
    }
}
