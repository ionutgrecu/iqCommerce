<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $id = 1;
        $faker = Factory::create();

        ProductCategory::firstOrCreate(['id' => $id], [
            'name' => 'Electronice',
            'description' => $faker->text(512),
            'image' => 'http://placeimg.com/640/480/tech',
        ]);
        $id++;

        ProductCategory::firstOrCreate(['id'=>$id],[
            'category_id'=>1,
            'name'=>'PC & Laptop',
            'description'=>$faker->text(512),
            'image'=>'https://lcdn.mediagalaxy.ro/resize/media/catalog/category//16fa6a9aef7ffd6209d5fd9338ffa0b1/laptopuri_657bf35e.jpg'
        ]);
        $id++;
        
        ProductCategory::firstOrCreate(['id'=>$id],[
            'category_id'=>1,
            'name'=>'Telefoane',
            'description'=>$faker->text(512),
            'image'=>'https://demo.joomdev.com/consult/toolbar/images/j2store/mobiles/products3/img1.jpg'
        ]);
        $id++;
        
        ProductCategory::firstOrCreate(['id'=>$id],[
            'category_id'=>null,
            'name'=>'Haine',
            'description'=>$faker->text(512),
            'image'=>'https://bloximages.newyork1.vip.townnews.com/kmov.com/content/tncms/assets/v3/editorial/9/ed/9ed54d5e-2ca9-11ea-bcae-378392bf1b22/5e0cb7d276c6f.image.jpg'
        ]);
        $id++;
        
        ProductCategory::firstOrCreate(['id'=>$id],[
            'category_id'=>4,
            'name'=>'Tricouri',
            'description'=>$faker->text(512),
            'image'=>'https://www.bestbuysoccer.com/media/catalog/product/cache/01765ef94a394783e04750111339da44/t/-/t-shirt-men-blank-cotton-tee-shirt-man-tshirts-bodybuilding-bulk-plain-chemise-white-crew-neck.jpg'
        ]);
        $id++;
        
        ProductCategory::firstOrCreate(['id'=>$id],[
            'category_id'=>4,
            'name'=>'Pantaloni',
            'description'=>$faker->text(512),
            'image'=>'https://m.media-amazon.com/images/I/71I14Gl79HL._AC_UL320_.jpg'
        ]);
        $id++;
        
        ProductCategory::firstOrCreate(['id'=>$id],[
            'category_id'=>4,
            'name'=>'Cămăși',
            'description'=>$faker->text(512),
            'image'=>'https://i.pinimg.com/originals/13/c3/24/13c3240d254c3fabd3ce4505af0eff8a.jpg'
        ]);
        $id++;
        
        ProductCategory::firstOrCreate(['id'=>$id],[
            'category_id'=>4,
            'name'=>'Geci',
            'description'=>$faker->text(512),
            'image'=>'https://m.media-amazon.com/images/I/41kpS4bT4vL._AC_UL320_.jpg'
        ]);
        $id++;
    }

}
