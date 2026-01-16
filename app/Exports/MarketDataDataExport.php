<?php

namespace App\Exports;

use App\Models\MarketData;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class MarketDataDataExport implements FromCollection, WithHeadings, WithMapping, WithTitle
{
    protected $marketData;

    public function __construct(MarketData $marketData)
    {
        $this->marketData = $marketData;
    }

    public function collection()
    {
        return $this->marketData->dataSeries;
    }

    public function headings(): array
    {
        return [
            'Data',
            'Valor',
        ];
    }

    public function map($series): array
    {
        return [
            $series->date->format('d/m/Y'),
            number_format($series->value, 2, ',', '.'),
        ];
    }

    public function title(): string
    {
        return 'Dados - ' . substr($this->marketData->title, 0, 25);
    }
}
