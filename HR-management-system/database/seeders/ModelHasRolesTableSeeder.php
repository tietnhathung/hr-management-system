<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ModelHasRolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('model_has_roles')->delete();
        
        \DB::table('model_has_roles')->insert(array (
            0 => 
            array (
                'role_id' => 2,
                'model_type' => '',
                'model_id' => 0,
            ),
            1 => 
            array (
                'role_id' => 2,
                'model_type' => 'App\\Models\\User',
                'model_id' => 6,
            ),
            2 => 
            array (
                'role_id' => 2,
                'model_type' => 'App\\User',
                'model_id' => 6,
            ),
            3 => 
            array (
                'role_id' => 2,
                'model_type' => 'App\\User',
                'model_id' => 282,
            ),
            4 => 
            array (
                'role_id' => 2,
                'model_type' => 'App\\User',
                'model_id' => 283,
            ),
            5 => 
            array (
                'role_id' => 2,
                'model_type' => 'App\\User',
                'model_id' => 284,
            ),
            6 => 
            array (
                'role_id' => 2,
                'model_type' => 'App\\User',
                'model_id' => 285,
            ),
            7 => 
            array (
                'role_id' => 2,
                'model_type' => 'App\\User',
                'model_id' => 293,
            ),
            8 => 
            array (
                'role_id' => 2,
                'model_type' => 'App\\User',
                'model_id' => 295,
            ),
            9 => 
            array (
                'role_id' => 2,
                'model_type' => 'App\\User',
                'model_id' => 296,
            ),
            10 => 
            array (
                'role_id' => 2,
                'model_type' => 'App\\User',
                'model_id' => 299,
            ),
            11 => 
            array (
                'role_id' => 2,
                'model_type' => 'App\\User',
                'model_id' => 302,
            ),
            12 => 
            array (
                'role_id' => 2,
                'model_type' => 'App\\User',
                'model_id' => 303,
            ),
            13 => 
            array (
                'role_id' => 3,
                'model_type' => 'App\\User',
                'model_id' => 287,
            ),
            14 => 
            array (
                'role_id' => 3,
                'model_type' => 'App\\User',
                'model_id' => 290,
            ),
            15 => 
            array (
                'role_id' => 3,
                'model_type' => 'App\\User',
                'model_id' => 292,
            ),
            16 => 
            array (
                'role_id' => 3,
                'model_type' => 'App\\User',
                'model_id' => 295,
            ),
            17 => 
            array (
                'role_id' => 3,
                'model_type' => 'App\\User',
                'model_id' => 299,
            ),
            18 => 
            array (
                'role_id' => 3,
                'model_type' => 'App\\User',
                'model_id' => 302,
            ),
            19 => 
            array (
                'role_id' => 3,
                'model_type' => 'App\\User',
                'model_id' => 303,
            ),
            20 => 
            array (
                'role_id' => 4,
                'model_type' => 'App\\User',
                'model_id' => 288,
            ),
            21 => 
            array (
                'role_id' => 4,
                'model_type' => 'App\\User',
                'model_id' => 291,
            ),
            22 => 
            array (
                'role_id' => 4,
                'model_type' => 'App\\User',
                'model_id' => 292,
            ),
            23 => 
            array (
                'role_id' => 4,
                'model_type' => 'App\\User',
                'model_id' => 295,
            ),
            24 => 
            array (
                'role_id' => 4,
                'model_type' => 'App\\User',
                'model_id' => 299,
            ),
            25 => 
            array (
                'role_id' => 4,
                'model_type' => 'App\\User',
                'model_id' => 302,
            ),
            26 => 
            array (
                'role_id' => 4,
                'model_type' => 'App\\User',
                'model_id' => 303,
            ),
        ));
        
        
    }
}