<?php

namespace App\Exports;

use App\Vehicle;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;


class DriverFinanceExport implements FromArray, WithHeadings, ShouldAutoSize
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
            'Transaction ID',
            'Rent',
            'Loan Withdrawn',
            'Loan Payment',
            'Damage Payment',
            'Case Payment',
        ];
    }
    public function array(): array
    {
        return $this->data;
    }



}
