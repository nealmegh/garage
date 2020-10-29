<?php

namespace App\Exports;

use App\Vehicle;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;


class StockDetailsExport implements FromArray, WithHeadings, ShouldAutoSize
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
            'Sale',
            'Supplier'
        ];
    }
    public function array(): array
    {
        return $this->data;
    }



}
