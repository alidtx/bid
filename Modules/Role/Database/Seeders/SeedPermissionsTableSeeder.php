<?php

namespace Modules\Role\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Modules\Role\Entities\Module;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;


class SeedPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('permissions')->truncate();
        // DB::table('permission_modules')->truncate();
    
        Schema::enableForeignKeyConstraints();
        

        $modules = [
            "User ",
            "Role",
            // "Vendor",
            // "Division",
            // "District",
            // "Area",
            // "Territory",
            // "Zone",
            // "Depo",
            // "Member",
            "Participant",
            "Vote-Count",
          ];

          $permissionArray = ['read', 'create', 'edit', 'delete'];
          $permissions = [];

          foreach ($modules as $module) {

              foreach ($permissionArray as $pf) {
                 
                Permission::create([
                    'name' => $pf.'-'.\strtolower($module), 
                    'guard_name' => 'web',
             
                ]);
              }
          }
          

    }
}
