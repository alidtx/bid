<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $guarded = [];

    /**
     * Query filtering scope.
     * @param Builder $query
     * @param array $filters
     * @return Builder
     */
    public function scopeFilter($query, array $filters = []): Builder
    {
        if (isset($filters['type'])) {
            $query->where('registration_type', $filters['type']);
        }

        if (isset($filters['zone'])) {
            $query->where('zone', $filters['zone']);
        }

        if (isset($filters['mobile_no'])) {
            $query->where('msisdn', $filters['mobile_no']);
        }

        if (isset($filters['class'])) {
            $query->where('class', $filters['class']);
        }

        if (isset($filters['type'])) {
            $query->where('registration_type', $filters['type']);
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
