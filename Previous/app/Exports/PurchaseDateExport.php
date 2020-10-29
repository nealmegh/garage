<?php

namespace App\Exports;

use App\Vehicle;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;


class PurchaseDateExport implements FromArray, WithHeadings, ShouldAutoSize
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
            'Purchase ID',
            'Supplier ID',
            'Supplier Name',
            'Opening Due',
            'Purchase Total',
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
