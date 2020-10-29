<?php

namespace App\Exports;



use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;


class StockDetailsExport implements FromArray, WithHeadings, ShouldAutoSize, WithStrictNullComparison
{

    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function headings(): array
    {
        return [
            'Category Name',
            'Stock Name',
            'Quantity',
            'Purchase',
            'Total Value',
            'Sale',
            'Supplier'
        ];
    }
    public function array(): array
    {
        return $this->data;
    }



}
