<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "date" => $this->faker->dateTimeBetween("now", "+1year"),
            "image" => $this->faker->image("public/storage/", fullPath: false),
            "title" => $this->faker->sentence(),
            "public_id" => $this->faker->uuid(),
            "description" => $this->faker->text(),
            "status" => ["ACTIVE", "INACTIVE", "EXPIRED"][rand(0, 2)],
            "url" => $this->faker->slug(),
            "number_of_pax" => $this->faker->numberBetween(4, 12),
        ];
    }
}
