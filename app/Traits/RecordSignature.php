<?php

namespace App\Traits;

use App\Models\User;
use App\Enums\RoleEnum;

trait RecordSignature
{
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->created_by = \Auth::user()->id ?? User::role(RoleEnum::SUPERADMIN)->first()->id;
            $model->updated_by = \Auth::user()->id ?? User::role(RoleEnum::SUPERADMIN)->first()->id;
        });

        static::updating(function ($model) {
            $model->updated_by = \Auth::user()->id ?? User::role(RoleEnum::SUPERADMIN)->first()->id;
        });

    }

}
