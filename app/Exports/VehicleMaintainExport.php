<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VehicleMaintainExport implements FromArray, WithHeadings
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
            'Cost',
            'Product List',
        ];
    }
    public function array(): array
    {
        return $this->data;
    }



}
