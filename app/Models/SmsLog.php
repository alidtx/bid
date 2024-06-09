<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class SmsLog extends Model
{
    protected $guarded = [];

	protected $likeFilterFields = ['name'];

    protected $boolFilterFields = [];

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
        if (isset($filters['age'])) {
            $query->where('age', $filters['age']);
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
