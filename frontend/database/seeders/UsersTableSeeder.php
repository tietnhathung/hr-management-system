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
                'created_at' => '2019-05-06 21:53:58.000000',
                'updated_at' => '2020-09-16 05:29:53.000000',
                'status' => 1,
                'position' => 'Nhân viên',
                'address' => 'Phù Yên - Sơn La',
                'deleted_at' => NULL,
                'deleted_by' => 0,
                'created_by' => 0,
                'updated_by' => 6,
            ),
            1 => 
            array (
                'id' => 7,
                'username' => 'tiet_hung',
                'name' => NULL,
                'fullname' => 'Tiết Nhật Hưng',
                'email' => 'anh9ok@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$8frCoVw.76RkNnxKMNa/cuLNlWXuF5lszhbQcE6OhrcLNcY0PY326',
                'avatar' => NULL,
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'status' => 1,
                'position' => 'Nhân viên',
                'address' => NULL,
                'deleted_at' => NULL,
                'deleted_by' => 0,
                'created_by' => 0,
                'updated_by' => 0,
            ),
            2 => 
            array (
                'id' => 8,
                'username' => 'bui_anh',
                'name' => NULL,
                'fullname' => 'Bùi Thị Ánh',
                'email' => 'buianh@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$DWnAS3ho2VCtKuteWjdoL.uv3b2AN0gAmwnWlUxfeqQqkOjeYmkby',
                'avatar' => NULL,
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'status' => 1,
                'position' => 'Nhân viên',
                'address' => NULL,
                'deleted_at' => NULL,
                'deleted_by' => 0,
                'created_by' => 0,
                'updated_by' => 0,
            ),
        ));
        
        
    }
}