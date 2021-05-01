<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('users')->delete();

        \DB::table('users')->insert(array (
            0 =>
            array (
                'id' => 6,
                'username' => 'admin',
                'name' => 'Admin',
                'fullname' => 'Nguyễn Quốc Hưng',
                'email' => 'hungnq84@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$ccVME.oVsZsLigEr9/DpMuXUqeicKR0iz0e4ytDkh8qXa799LryEu',
                'avatar' => '/avatar//20190607/2123295135.JPG',
                'remember_token' => 'jRRZNZVCVTXqZW0GQRKJQQvjjRKv5p7LSgBMxXXsw780QBTwiZ3GY3BNAEQS',
                'created_at' => '2019-05-06 21:53:58',
                'updated_at' => '2020-09-16 05:29:53',
                'company_id' => '13',
                'status' => 1,
                'position' => 'Nhân viên',
                'address' => 'Phù Yên - Sơn La',
                'mobile' => '0979796584',
                'deleted_at' => NULL,
                'type' => 0,
                'deleted_by' => 0,
                'created_by' => 0,
                'updated_by' => 6,
                'section_id' => 0,
            )
        ));


    }
}
