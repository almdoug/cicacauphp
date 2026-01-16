<?php

namespace App\Exports;

use App\Models\ProductionCost;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class ProductionCostDataExport implements FromCollection, WithHeadings, WithMapping, WithTitle
{
    protected $productionCost;

    public function __construct(ProductionCost $productionCost)
    {
        $this->productionCost = $productionCost;
    }

    public function collection()
    {
        return $this->productionCost->dataSeries;
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
        return 'Dados - ' . substr($this->productionCost->title, 0, 25);
    }
}
