<?php

namespace App\Exports;


use App\Driver;

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
            'Driver Name',
            'License Number',
            'Phone Number',
            'Total Rent Collected',
            'Total Rent Due',
            'Damage Due',
            'Case Due',
            'Loan Due'
        ];
    }
    /**
    * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Support\Collection
    */
    public function query()
    {
        return Driver::query()->where('id', $this->id);
    }
    public function map($driver): array
    {
        return [
            $driver->user->name,
            $driver->license_number,
            $driver->phone_number,
            $driver->rents->sum('collection'),
            $driver->rents->sum('due'),
            $driver->cases->sum('due_amount'),
            $driver->damages->sum('driver_due_amount'),
            $driver->loans->sum('due_amount'),
        ];
    }
}
