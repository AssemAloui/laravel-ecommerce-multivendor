<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Bezhanov\Faker\Provider\Commerce;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $this->faker->addProvider(new Commerce($this->faker));

        $name = $this->faker->department;

        return [
            "name"=> $name,
            "slug"=> Str::slug($name),
            "description"=> $this->faker->sentence(15),
            "image"=> $this->faker->imageUrl,
        ];
    }
}
