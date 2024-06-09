<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\SmsLog;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class SmsLogExport implements  FromQuery, WithMapping, WithHeadings
{

    use Exportable;
 
    public function __construct($query)
    {
        $this->query = $query;
    }

    public function headings(): array
    {
        return [
            '#',
            'From Number',
            'SMS Body',
            'Reply',
            'Status',
            'Date',
            'Time',
        ];
    }

    public function map($SmsLog): array
    {
        return [
            $SmsLog->id,
            $SmsLog->msisdn,
            $SmsLog->sms_body,
            $SmsLog->sms_reply,
            $SmsLog->status,
            Carbon::parse($SmsLog->date)->format('d-M-Y'),
            Carbon::parse($SmsLog->created_at)->format('H:i:s'),
        ];
    }
   
   

    public function query()
    {

        //   dd($this->request->all());
        return $this->query;
    }
}
