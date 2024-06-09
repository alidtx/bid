<?php

use App\Models\User;
use App\Enums\RoleEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayOfRoleNames = ['super-admin', 'admin', 'viewer'];
        $roles = collect($arrayOfRoleNames)->map(function ($role) {
            return ['name' => $role, 'guard_name' => 'web'];
        });
    
        Role::insert($roles->toArray());

        $user = User::firstOrCreate([
            'name' => 'Super Admin',
            'email' => 'superadmin@admin.com',
            'msisdn' => '8801795514777',
            'password' => Hash::make('12345678'),
            'status' => 1,
        ]);

        $user->assignRole(RoleEnum::SUPERADMIN);
    }
}
