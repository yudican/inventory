<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BarangKeluarResource\Pages;
use App\Filament\Resources\BarangKeluarResource\RelationManagers;
use App\Models\BarangKeluar;
use App\Models\BarangStock;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BarangKeluarResource extends Resource
{
    protected static ?string $model = BarangKeluar::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('data_barang_id')
                    ->relationship('dataBarang', 'nama_barang')
                    ->required()
                    ->live(),
                Forms\Components\TextInput::make('jumlah')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(function (Forms\Get $get) {
                        $barangId = $get('data_barang_id');
                        if (!$barangId) return null;
                        
                        return BarangStock::where('data_barang_id', $barangId)->value('jumlah') ?? 0;
                    })
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('dataBarang.nama_barang'),
                Tables\Columns\TextColumn::make('jumlah'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBarangKeluars::route('/'),
            // 'create' => Pages\CreateBarangKeluar::route('/create'),
            // 'edit' => Pages\EditBarangKeluar::route('/{record}/edit'),
        ];
    }
}
