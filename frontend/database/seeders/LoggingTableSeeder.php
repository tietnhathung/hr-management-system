<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LoggingTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('logging')->delete();
        
        \DB::table('logging')->insert(array (
            0 => 
            array (
                'id' => 1,
                'userId' => 6,
                'level' => 1,
                'method' => '',
                'action' => 'Thêm người dùng ',
                'detail' => 'Tiết Nhật Hưng',
                'created_at' => '2021-05-01 11:05:19',
                'created_by' => 6,
                'type' => 2,
            ),
            1 => 
            array (
                'id' => 2,
                'userId' => 6,
                'level' => 1,
                'method' => '',
                'action' => 'Thêm người dùng ',
                'detail' => 'Bùi Thị Ánh',
                'created_at' => '2021-05-01 11:06:12',
                'created_by' => 6,
                'type' => 2,
            ),
            2 => 
            array (
                'id' => 3,
                'userId' => 6,
                'level' => 1,
                'method' => '',
                'action' => 'Add new menu ',
                'detail' => 'Bảo công',
                'created_at' => '2021-05-06 22:31:50',
                'created_by' => 6,
                'type' => 2,
            ),
        ));
        
        
    }
}