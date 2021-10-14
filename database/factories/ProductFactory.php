<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Bezhanov\Faker\Provider\Commerce;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $this->faker->addProvider(new Commerce($this->faker));
        return [
            //
            'name' => $this->faker->productName,
            'description' => $this->faker->text(),
            //'category' => $this->faker->words(3, true),
            'price' => $this->faker->numberBetween(1000, 100000),
            'measure' => $this->faker->words(1, true),
            'category' => $this->faker->department(6, true),
            'stock' => $this->faker->numberBetween(1, 100),
            'picture' => $this->faker->imageUrl(900, 650, 'food'),
            'store_id' => $this->faker->numberBetween(1, 10)
        ];
    }
}
