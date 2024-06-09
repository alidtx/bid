<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\VoteCount;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class VoteCountExport implements  FromQuery, WithMapping, WithHeadings
{
    use Exportable;
 
    public function __construct($query)
    {
        $this->query = $query;
    }

    public function headings(): array
    {
        return [
            'Participant',
            'Bank Name',
            'Date',
            'Votes',
        ];
    }

    public function map($voteCount): array
    {
        return [
            $voteCount->participant ? $voteCount->participant->name : '-',
            $voteCount->participant ? $voteCount->participant->bank_name : '-',
            Carbon::parse($voteCount->date)->format('d-M-Y'),
            $voteCount->votes
        ];
    }
   
   

    public function query()
    {

        //   dd($this->request->all());
        return $this->query;
    }
}
