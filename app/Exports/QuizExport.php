<?php

namespace App\Exports;

use App\Models\quiz;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class QuizExport implements FromQuery, WithMapping, WithHeadings
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
            'Answer',
            'SMS Reply',
            'Created Date'
        ];
    }

    public function map($quiz): array
    {
        return [
            $quiz ? $quiz->msisdn : '-',
            $quiz ? $quiz->answer : '-',
            $quiz ? $quiz->sms_reply : '-',
            $quiz ? $quiz->created_at : '-',
        ];
    }


    public function query()
    {
        return $this->query;
    }
}
