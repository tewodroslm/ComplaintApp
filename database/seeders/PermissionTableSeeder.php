<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [ 
            'complaint-create',
            'complaint-edit',
            'user-edit',
            'get-all',
            'get-some'
         ];
      
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
     }
}
