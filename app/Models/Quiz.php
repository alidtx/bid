<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class Quiz extends Model
{
    protected $guarded = [];

    protected $table = 'quiz';

    public function scopeFilter($query, array $filters = []): Builder
    {
        
        if (isset($filters['type'])) {
            $query->where('registration_type', $filters['type']);
        }

        if (isset($filters['zone'])) {
            $query->where('zone', $filters['zone']);
        }

        if (isset($filters['phone_number'])) {
            $query->where('msisdn', $filters['phone_number']);
        }

        if (isset($filters['class'])) {
            $query->where('class', $filters['class']);
        }

        if (isset($filters['from_date'])) {
            $query->whereDate('created_at', '>=', dateConvertFormtoDB($filters['from_date']));
        }

        if (isset($filters['to_date'])) {
            $query->whereDate('created_at', '<=', dateConvertFormtoDB($filters['to_date']));
        }

        return $query;
    }
}



