<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TimekeepingTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('timekeeping')->delete();
        
        \DB::table('timekeeping')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 7,
                'get_to_work' => '2021-05-06 17:48:32',
                'get_off_work' => '2021-05-06 17:51:07',
                'working_day' => '2021-05-06',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 8,
                'get_to_work' => '2021-05-06 17:49:19',
                'get_off_work' => '2021-05-06 17:50:55',
                'working_day' => '2021-05-06',
            ),
        ));
        
        
    }
}