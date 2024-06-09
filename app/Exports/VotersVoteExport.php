<?php

namespace App\Exports;

use App\Models\SmsLog;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class VotersVoteExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;
 
    public function __construct($query)
    {
        $this->query = $query;
    }

    public function headings(): array
    {
        return [
            'Mobile Number',
            'Total Votes'
        ];
    }

    public function map($item): array
    {
        return [
            $item ? $item->msisdn : '-',
            $item ? $item->total : '-',
        ];
    }
   
   

    public function query()
    {

        //   dd($this->request->all());
        return $this->query;
    }
}

