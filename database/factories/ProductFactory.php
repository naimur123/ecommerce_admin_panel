<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Product::class;
    public function definition()
    {
        return [
                "category_id" => 1,
                "subcategory_id"  => 1 ,
                "brand_id" => 1,
                "name" => $this->faker->name,
                "slug" => Str::slug($this->faker->name),
                "code" => 10001,
                "unit_id" => 1,
                // "short_description" => $this->faker->short_description ,
                // "long_description" => $this->faker->long_description  ,
                "price" => 10000,
                // "discount_price" => $this->faker->discount_price  ,
                // "discount_percentage" => $this->faker->discount_percentage  ,
                "currency_id" => 1,
                // "image_one" => $this->faker->image_one,
                // "image_two"=> $this->faker->image_two,
                // "image_three"=> $this->faker->image_three,
                "status_id" => 1
        ];
    }
}
