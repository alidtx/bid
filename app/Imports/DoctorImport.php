<?php

namespace App\Imports;

use App\Models\Doctor;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Maatwebsite\Excel\Concerns\ToCollection;

class DoctorImport implements ToCollection
{
    public function collection(Collection $rows)
    {

        try {
          DB::beginTransaction();
          foreach ($rows as $row) 
          {
  
              $role = Role::firstOrCreate(['name' => $row[4]]);
              $doctor = Doctor::firstOrCreate(
                  ['msisdn' =>  '880'.substr($row[3],-10)],
                  [
                      'name' => trim($row[0]),
                      'designation' => trim($row[1]) ?? '',
                      'address' => trim($row[2]) ?? '',
                      'status' => 1,
                      'created_by' => 1,
                      'updated_by' => 1,
                  ]
              );
              $doctor->assignRole($role);
          }
          DB::commit();
        } catch (\Exception $e) {
          DB::rollback();
          dd($e);
        }
       
    }
}
