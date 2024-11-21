<?php

namespace App\Exports;

use App\Models\BarangStock;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Carbon;

class LaporanExport implements FromCollection, WithHeadings
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        return BarangStock::whereBetween('created_at', [
                Carbon::parse($this->startDate)->startOfDay(),
                Carbon::parse($this->endDate)->endOfDay(),
            ])
            ->get()
            ->map(function($item) {
                return [
                    'nama_barang' => $item->dataBarang->nama_barang,
                    'jumlah' => $item->jumlah,
                    'jenis' => $item->jumlah > 0 ? 'Barang Masuk' : 'Barang Keluar',
                    'tanggal' => $item->created_at->format('d/m/Y')
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Nama Barang',
            'Jumlah',
            'Jenis',
            'Tanggal'
        ];
    }
} 