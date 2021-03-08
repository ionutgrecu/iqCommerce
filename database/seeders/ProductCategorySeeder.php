<?php

namespace Database\Seeders;

use App\Models\CategoryCharacteristic;
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
        $categoryId = 1;
        $characteristicId = 0;
        $faker = Factory::create();

        ProductCategory::firstOrCreate(['id' => $categoryId], [
            'name' => 'Electronice',
            'description' => $faker->text(512),
            'image' => 'http://placeimg.com/640/480/tech',
        ]);
        $categoryId++;

        ProductCategory::firstOrCreate(['id' => $categoryId], [
            'category_id' => 1,
            'name' => 'PC & Laptop',
            'description' => $faker->text(512),
            'image' => 'https://lcdn.mediagalaxy.ro/resize/media/catalog/category//16fa6a9aef7ffd6209d5fd9338ffa0b1/laptopuri_657bf35e.jpg'
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => 'Tip sistem',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => 'Tip procesor',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => 'Frecventa procesor',
            'type' => 'numeric',
            'append_field'=>'Ghz',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => 'Socket procesor',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => 'Capacitate memorie',
            'type' => 'numeric',
            'append_field'=>'Gb',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => 'Tip HDD',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => 'Capacitate HDD',
            'type' => 'numeric',
            'append_field'=>'Gb',
            'is_filter' => 1,
        ]);
        $categoryId++;

        ProductCategory::firstOrCreate(['id' => $categoryId], [
            'category_id' => 1,
            'name' => 'Telefoane',
            'description' => $faker->text(512),
            'image' => 'https://demo.joomdev.com/consult/toolbar/images/j2store/mobiles/products3/img1.jpg'
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => 'Memorie RAM',
            'type' => 'numeric',
            'append_field'=>'Gb',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => 'Memorie interna',
            'type' => 'numeric',
            'append_field'=>'Gb',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => 'Dimensiuni ecran',
            'type' => 'numeric',
            'append_field'=>'inch',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => '3G',
            'type' => 'boolean',
            'group'=>'Tehnologii',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => '4G',
            'type' => 'boolean',
            'group'=>'Tehnologii',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => '5G',
            'type' => 'boolean',
            'group'=>'Tehnologii',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => 'Wi-Fi',
            'type' => 'boolean',
            'group'=>'Conectivitate',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => 'GPS',
            'type' => 'boolean',
            'group'=>'Conectivitate',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => 'NFC',
            'type' => 'boolean',
            'group'=>'Conectivitate',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => 'Slot-uri SIM',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => 'Culoare',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        $categoryId++;

        ProductCategory::firstOrCreate(['id' => $categoryId], [
            'category_id' => null,
            'name' => 'Haine',
            'description' => $faker->text(512),
            'image' => 'https://bloximages.newyork1.vip.townnews.com/kmov.com/content/tncms/assets/v3/editorial/9/ed/9ed54d5e-2ca9-11ea-bcae-378392bf1b22/5e0cb7d276c6f.image.jpg'
        ]);
        $categoryId++;

        ProductCategory::firstOrCreate(['id' => $categoryId], [
            'category_id' => 4,
            'name' => 'Tricouri',
            'description' => $faker->text(512),
            'image' => 'https://www.bestbuysoccer.com/media/catalog/product/cache/01765ef94a394783e04750111339da44/t/-/t-shirt-men-blank-cotton-tee-shirt-man-tshirts-bodybuilding-bulk-plain-chemise-white-crew-neck.jpg'
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => 'Pentru',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => 'Stil',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => 'Imprimeu',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => 'Model',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => 'Material',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => 'Mărime',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => 'Culoare',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        $categoryId++;

        ProductCategory::firstOrCreate(['id' => $categoryId], [
            'category_id' => 4,
            'name' => 'Pantaloni',
            'description' => $faker->text(512),
            'image' => 'https://m.media-amazon.com/images/I/71I14Gl79HL._AC_UL320_.jpg'
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => 'Pentru',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => 'Croială',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => 'Lungime',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => 'Mărime',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => 'Culoare',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => 'Închidere',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => 'Material',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => 'Stil',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        $categoryId++;

        ProductCategory::firstOrCreate(['id' => $categoryId], [
            'category_id' => 4,
            'name' => 'Cămăși',
            'description' => $faker->text(512),
            'image' => 'https://i.pinimg.com/originals/13/c3/24/13c3240d254c3fabd3ce4505af0eff8a.jpg'
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => 'Lungime mânecă',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => 'Imprimeu',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => 'Mărime',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => 'Culoare',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => 'Material',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => 'Stil',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        $categoryId++;

        ProductCategory::firstOrCreate(['id' => $categoryId], [
            'category_id' => 4,
            'name' => 'Geci',
            'description' => $faker->text(512),
            'image' => 'https://m.media-amazon.com/images/I/41kpS4bT4vL._AC_UL320_.jpg'
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => 'Tip',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => 'Gluga',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => 'Mărime',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => 'Culoare',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => 'Material',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => 'Stil',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => $characteristicId++], [
            'category_id' => $categoryId,
            'name' => 'Tip',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        $categoryId++;
    }

}
