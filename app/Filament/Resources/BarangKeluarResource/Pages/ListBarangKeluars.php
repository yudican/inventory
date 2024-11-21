<?php

namespace App\Filament\Resources\BarangKeluarResource\Pages;

use App\Filament\Resources\BarangKeluarResource;
use App\Models\BarangStock;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBarangKeluars extends ListRecords
{
    protected static string $resource = BarangKeluarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->after(function($record) {
                BarangStock::create([
                    'data_barang_id' => $record->data_barang_id,
                    'jumlah' => -$record->jumlah
                ]);
            }),
        ];
    }
}
