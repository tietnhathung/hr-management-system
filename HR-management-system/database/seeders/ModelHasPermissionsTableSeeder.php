<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ModelHasPermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('model_has_permissions')->delete();
        
        \DB::table('model_has_permissions')->insert(array (
            0 => 
            array (
                'permission_id' => 4,
                'model_type' => '',
                'model_id' => 159,
            ),
            1 => 
            array (
                'permission_id' => 4,
                'model_type' => '',
                'model_id' => 171,
            ),
            2 => 
            array (
                'permission_id' => 4,
                'model_type' => '',
                'model_id' => 172,
            ),
            3 => 
            array (
                'permission_id' => 4,
                'model_type' => 'Core\\Menu\\Entities\\Menu',
                'model_id' => 179,
            ),
            4 => 
            array (
                'permission_id' => 5,
                'model_type' => 'Core\\Menu\\Entities\\Menu',
                'model_id' => 180,
            ),
            5 => 
            array (
                'permission_id' => 5,
                'model_type' => 'Core\\Menu\\Entities\\Menu',
                'model_id' => 182,
            ),
            6 => 
            array (
                'permission_id' => 6,
                'model_type' => '',
                'model_id' => 159,
            ),
            7 => 
            array (
                'permission_id' => 6,
                'model_type' => '',
                'model_id' => 171,
            ),
            8 => 
            array (
                'permission_id' => 6,
                'model_type' => '',
                'model_id' => 173,
            ),
            9 => 
            array (
                'permission_id' => 6,
                'model_type' => '',
                'model_id' => 176,
            ),
            10 => 
            array (
                'permission_id' => 22,
                'model_type' => '',
                'model_id' => 159,
            ),
            11 => 
            array (
                'permission_id' => 22,
                'model_type' => '',
                'model_id' => 171,
            ),
            12 => 
            array (
                'permission_id' => 22,
                'model_type' => '',
                'model_id' => 174,
            ),
            13 => 
            array (
                'permission_id' => 22,
                'model_type' => '',
                'model_id' => 176,
            ),
            14 => 
            array (
                'permission_id' => 22,
                'model_type' => 'Core\\Menu\\Entities\\Menu',
                'model_id' => 181,
            ),
            15 => 
            array (
                'permission_id' => 41,
                'model_type' => '',
                'model_id' => 159,
            ),
            16 => 
            array (
                'permission_id' => 41,
                'model_type' => '',
                'model_id' => 164,
            ),
            17 => 
            array (
                'permission_id' => 41,
                'model_type' => '',
                'model_id' => 165,
            ),
            18 => 
            array (
                'permission_id' => 41,
                'model_type' => '',
                'model_id' => 166,
            ),
            19 => 
            array (
                'permission_id' => 41,
                'model_type' => '',
                'model_id' => 167,
            ),
            20 => 
            array (
                'permission_id' => 41,
                'model_type' => '',
                'model_id' => 168,
            ),
            21 => 
            array (
                'permission_id' => 41,
                'model_type' => '',
                'model_id' => 169,
            ),
            22 => 
            array (
                'permission_id' => 41,
                'model_type' => '',
                'model_id' => 170,
            ),
            23 => 
            array (
                'permission_id' => 41,
                'model_type' => '',
                'model_id' => 177,
            ),
            24 => 
            array (
                'permission_id' => 42,
                'model_type' => '',
                'model_id' => 159,
            ),
            25 => 
            array (
                'permission_id' => 48,
                'model_type' => '',
                'model_id' => 159,
            ),
            26 => 
            array (
                'permission_id' => 48,
                'model_type' => '',
                'model_id' => 160,
            ),
            27 => 
            array (
                'permission_id' => 48,
                'model_type' => '',
                'model_id' => 164,
            ),
            28 => 
            array (
                'permission_id' => 49,
                'model_type' => '',
                'model_id' => 159,
            ),
            29 => 
            array (
                'permission_id' => 49,
                'model_type' => '',
                'model_id' => 161,
            ),
            30 => 
            array (
                'permission_id' => 49,
                'model_type' => '',
                'model_id' => 163,
            ),
            31 => 
            array (
                'permission_id' => 49,
                'model_type' => '',
                'model_id' => 175,
            ),
            32 => 
            array (
                'permission_id' => 49,
                'model_type' => '',
                'model_id' => 176,
            ),
            33 => 
            array (
                'permission_id' => 49,
                'model_type' => '',
                'model_id' => 178,
            ),
            34 => 
            array (
                'permission_id' => 50,
                'model_type' => '',
                'model_id' => 159,
            ),
            35 => 
            array (
                'permission_id' => 50,
                'model_type' => '',
                'model_id' => 162,
            ),
            36 => 
            array (
                'permission_id' => 50,
                'model_type' => '',
                'model_id' => 164,
            ),
            37 => 
            array (
                'permission_id' => 50,
                'model_type' => '',
                'model_id' => 175,
            ),
            38 => 
            array (
                'permission_id' => 50,
                'model_type' => '',
                'model_id' => 176,
            ),
        ));
        
        
    }
}