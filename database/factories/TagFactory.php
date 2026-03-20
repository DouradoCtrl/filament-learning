<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Bezhanov\Faker\Provider\Commerce;
use Faker\Factory as Faker;

class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $faker = Faker::create();
        $faker->addProvider(new Commerce($faker));
        return [
            'tag_name' => strtolower($faker->unique()->department()),
            'created_at' => $faker->dateTime(),
            'updated_at' => $faker->dateTime(),
        ];
    }
}
