<?php

namespace App\Exports;

use App\Models\Participant;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ParticipantExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;

    public function __construct($query)
    {
        $this->query = $query;

    }

    public function headings(): array
    {
        return [
            'Name',
            'Mobile No',
            'Age',
            'Class',
            'Division',
            'Type',
            'Created Date'
        ];
    }

    public function map($participant): array
    {
        return [
            $participant ? $participant->name : '-',
            $participant ? $participant->msisdn : '-',
            $participant ? $participant->age : '-',
            $participant ? $participant->class : '-',
            $participant ? $participant->zone : '-',
            $participant ? $participant->registration_type : '-',
            $participant ? $participant->created_at : '-',
        ];
    }


    public function query()
    {
        return $this->query;
    }
}
