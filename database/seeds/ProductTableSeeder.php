<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = App\User::all();

        if($users->count() == 0) {
            $this->command->info("please create some users !");
            return;
        }

        $nbProducts = (int)$this->command->ask("How many of product you want generate ?", 10);

        Product::factory($nbProducts)->make()->each(function($product) use ($users) {
            $product->user_id = $users->random()->id;
            $product->save();
        });
    }
}
