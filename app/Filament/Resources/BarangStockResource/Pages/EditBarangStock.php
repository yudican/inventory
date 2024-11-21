<?php

namespace App\Filament\Resources\BarangStockResource\Pages;

use App\Filament\Resources\BarangStockResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBarangStock extends EditRecord
{
    protected static string $resource = BarangStockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
