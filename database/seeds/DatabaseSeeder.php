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
        if($this->command->confirm("Do you want to refresh the database ?")) {
            //false by default
            $this->command->call("migrate:refresh");
            $this->command->info("database was refreshed !");
        }

        $this->call([
            AdminUserSeeder::class,
            UsersTableSeeder::class,
            ProductTableSeeder::class,
        ]);
    }
}
