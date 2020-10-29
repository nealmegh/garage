<?php

namespace App\Exports;

use App\Vehicle;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;


class TransactionExport implements FromArray, WithHeadings, ShouldAutoSize
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
            'Payment For',
            'Amount',
            'Notes'
        ];
    }
    public function array(): array
    {
        return $this->data;
    }



}
