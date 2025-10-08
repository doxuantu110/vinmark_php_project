<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Rau củ',
                'slug' => 'rau-cu',
                'description' => 'Các loại rau củ tươi ngon hàng ngày',
                'image' => 'uploads/categories/rau-cu.png',
            ],
            [
                'name' => 'Trái cây',
                'slug' => 'trai-cay',
                'description' => 'Trái cây trong nước & nhập khẩu',
                'image' => 'uploads/categories/trai-cay.png',
            ],
            [
                'name' => 'Thịt heo',
                'slug' => 'thit-heo',
                'description' => 'Thịt heo tươi ngon, đảm bảo vệ sinh an toàn thực phẩm',
                'image' => 'uploads/categories/thit-heo.png',
            ],
            [
                'name' => 'Thịt bò',
                'slug' => 'thit-bo',
                'description' => 'Thịt bò tươi, giàu dinh dưỡng, thích hợp cho nhiều món ăn',
                'image' => 'uploads/categories/thit-bo.png',
            ],
            [
                'name' => 'Thịt gà & gia cầm',
                'slug' => 'thit-ga-gia-cam',
                'description' => 'Thịt gà, vịt, và các loại gia cầm khác tươi sống mỗi ngày',
                'image' => 'uploads/categories/thit-ga-gia-cam.png',
            ],
            [
                'name' => 'Cá & hải sản',
                'slug' => 'ca-hai-san',
                'description' => 'Cá biển, cá nước ngọt, hải sản tươi sống',
                'image' => 'uploads/categories/ca-hai-san.png',
            ],
            [
                'name' => 'Trứng',
                'slug' => 'trung',
                'description' => 'Trứng gà, trứng vịt, trứng cút',
                'image' => 'uploads/categories/trung-sua.png',
            ],
            [
                'name' => 'Đồ hộp & thực phẩm chế biến',
                'slug' => 'do-hop-nhu-yeu-pham-che-bien',
                'description' => 'Thực phẩm chế biến, đồ hộp, mì, cháo, giấy ăn,…',
                'image' => 'uploads/categories/do-hop-che-bien.png',
            ],
            [
                'name' => 'Gạo & ngũ cốc',
                'slug' => 'gao-ngu-coc',
                'description' => 'Gạo các loại, ngũ cốc, bột mì, bột gạo',
                'image' => 'uploads/categories/gao-ngu-coc.png',
            ],
            [
                'name' => 'Thực phẩm đông lạnh',
                'slug' => 'thuc-pham-dong-lanh',
                'description' => 'Sản phẩm đông lạnh như cá viên, tôm, đậu,…',
                'image' => 'uploads/categories/dong-lanh.png',
            ],
            [
                'name' => 'Gia vị & dầu ăn',
                'slug' => 'gia-vi-dau-an',
                'description' => 'Gia vị, nước mắm, dầu ăn, mù tạt, muối,…',
                'image' => 'uploads/categories/gia-vi-dau-an.png',
            ],
            [
                'name' => 'Gia dụng & đồ dùng nhà bếp',
                'slug' => 'gia-dung-do-dung-nha-bep',
                'description' => 'Dụng cụ nấu ăn, chén bát, chảo, hộp đựng,…',
                'image' => 'uploads/categories/gia-dung.png',
            ],
            [
                'name' => 'Đồ uống & thực phẩm chức năng',
                'slug' => 'do-uong-thuc-pham-chuc-nang',
                'description' => 'Nước ngọt, trà, cà phê, thực phẩm bổ sung,…',
                'image' => 'uploads/categories/do-uong.png',
            ],
            [
                'name' => 'Bánh kẹo & snack',
                'slug' => 'banh-keo-snack',
                'description' => 'Bánh ngọt, kẹo, bim bim, snack, socola và các loại đồ ăn vặt',
                'image' => 'uploads/categories/banh-keo-snack.png',
            ],
            [
                'name' => 'Mì, cháo, phở ăn liền',
                'slug' => 'mi-chao-pho-an-lien',
                'description' => 'Các loại mì gói, cháo, phở, bún ăn liền tiện lợi',
                'image' => 'uploads/categories/mi-chao-pho-an-lien.png',
            ],
            [
                'name' => 'Nước giải khát có cồn',
                'slug' => 'nuoc-giai-khat-co-con',
                'description' => 'Bia, rượu vang, nước trái cây lên men và đồ uống có cồn',
                'image' => 'uploads/categories/nuoc-giai-khat-co-con.png',
            ],
            [
                'name' => 'Đồ dùng vệ sinh nhà cửa',
                'slug' => 'do-dung-ve-sinh-nha-cua',
                'description' => 'Nước rửa chén, nước lau sàn, bột giặt, giấy vệ sinh,…',
                'image' => 'uploads/categories/ve-sinh-nha-cua.png',
            ],
            [
                'name' => 'Chăm sóc mẹ & bé',
                'slug' => 'cham-soc-me-be',
                'description' => 'Sữa bột, tã, khăn ướt, và sản phẩm chăm sóc mẹ & bé',
                'image' => 'uploads/categories/cham-soc-me-be.png',
            ],
            [
                'name' => 'Sản phẩm mùa lễ',
                'slug' => 'san-pham-mua-le',
                'description' => 'Bánh Trung Thu, quà Tết, giỏ quà, đặc sản vùng miền,…',
                'image' => 'uploads/categories/san-pham-mua-le.png',
            ],
            [
                'name' => 'Thực phẩm chay',
                'slug' => 'thuc-pham-chay',
                'description' => 'Đậu hũ, chả chay, thực phẩm chay ăn liền và đồ chay khô',
                'image' => 'uploads/categories/thuc-pham-chay.png',
            ],
            [
                'name' => 'Khác',
                'slug' => 'khac',
                'description' => 'Các loại thực phẩm & sản phẩm khác',
                'image' => 'uploads/categories/khac.png',
            ],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(
                ['slug' => $cat['slug']],
                $cat
            );
        }
    }
}
