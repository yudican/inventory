<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataBarang extends Model
{
    protected $guarded = [];
    protected $table = 'data_barangs';

    public function barangMasuk()
    {
        return $this->hasMany(BarangMasuk::class);
    }

    public function barangKeluar()
    {
        return $this->hasMany(BarangKeluar::class);
    }

    public function barangStock()
    {
        return $this->hasMany(BarangStock::class);
    }
}
