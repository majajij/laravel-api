<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
		"title" => $this->faker->title(), 
		"short_desc" =>$this->faker->sentence(),
		"desc" => $this->faker->paragraph()
        ];
    }
}
