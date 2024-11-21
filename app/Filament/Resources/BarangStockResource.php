<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BarangStockResource\Pages;
use App\Filament\Resources\BarangStockResource\RelationManagers;
use App\Models\BarangStock;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Actions\HeaderAction;
use Filament\Tables\Columns\TextColumn;

class BarangStockResource extends Resource
{
    protected static ?string $model = BarangStock::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('data_barang_id')
                    ->relationship('dataBarang', 'nama_barang')
                    ->required(),
                Forms\Components\TextInput::make('jumlah')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('dataBarang.nama_barang'),
                Tables\Columns\TextColumn::make('jumlah'),
                Tables\Columns\TextColumn::make('status')
                    ->getStateUsing(function ($record) {
                        return $record->jumlah < 1 ? 'Barang Keluar' : 'Barang Masuk';
                    })
                    ->colors([
                        'danger' => 'Barang Keluar',
                        'success' => 'Barang Masuk',
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d-m-Y H:i:s'),
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
            'index' => Pages\ListBarangStocks::route('/'),
            // 'create' => Pages\CreateBarangStock::route('/create'),
            // 'edit' => Pages\EditBarangStock::route('/{record}/edit'),
        ];
    }
}
