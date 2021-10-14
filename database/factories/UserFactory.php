<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $firstName = $this->faker->unique()->firstName();
        $username = strtolower($firstName);
        return [
            'username' => $username,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('12345678'),
            'first_name' => $firstName,
            'last_name' => $this->faker->lastName(),
            'address' => $this->faker->address()
        ];
    }
}
