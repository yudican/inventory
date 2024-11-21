<?php

namespace App\Filament\Resources\BarangStockResource\Pages;

use App\Filament\Resources\BarangStockResource;
use App\Models\BarangStock;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Components\ViewComponent;
use Filament\Support\Enums\FontWeight;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Filament\Widgets\StockOverview;

class ListBarangStocks extends ListRecords
{
    protected static string $resource = BarangStockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }

    public function getHeaderWidgets(): array 
    {
        return [
            StockOverview::class,
        ];
    }
}
