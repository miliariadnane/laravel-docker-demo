<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = App\User::all();

        if($users->count() ==0){
            $this->command->info("please create default user defined by system !");
            return;
        }

        $nbUsers = (int)$this->command->ask("How many of user you want generate ?", 5);

        User::factory($nbUsers)->create();  
    }
}
