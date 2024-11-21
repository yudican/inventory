<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LaporanResource\Pages;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\LaporanResource\Actions\ExportAction;
use App\Models\BarangStock;

class LaporanResource extends Resource
{
    protected static ?string $model = BarangStock::class;
    
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    
    protected static ?string $navigationLabel = 'Laporan';
    
    protected static ?string $pluralModelLabel = 'Laporan';

    public static function table(Table $table): Table 
    {
        return $table
            ->columns([
                TextColumn::make('dataBarang.nama_barang'),
                TextColumn::make('jumlah'),
                TextColumn::make('jenis')
                    ->getStateUsing(function ($record) {
                        return $record->jumlah > 0 ? 'Barang Masuk' : 'Barang Keluar';
                    }),
                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->date(),
            ])
            ->headerActions([
                ExportAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLaporan::route('/'),
        ];
    }
} 