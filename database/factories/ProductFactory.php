<?php

namespace Database\Factories;

use App\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence(25),
            'product_quantity' => $this->faker->randomDigitNotNull,
            'price' => $this->faker->randomFloat,
            'sale_price' => $this->faker->randomFloat,
        ];
    }
}
