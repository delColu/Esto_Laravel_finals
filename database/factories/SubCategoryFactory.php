<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 *
 */
class SubCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    // 'name',
    //     'description',
    //     'Sub_cat_of',
    //     'catID'
    public function definition(): array
    {
        $category = Category::inRandomOrder()->first();

        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'catID' => $category->catID
        ];
    }
}
