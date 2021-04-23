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
                'accesstoken_app' => 'eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOiI2IiwianRpIjoiaHVuZ25xODQiLCJhdWQiOiJ7XCJjb21wYW55SWRcIjoxMyxcImNvbXBhbnlOYW1lXCI6XCJDw7RuZyB0eSDEkGnhu4duIGzhu7FjIFPGoW4gTGFcIixcIm1vYmlsZVwiOlwiMDk3OTc5NjU4NFwiLFwiZnVsbE5hbWVcIjpcIk5ndXnhu4VuIFF14buRYyBIxrBuZ1wiLFwicG9zaXRpb25cIjpcIk5ow6JuIHZpw6puXCIsXCJhdmF0YXJcIjpcImh0dHA6XFwvXFwvMTAzLjEwMS4xNjMuMTIxOjgxODRcXC81c19vbmxpbmVcXC9hdmF0YXJcXC9cXC8yMDE5MDYwN1xcLzIxMjMyOTUxMzUuSlBHXCIsXCJ0eXBlXCI6MSxcImZpcmViYXNlX3Rva2VuXCI6bnVsbCxcInRpbWVMb2dpblwiOlwiMjAxOS0xMC0wMVQwOToxMDo1Ni4yOTZcIixcInVzZXJuYW1lXCI6XCJodW5nbnE4NFwifSJ9.BS5KLuOmuOB34eq6J0iCv8ZMZlhISMkPrI6LALaHFIBOzjDZvu9PYLoQs8jBEHMa6q53QBY1VxZfttXjwFATgQ',
                'app' => 0,
                'firebase_token' => NULL,
                'is_notifications' => 0,
                'default_monitor_id' => 41,
                'deleted_by' => 0,
                'created_by' => 0,
                'updated_by' => 6,
                'section_id' => 0,
            ),
            1 => 
            array (
                'id' => 304,
                'username' => 'hungnq84',
                'name' => NULL,
                'fullname' => 'Tiết Hưng 2',
                'email' => 'anh9ok@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$opZ.Kf828P8anpu1J9fGDu0U/cUZiw/3jwKjRwR61tfzTbLQ3zXle',
                'avatar' => NULL,
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'company_id' => NULL,
                'status' => 0,
                'position' => NULL,
                'address' => NULL,
                'mobile' => '0355120497',
                'deleted_at' => NULL,
                'type' => 1,
                'accesstoken_app' => NULL,
                'app' => 0,
                'firebase_token' => NULL,
                'is_notifications' => 0,
                'default_monitor_id' => NULL,
                'deleted_by' => 0,
                'created_by' => 0,
                'updated_by' => 0,
                'section_id' => 0,
            ),
        ));
        
        
    }
}