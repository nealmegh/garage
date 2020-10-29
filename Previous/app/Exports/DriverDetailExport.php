<?php

namespace App\Exports;


use App\Vehicle;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DriverDetailExport implements FromQuery, withMapping, withHeadings
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
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        return Vehicle::query()->where('id', $this->id);
    }
    public function map($vehicle): array
    {
        return [
            $vehicle->registration_number,
            $vehicle->asset_value,
            $vehicle->rents->sum('collection'),
            $vehicle->rents->sum('due'),
            $vehicle->cases->sum('penalty'),
            $vehicle->sales->sum('sales_total'),
            $vehicle->damages->sum('amount'),
            ($vehicle->rents->sum('collection')-($vehicle->cases->sum('penalty')+$vehicle->sales->sum('sales-total')+$vehicle->damages->sum('amount')))
        ];
    }
}
