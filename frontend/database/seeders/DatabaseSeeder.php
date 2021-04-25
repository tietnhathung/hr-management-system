<?php

use Database\Seeders\AdLoggingTableSeeder;
use Database\Seeders\AdMenuTableSeeder;
use Database\Seeders\LoggingActivityTableSeeder;
use Database\Seeders\MigrationsTableSeeder;
use Database\Seeders\ModelHasPermissionsTableSeeder;
use Database\Seeders\ModelHasRolesTableSeeder;
use Database\Seeders\PermissionsTableSeeder;
use Database\Seeders\RoleHasPermissionsTableSeeder;
use Database\Seeders\RolesTableSeeder;
use Database\Seeders\UsersTableSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdLoggingTableSeeder::class);
        $this->call(AdMenuTableSeeder::class);
        $this->call(LoggingActivityTableSeeder::class);
        $this->call(MigrationsTableSeeder::class);
        $this->call(ModelHasPermissionsTableSeeder::class);
        $this->call(ModelHasRolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(RoleHasPermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
