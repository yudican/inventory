<?php

namespace App\Filament\Resources\LaporanResource\Pages;

use App\Filament\Resources\LaporanResource;
use Filament\Resources\Pages\ListRecords;
use App\Models\BarangStock;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanExport;

class ListLaporan extends ListRecords
{
    protected static string $resource = LaporanResource::class;

    public function generatePDF()
    {
        $data = BarangStock::all();
        
        $pdf = Pdf::loadView('pdf.laporan', [
            'data' => $data
        ]);
        
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'laporan.pdf');
    }
    
    public function generateExcel() 
    {
        return Excel::download(new LaporanExport, 'laporan.xlsx');
    }
} 