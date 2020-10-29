<?php

namespace App\Exports;

use App\Vehicle;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;


class DebitCreditExport implements FromArray, WithHeadings, ShouldAutoSize
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
            'Debit',
            'Credit',
            'Payment For',
            'Notes'
        ];
    }
    public function array(): array
    {
        return $this->data;
    }



}
