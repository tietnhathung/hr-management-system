<?php

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
        $this->call(LoggingTableSeeder::class);
        $this->call(LoggingActivityTableSeeder::class);
        $this->call(MigrationsTableSeeder::class);
        $this->call(ModelHasPermissionsTableSeeder::class);
        $this->call(ModelHasRolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(RoleHasPermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(TimekeepingTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
