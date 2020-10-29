<?php

namespace App\Exports;


use App\Vehicle;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class VehicleDetailExport implements FromQuery, withMapping, withHeadings, ShouldAutoSize
{
    use Exportable;
    private $id;
    public function __construct($id)
    {
        $this->id = $id;
    }
    public function headings(): array
    {
        return [
            'Vehicle Registration',
            'Fitness',
            'Insurance',
            'Tax Token',
            'Route Permit',
            'Total Collected Rent',
            'Total Rent Due',

        ];
    }
    /**
    * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Support\Collection
    */
    public function query()
    {
        // $test = Vehicle::query()->where('id', $this->id);
        // dd($test);
        return Vehicle::query()->where('id', $this->id);
    }
    public function map($vehicle): array
    {
        return [
            $vehicle->registration_number,
            $vehicle->fitness_number,
            $vehicle->insurance_number,
            $vehicle->tax_token,
            $vehicle->route_permit_number,
            $vehicle->rents->sum('collection'),
            $vehicle->rents->sum('due'), 
        ];
    }
}
