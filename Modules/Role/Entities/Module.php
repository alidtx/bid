<?php

namespace Modules\Role\Entities;

use Illuminate\Database\Eloquent\Model;

use Spatie\Permission\Models\Permission;

class Module extends Model
{


    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\Role\Database\factories\ModuleFactory::new();
    }


    protected $table = 'permission_modules';

    protected $guarded = ['id'];

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'permission_module_id', 'id');
    }
}
