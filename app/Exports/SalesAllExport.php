<?php

namespace App\Exports;



use Maatwebsite\Excel\Concerns\FromArray;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;

use PhpOffice\PhpSpreadsheet\Style\NumberFormat;


class SalesAllExport implements FromArray,  withHeadings, WithColumnFormatting, ShouldAutoSize
{
    private $sales;

    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_NUMBER_00,
            'E' => NumberFormat::FORMAT_NUMBER_00,
            'F' => NumberFormat::FORMAT_NUMBER_00,
            'G' => NumberFormat::FORMAT_NUMBER_00,
            'H' => NumberFormat::FORMAT_NUMBER_00,
        ];
    }
    public function __construct($sales)
    {
        $this->sales = $sales;
    }

    public function headings(): array
    {
        return [
            'Sales ID',
            'Customer Name',
            'Customer Contact',
            'Sales Total',
            'Discount',
            'Payment',
            'Opening Due',
            'Closing Due'
        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */

    public function array(): array
    {
        $data = [];
        foreach ($this->sales as $key => $sale){
            $data[$key]['id'] = $sale->id;
            $data[$key]['customer_name'] = $sale->customer_name;
            $data[$key]['customer_contact1'] = $sale->customer_contact1;
            $data[$key]['sales_total'] = $sale->sales_total;
            $data[$key]['discount_amount'] = $sale->discount_amount;
            $data[$key]['payment'] = $sale->payment;
            $data[$key]['opening_due'] = $sale->opening_due;
            $data[$key]['closing_due'] = $sale->closing_due;
        }
        return $data;
    }
}
