<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Pastikan ada kategori yang tersedia untuk dihubungkan
        if (Category::count() === 0) {
            // Jika tidak ada kategori, buat satu dummy
            Category::factory()->create();
        }

        $name = $this->faker->words(3, true) . ' ' . $this->faker->numberBetween(100, 999);
        
        return [
            'category_id' => Category::inRandomOrder()->first()->id,
            'name' => $name,
            'slug' => Str::slug($name . '-' . Str::random(5)), // Tambahkan string acak agar slug unik
            'description' => $this->faker->paragraph(3),
            'price' => $this->faker->numberBetween(1000000, 50000000),
            'stock' => $this->faker->numberBetween(0, 50),
            'image_url' => null, // Biarkan null, atau atur ke dummy image path jika ada
        ];
    }
}