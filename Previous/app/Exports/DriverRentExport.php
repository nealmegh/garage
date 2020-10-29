<?php

namespace App\Exports;

use App\Vehicle;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;


class DriverRentExport implements FromArray, WithHeadings, ShouldAutoSize
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
            'Vehicle',
            'Collection',
            'Total Collection',
            'Due',
            'Total Due',
            'Damage Amount',
            'Case ID',
            'Case Amount',
            'Payment By',
            'Loan'
        ];
    }
    public function array(): array
    {
        return $this->data;
    }



}
