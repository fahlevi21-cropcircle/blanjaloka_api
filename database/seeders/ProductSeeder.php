<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Product::factory()
            ->count(25)
            ->create();
    }

    private function manual()
    {
        $data = [
            [
                'name' => 'Banana',
                'description' => 'A great snack in a handy yellow skin! Bananas are a good source of energy and contain lots of vitamins and minerals, especially potassium.',
                'price' => 15000,
                'measure' => 'Unit',
                'stock' => 15,
                'picture' => 'https://images.unsplash.com/photo-1571771894821-ce9b6c11b08e?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=600&ixid=MnwxfDB8MXxyYW5kb218MHx8fHx8fHx8MTYzMzkzMDQ2Mg&ixlib=rb-1.2.1&q=80&utm_campaign=api-credit&utm_medium=referral&utm_source=unsplash_source&w=900'
            ],

            [
                'name' => 'Apple',
                'description' => 'Did you know there are thousands of different types of apples? Granny Smith, Royal Gala, Golden Delicious and Pink Lady are just a few that are grown around the world.',
                'price' => 9000,
                'measure' => 'Unit',
                'stock' => 33,
                'picture' => 'https://images.unsplash.com/photo-1568702846914-96b305d2aaeb?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=600&ixid=MnwxfDB8MXxyYW5kb218MHx8fHx8fHx8MTYzMzkzMzg4Mw&ixlib=rb-1.2.1&q=80&utm_campaign=api-credit&utm_medium=referral&utm_source=unsplash_source&w=900'
            ],

            [
                'name' => 'Mango',
                'description' => 'Mangoes come in many different shapes and sizes. There are more than 2,500 different kinds of mango and they are an excellent source of vitamin C. Peel off the skin to eat the soft, juicy flesh inside. Why not add some to your next stir-fry? Can you guess which country grows the most mangoes in the world?',
                'price' => 8500,
                'measure' => 'Unit',
                'stock' => 7,
                'picture' => 'https://images.unsplash.com/photo-1571771894821-ce9b6c11b08e?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=600&ixid=MnwxfDB8MXxyYW5kb218MHx8fHx8fHx8MTYzMzkzMDQ2Mg&ixlib=rb-1.2.1&q=80&utm_campaign=api-credit&utm_medium=referral&utm_source=unsplash_source&w=900'
            ],

            [
                'name' => 'Tomato',
                'description' => 'The long debate – is it a fruit or a vegetable? Answer – it’s definitely a fruit and that’s because it has seeds and grows from the flower of a plant.',
                'price' => 4500,
                'measure' => 'Unit',
                'stock' => 35,
                'picture' => 'https://images.unsplash.com/photo-1607305387299-a3d9611cd469?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=600&ixid=MnwxfDB8MXxyYW5kb218MHx8fHx8fHx8MTYzMzkzNDc0Nw&ixlib=rb-1.2.1&q=80&utm_campaign=api-credit&utm_medium=referral&utm_source=unsplash_source&w=900'
            ],

            [
                'name' => 'Pumpkin',
                'description' => 'Although we associate pumpkins with Halloween, they’re a versatile fruit that can be boiled, baked, roasted or mashed, and make delicious soups and the classic American pumpkin pie. ',
                'price' => 30000,
                'measure' => 'Unit',
                'stock' => 4,
                'picture' => 'https://images.unsplash.com/photo-1570586437263-ab629fccc818?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=600&ixid=MnwxfDB8MXxyYW5kb218MHx8fHx8fHx8MTYzMzkzNDgxOA&ixlib=rb-1.2.1&q=80&utm_campaign=api-credit&utm_medium=referral&utm_source=unsplash_source&w=900'
            ],

            [
                'name' => 'Pineapple',
                'description' => 'It can take two years to grow a pineapple – so savour them! This rough, spiky fruit is actually made up of lots of smaller fruit that have stuck together. Explorers chose the name because they thought the fruit looked like a pinecone.',
                'price' => 13000,
                'measure' => 'Unit',
                'stock' => 23,
                'picture' => 'https://images.unsplash.com/photo-1490885578174-acda8905c2c6?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=600&ixid=MnwxfDB8MXxyYW5kb218MHx8fHx8fHx8MTYzMzkzNDQxMg&ixlib=rb-1.2.1&q=80&utm_campaign=api-credit&utm_medium=referral&utm_source=unsplash_source&w=900'
            ],
        ];

        for ($i = 0; $i < count($data); $i++) {
            # code...
            Product::query()->create($data[$i]);
        }
    }
}
