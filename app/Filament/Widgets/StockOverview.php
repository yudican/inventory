<?php

namespace App\Filament\Widgets;

use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\BarangStock;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StockOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            // barang masuk
            Stat::make('Barang Masuk', number_format(BarangMasuk::sum('jumlah')))
                ->color('success'),
            // barang keluar
            Stat::make('Barang Keluar', number_format(BarangKeluar::sum('jumlah')))
                ->color('danger'),
            // total sisa stock
            Stat::make('Total Sisa Stock', number_format(BarangStock::sum('jumlah')))
                ->color('success'),
        ];
    }
} 