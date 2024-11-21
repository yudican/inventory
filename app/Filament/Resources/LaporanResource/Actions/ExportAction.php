<?php

namespace App\Filament\Resources\LaporanResource\Actions;

use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Illuminate\Support\Carbon;
use App\Models\BarangStock;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanExport;

class ExportAction extends Action
{
    public static function getDefaultName(): ?string 
    {
        return 'export';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Export')
            ->icon('heroicon-o-document-arrow-down')
            ->form([
                Select::make('type')
                    ->label('Tipe Export')
                    ->options([
                        'pdf' => 'PDF',
                        'excel' => 'Excel'
                    ])
                    ->required(),
                DatePicker::make('start_date')
                    ->label('Tanggal Mulai')
                    ->required(),
                DatePicker::make('end_date')
                    ->label('Tanggal Akhir')
                    ->required(),
            ])
            ->action(function (array $data) {
                $query = BarangStock::query()
                    ->whereBetween('created_at', [
                        Carbon::parse($data['start_date'])->startOfDay(),
                        Carbon::parse($data['end_date'])->endOfDay(),
                    ]);

                if ($data['type'] === 'pdf') {
                    $pdf = Pdf::loadView('pdf.laporan', [
                        'data' => $query->get(),
                        'start_date' => $data['start_date'],
                        'end_date' => $data['end_date'],
                    ]);
                    
                    return response()->streamDownload(function () use ($pdf) {
                        echo $pdf->output();
                    }, 'laporan.pdf');
                }

                if ($data['type'] === 'excel') {
                    return Excel::download(
                        new LaporanExport($data['start_date'], $data['end_date']), 
                        'laporan.xlsx'
                    );
                }
            });
    }
} 