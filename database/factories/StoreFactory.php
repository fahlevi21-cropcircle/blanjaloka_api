<?php

namespace Database\Factories;

use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoreFactory extends Factory
{
    protected $model = Store::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true),
            'description' => $this->faker->words(6, true),
            'category' => $this->faker->words(1, true),
            'owner_id' => $this->faker->numberBetween(1, 10)
        ];
    }
}
