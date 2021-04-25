<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdLoggingTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('ad_logging')->delete();
    }
}
