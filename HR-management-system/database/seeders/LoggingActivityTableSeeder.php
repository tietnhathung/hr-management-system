<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LoggingActivityTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('logging_activity')->delete();
        
        
        
    }
}