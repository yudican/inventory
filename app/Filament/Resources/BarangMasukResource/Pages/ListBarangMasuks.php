<?php

namespace App\Filament\Resources\BarangMasukResource\Pages;

use App\Filament\Resources\BarangMasukResource;
use App\Models\BarangStock;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBarangMasuks extends ListRecords
{
    protected static string $resource = BarangMasukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->after(function($record) {
                    BarangStock::create([
                        'data_barang_id' => $record->data_barang_id,
                        'jumlah' => $record->jumlah
                    ]);
                }),
        ];
    }
}
