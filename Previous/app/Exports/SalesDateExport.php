<?php

namespace App\Exports;

use App\Vehicle;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;


class SalesDateExport implements FromArray, WithHeadings, ShouldAutoSize
{

    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }
    public function headings(): array
    {
        return [
            'Date',
            'Sales ID',
            'Customer ID',
            'Customer Name',
            'Opening Due',
            'Sales Total',
            'Grand Total',
            'Payment',
            'Closing Due'
        ];
    }
    public function array(): array
    {
        return $this->data;
    }



}
