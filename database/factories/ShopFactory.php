<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\Shop;
use App\Models\SubCategory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shop>
 */
class ShopFactory extends Factory
{
    protected $model = Shop::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = Category::inRandomOrder()->first();  // ← get one category only once
        $subCat = SubCategory::where('catID', $category->catID)
                             ->inRandomOrder()
                             ->first()
               ?? SubCategory::factory()->create([
                       'catID' => $category->catID
                  ]);


        return [
            'Owner_fname'   => $this->faker->firstName(),
            'Owner_lname'   => $this->faker->lastName(),
            'shopname'      => $this->faker->company(),
            'Item_category' => $category->name,      // reuse same category
            'catID'         => $category->catID,     // reuse same category
            'subCat'        => $subCat?->name,
            'subCatID'      => $subCat?->SubCatID,
        ];
    }
}
