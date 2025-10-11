<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Product;

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
    public function definition(): array
    {
        $name = $this->faker->randomElement([
            'Cà chua bi', 'Rau muống', 'Bí đỏ', 'Khoai tây', 'Táo xanh',
            'Xà lách', 'Dưa leo', 'Ớt chuông đỏ', 'Cà rốt', 'Bắp cải',
            'Nho đen', 'Chuối chín', 'Bưởi đỏ', 'Cam sành', 'Dưa hấu',
            'Hành lá', 'Tỏi Lý Sơn', 'Gừng tươi', 'Khoai lang', 'Mướp đắng',
            'Thịt heo ba rọi', 'Thịt bò Úc', 'Cá hồi phi lê', 'Tôm sú', 'Gà ta nguyên con', 'Gạo ST25 5kg',
            'Dầu ăn Tường An 1L',
            'Nước mắm Nam Ngư 500ml',
            'Đường trắng Biên Hòa 1kg',
            'Sữa tươi Vinamilk 1L',
            'Bánh Oreo 133g',
            'Mì Hảo Hảo tôm chua cay',
            'Trứng gà ta hộp 10 quả',
            'Thịt heo ba rọi 500g',
            'Thịt bò Mỹ 300g',
            'Táo Mỹ 1kg',
            'Chuối già 1kg',
            'Cà rốt Đà Lạt 1kg',
            'Rau muống 500g',
            'Cà chua 500g',
            'Nước ngọt Coca-Cola lon 330ml',
            'Bia Heineken lon 330ml',
            'Bánh mì gối Sandwich',
            'Phô mai Con Bò Cười 8 miếng',
            'Cà phê G7 hòa tan 16 gói',
        ]);

        return [
            'name' => ucfirst($name),
            'slug' => Str::slug($name) . '-' . $this->faker->unique()->numberBetween(1, 1000),
            'category_id' => Category::inRandomOrder()->first()->id,
            'description' => $this->faker->sentence(10),
            'price' => $this->faker->randomFloat(2, 10000, 200000),
            'stock' => $this->faker->numberBetween(0, 100),
            'status' => $this->faker->randomElement(['in_stock', 'out_of_stock']),
            'unit' => $this->faker->randomElement(['kg', 'bó', 'túi', 'hộp']),
        ];
    }
}
