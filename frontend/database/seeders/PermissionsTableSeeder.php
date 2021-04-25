<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 4,
                'name' => 'user_manager',
                'title' => 'Quản lý Người dùng',
                'guard_name' => 'web',
                'created_at' => '2020-09-17 04:34:56',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 5,
                'name' => 'menu_manager',
                'title' => 'Quản lý Menu',
                'guard_name' => 'web',
                'created_at' => '2020-09-17 04:34:58',
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 6,
                'name' => 'role_manager',
                'title' => 'Quản lý nhóm người dùng',
                'guard_name' => 'web',
                'created_at' => '2020-09-17 04:34:59',
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 22,
                'name' => 'logging_manager',
                'title' => 'Theo dõi lịch sử hoạt động',
                'guard_name' => 'web',
                'created_at' => '2020-09-17 04:35:01',
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 41,
                'name' => 'category_manager',
                'title' => 'Quản lý danh mục',
                'guard_name' => 'web',
                'created_at' => '2020-09-17 04:35:03',
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 42,
                'name' => 'device_manager',
                'title' => 'Quản lý thiết bị',
                'guard_name' => 'web',
                'created_at' => '2020-09-17 04:35:04',
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 48,
                'name' => 'monitoring',
                'title' => 'Màn hình giám sát	web	',
                'guard_name' => 'web',
                'created_at' => '2020-09-17 04:35:06',
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 49,
                'name' => 'report',
                'title' => 'Báo cáo & Thống kê',
                'guard_name' => 'web',
                'created_at' => '2020-09-17 04:35:08',
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 50,
                'name' => 'create_plan',
                'title' => 'Cập nhật kế hoạch sản xuất	web',
                'guard_name' => 'web',
                'created_at' => '2020-09-17 04:35:09',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}