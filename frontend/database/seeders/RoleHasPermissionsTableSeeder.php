<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleHasPermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('role_has_permissions')->delete();
        
        \DB::table('role_has_permissions')->insert(array (
            0 => 
            array (
                'permission_id' => 4,
                'role_id' => 2,
            ),
            1 => 
            array (
                'permission_id' => 5,
                'role_id' => 2,
            ),
            2 => 
            array (
                'permission_id' => 6,
                'role_id' => 2,
            ),
            3 => 
            array (
                'permission_id' => 22,
                'role_id' => 0,
            ),
            4 => 
            array (
                'permission_id' => 22,
                'role_id' => 2,
            ),
            5 => 
            array (
                'permission_id' => 41,
                'role_id' => 2,
            ),
            6 => 
            array (
                'permission_id' => 42,
                'role_id' => 2,
            ),
            7 => 
            array (
                'permission_id' => 48,
                'role_id' => 2,
            ),
            8 => 
            array (
                'permission_id' => 48,
                'role_id' => 3,
            ),
            9 => 
            array (
                'permission_id' => 48,
                'role_id' => 4,
            ),
            10 => 
            array (
                'permission_id' => 49,
                'role_id' => 2,
            ),
            11 => 
            array (
                'permission_id' => 49,
                'role_id' => 4,
            ),
            12 => 
            array (
                'permission_id' => 50,
                'role_id' => 2,
            ),
            13 => 
            array (
                'permission_id' => 50,
                'role_id' => 4,
            ),
        ));
        
        
    }
}