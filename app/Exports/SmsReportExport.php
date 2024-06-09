<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\VoteCount;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class SmsReportExport implements  FromQuery, WithMapping, WithHeadings
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
            'Status',
            'Created Date'
        ];
    }

    public function map($smsLog): array
    {
        return [
            $smsLog ? $smsLog->name : '-',
            $smsLog ? $smsLog->msisdn : '-',
            $smsLog ? $smsLog->age : '-',
            $smsLog ? $smsLog->class : '-',
            $smsLog ? $smsLog->zone : '-',
            $smsLog ? $smsLog->status : '-',
            $smsLog ? $smsLog->created_at : '-',
        ];
    }


    public function query()
    {
        return $this->query;
    }
}
