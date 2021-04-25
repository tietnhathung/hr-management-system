<?php

namespace Core\Menu\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Core\Menu\Entities\Menu;

class MenuDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $menu = Menu::firstOrCreate(['name' => 'Trang chủ', 'url' => '#', 'parent_id' => 0 ]);
    }
}
