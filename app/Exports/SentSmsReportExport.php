<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\VoteCount;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class SentSmsReportExport implements  FromQuery, WithMapping, WithHeadings
{
    use Exportable;

    public function __construct($query)
    {
        $this->query = $query;

    }

    public function headings(): array
    {
        return [
            'Mobile No',
            'Division',
            'SMS Body',
            'Status',
            'Created Date'
        ];
    }

    public function map($smsLog): array
    {
        return [
            $smsLog ? $smsLog->msisdn : '-',
            $smsLog ? $smsLog->zone : '-',
            $smsLog ? $smsLog->sms_body : '-',
            $smsLog ? $smsLog->status : '-',
            $smsLog ? $smsLog->created_at : '-',
        ];
    }


    public function query()
    {
        return $this->query;
    }
}
