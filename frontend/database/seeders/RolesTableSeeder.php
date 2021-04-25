<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 2,
                'name' => 'Quản trị hệ thống',
                'guard_name' => 'web',
                'created_at' => '2019-05-06 21:53:58',
                'updated_at' => '2019-05-20 09:27:45',
                'level' => 1,
            ),
            1 => 
            array (
                'id' => 3,
                'name' => 'Màn hình giám sát',
                'guard_name' => 'web',
                'created_at' => '2020-08-18 23:44:48',
                'updated_at' => '2020-09-16 07:49:17',
                'level' => 1,
            ),
            2 => 
            array (
                'id' => 4,
                'name' => 'Trưởng nhóm sản xuất',
                'guard_name' => 'web',
                'created_at' => '2020-09-16 08:41:15',
                'updated_at' => '2020-09-16 08:41:15',
                'level' => 1,
            ),
        ));
        
        
    }
}