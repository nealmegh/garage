<?php

namespace App\Exports;



use Maatwebsite\Excel\Concerns\FromArray;

use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;

use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class VehicleAllExport implements FromArray,  withHeadings, WithColumnFormatting
{
    private $vehicles;

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_NUMBER_00,
            'C' => NumberFormat::FORMAT_NUMBER_00,
            'D' => NumberFormat::FORMAT_NUMBER_00,
            'E' => NumberFormat::FORMAT_NUMBER_00,
            'F' => NumberFormat::FORMAT_NUMBER_00,
            'G' => NumberFormat::FORMAT_NUMBER_00,
            'H' => NumberFormat::FORMAT_NUMBER_00,
        ];
    }
    public function __construct($vehicles)
    {
        $this->vehicles = $vehicles;
    }

    public function headings(): array
    {
        return [
            'Registration Number',
            'Asset Value',
            'Income',
            'Due',
            'Case',
            'Maintenance',
            'Damages',
            'Profit'

        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */

    public function array(): array
    {
        $data = [];
        foreach ($this->vehicles as $key => $vehicle){
            $data[$key]['registration_number'] = $vehicle->registration_number;
            $data[$key]['asset_value'] = number_format($vehicle->asset_value, 2);
            $data[$key]['collection'] = number_format($vehicle->rents->sum('collection'),2);
            $data[$key]['due'] = number_format($vehicle->rents->sum('due'),2);
            $data[$key]['case'] = number_format($vehicle->cases->sum('penalty'),2);
            $data[$key]['sales_total'] = number_format($vehicle->sales->sum('sales_total'),2);
            $data[$key]['amount'] = number_format($vehicle->damages->sum('amount'),2);
            $data[$key]['profit'] = number_format(($vehicle->rents->sum('collection')-($vehicle->cases->sum('penalty')+$vehicle->sales->sum('sales-total')+$vehicle->damages->sum('amount'))), 2);
        }
        return $data;
    }
}
