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
        
        \DB::table('ad_logging')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 6,
                'action' => 'Đăng nhập thành công.',
                'detail' => 'username = admin',
                'ip' => '127.0.0.1',
            'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36',
                'type' => 1,
                'created_at' => '2021-05-01 03:54:00',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => NULL,
                'action' => 'Đăng nhập lỗi.',
                'detail' => 'username = hungnq84',
                'ip' => '127.0.0.1',
            'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36',
                'type' => 2,
                'created_at' => '2021-05-06 15:26:30',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 6,
                'action' => 'Đăng nhập thành công.',
                'detail' => 'username = admin',
                'ip' => '127.0.0.1',
            'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36',
                'type' => 1,
                'created_at' => '2021-05-06 15:26:35',
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 6,
                'action' => 'Đăng nhập thành công.',
                'detail' => 'username = admin',
                'ip' => '127.0.0.1',
            'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36',
                'type' => 1,
                'created_at' => '2021-05-11 12:23:05',
            ),
            4 => 
            array (
                'id' => 5,
                'user_id' => 6,
                'action' => 'Đăng nhập thành công.',
                'detail' => 'username = admin',
                'ip' => '127.0.0.1',
            'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36',
                'type' => 1,
                'created_at' => '2021-05-12 13:40:37',
            ),
        ));
        
        
    }
}