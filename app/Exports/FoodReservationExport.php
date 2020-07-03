<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FoodReservationExport implements FromCollection, WithHeadings
{
    private \Illuminate\Support\Collection $collection;
    private array $headers;

    /**
     * FoodReservationExport constructor.
     * @param \Illuminate\Support\Collection $collection
     * @param array $headers
     */
    public function __construct(\Illuminate\Support\Collection $collection, array $headers)
    {
        $this->collection = $collection;
        $this->headers = $headers;
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->collection;
    }

    public function headings(): array
    {
        return $this->headers;
    }
}
