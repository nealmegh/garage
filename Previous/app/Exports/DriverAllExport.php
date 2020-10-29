<?php

namespace App\Exports;



use Maatwebsite\Excel\Concerns\FromArray;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;

use PhpOffice\PhpSpreadsheet\Style\NumberFormat;


class DriverAllExport implements FromArray,  withHeadings, WithColumnFormatting, ShouldAutoSize
{
    private $drivers;

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_NUMBER,
            'F' => NumberFormat::FORMAT_NUMBER_00,
            'G' => NumberFormat::FORMAT_NUMBER_00,
            'H' => NumberFormat::FORMAT_NUMBER_00,
            'I' => NumberFormat::FORMAT_NUMBER_00,
        ];
    }
    public function __construct($drivers)
    {
        $this->drivers = $drivers;
    }

    public function headings(): array
    {
        return [
            'Driver Name',
            'Phone',
            'License',
            'Reference Name',
            'Reference Phone',
            'Loan Due',
            'Rent Due',
            'Damages Due',
            'Case Due'

        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */

    public function array(): array
    {
        $data = [];
        foreach ($this->drivers as $key => $driver){
            $data[$key]['Name'] = $driver->user->name;
            $data[$key]['phone'] = $driver->phone_number;
            $data[$key]['License'] = $driver->license_number;
            $data[$key]['ref_name'] = $driver->ref_name;
            $data[$key]['ref_phone'] = $driver->ref_phone;
            $data[$key]['Loan'] = ($driver->loans != null)?number_format($driver->loans->sum('due_amount'),2):0;
            $data[$key]['Rent'] = ($driver->rents != null)?number_format($driver->rents->sum('due'),2):0;
            $data[$key]['Damage'] = ($driver->damages != null)?number_format($driver->damages->sum('driver_due_amount'),2):0;
            $data[$key]['Case'] = ($driver->cases != null)?number_format($driver->cases()->where('paid_by', '=', 'driver')->sum('due_amount'),2):0;

        }
        return $data;
    }
}
