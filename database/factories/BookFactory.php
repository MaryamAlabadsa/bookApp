<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'listening_times' => $this->faker->numberBetween(1, 1000),
            'image' => $this->faker->imageUrl(),
            'audio' => $this->faker->url(),
            'description' => $this->faker->text,
            'name' => $this->faker->word,
            'writer' => $this->faker->name,
        ];
    }

}
