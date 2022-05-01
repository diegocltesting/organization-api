<?php

namespace Database\Factories;

use App\Models\Division;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Division>
 */
class DivisionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->jobTitle(),
            'ambassador' => $this->faker->optional($weigth = 0.5, $default = '')->name,
            'collaborators' => $this->faker->numberBetween(1, 20),
            'level' => $this->faker->numberBetween(1, 20),
            'parent_id' => Division::all()->count() > 1 ? $this->faker->randomElement(Division::all()->pluck('id')) : 0
        ];
    }
}
