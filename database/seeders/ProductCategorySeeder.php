<?php

namespace Database\Seeders;

use App\Models\CategoryCharacteristic;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductCharacteristics;
use App\Models\ProductImages;
use App\Models\ProductVendor;
use Arr;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $productId = 0;
        $categoryId = 1;
        $characteristicId = 0;
        $faker = Factory::create('ro_RO');

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
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
            'category_id' => $categoryId,
            'name' => 'Tip sistem',
            'slug' => 'tip-sistem',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
            'category_id' => $categoryId,
            'name' => 'Tip procesor',
            'slug' => 'tip-procesor',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
            'category_id' => $categoryId,
            'name' => 'Frecventa procesor',
            'slug' => 'frecventa-procesor',
            'type' => 'numeric',
            'append' => 'Ghz',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
            'category_id' => $categoryId,
            'name' => 'Socket procesor',
            'slug' => 'socket-procesor',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
            'category_id' => $categoryId,
            'name' => 'Capacitate memorie',
            'slug' => 'capacitate-memorie',
            'type' => 'numeric',
            'append' => 'Gb',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
            'category_id' => $categoryId,
            'name' => 'Tip HDD',
            'slug' => 'tip-hdd',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
            'category_id' => $categoryId,
            'name' => 'Capacitate HDD',
            'slug' => 'capacitate-hdd',
            'type' => 'numeric',
            'append' => 'Gb',
            'is_filter' => 1,
        ]);

        $nameArr = include(dirname(__FILE__) . '/data/pc-laptop/names.php');
        $systemArr = include(dirname(__FILE__) . '/data/pc-laptop/systems.php');
        $cpuTypesArr = include(dirname(__FILE__) . '/data/pc-laptop/cpu-types.php');
        $cpuFreqsArr = include(dirname(__FILE__) . '/data/pc-laptop/cpu-freqs.php');
        $cpuSocketsArr = include(dirname(__FILE__) . '/data/pc-laptop/cpu-sockets.php');
        $memoryCapacitiesArr = include(dirname(__FILE__) . '/data/pc-laptop/memory-capacities.php');
        $hddTypesArr = include(dirname(__FILE__) . '/data/pc-laptop/hdd-types.php');
        $hddSizeArr = include(dirname(__FILE__) . '/data/pc-laptop/hdd-sizes.php');
        $imageArr = include(dirname(__FILE__) . '/data/pc-laptop/images.php');
        for ($i = ++$productId; $i < $productId + 5; $i++) {
            $price = rand(100, 1000) * 10;
            $priceMin = $price * (1 - (rand(0, 30) / 100));

            $product = Product::firstOrCreate(['id' => $i], [
                        'product_vendors_id' => ProductVendor::inRandomOrder()->first()->id,
                        'product_category_id' => $categoryId,
                        'name' => Arr::random($nameArr),
                        'description' => $faker->text(200),
                        'price' => $price,
                        'price_min' => rand(0, 100) < 50 ? $priceMin : 0,
            ]);

            foreach ($systemArr as $value) {
                $count = preg_match("/\\W$value\\W/i", $product->name, $matches);
                if ($count) {
                    ProductCharacteristics::firstOrCreate(['product_id' => $i, 'category_characteristic_id' => CategoryCharacteristic::whereSlug('tip-sistem')->first()->id], ['val_short_text' => $value]);
                    break;
                }
            }

            foreach ($cpuTypesArr as $value) {
                $count = preg_match("/\\W$value\\W/i", $product->name, $matches);
                if ($count) {
                    ProductCharacteristics::firstOrCreate(['product_id' => $i, 'category_characteristic_id' => CategoryCharacteristic::whereSlug('tip-procesor')->first()->id], ['val_short_text' => $value]);
                    break;
                }
            }

            foreach ($cpuFreqsArr as $value) {
                $count = preg_match("/\\W$value(0)? Ghz\\W/i", $product->name, $matches);
                if ($count) {
                    ProductCharacteristics::firstOrCreate(['product_id' => $i, 'category_characteristic_id' => CategoryCharacteristic::whereSlug('frecventa-procesor')->first()->id], ['val_numeric' => $value]);
                    break;
                }
            }

            ProductCharacteristics::firstOrCreate(['product_id' => $i, 'category_characteristic_id' => CategoryCharacteristic::whereSlug('socket-procesor')->first()->id], ['val_short_text' => Arr::random($cpuSocketsArr)]);

            foreach ($memoryCapacitiesArr as $value) {
                $count = preg_match("/\W$value\s?GB\W/i", $product->name, $matches);
                if ($count) {
                    ProductCharacteristics::firstOrCreate(['product_id' => $i, 'category_characteristic_id' => CategoryCharacteristic::whereSlug('capacitate-memorie')->first()->id], ['val_numeric' => $value]);
                    break;
                }
            }

            foreach ($memoryCapacitiesArr as $value) {
                $count = preg_match("/\W$value\W/i", $product->name, $matches);
                if ($count) {
                    ProductCharacteristics::firstOrCreate(['product_id' => $i, 'category_characteristic_id' => CategoryCharacteristic::whereSlug('tip-hdd')->first()->id], ['val_short_text' => $value]);
                    break;
                }
            }

            ProductCharacteristics::firstOrCreate(['product_id' => $i, 'category_characteristic_id' => CategoryCharacteristic::whereSlug('capacitate-hdd')->first()->id], ['val_numeric' => Arr::random($hddSizeArr)]);

            //Images
            $image = new ProductImages;
            $image->fill(['product_id' => $i, 'file' => \Arr::random($imageArr), 'default' => 1]);
            $image->save();
        }
        $productId += $i;
        $categoryId++;

        ProductCategory::firstOrCreate(['id' => $categoryId], [
            'category_id' => 1,
            'name' => 'Telefoane',
            'description' => $faker->text(512),
            'image' => 'https://demo.joomdev.com/consult/toolbar/images/j2store/mobiles/products3/img1.jpg'
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
            'category_id' => $categoryId,
            'name' => 'Memorie RAM',
            'slug' => 'memorie-ram',
            'type' => 'numeric',
            'append' => 'Gb',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
            'category_id' => $categoryId,
            'name' => 'Memorie interna',
            'slug' => 'memorie-interna',
            'type' => 'numeric',
            'append' => 'Gb',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
            'category_id' => $categoryId,
            'name' => 'Dimensiuni ecran',
            'slug' => 'dimensiuni-ecran',
            'type' => 'numeric',
            'append' => 'inch',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
            'category_id' => $categoryId,
            'name' => '3G',
            'slug' => '3g',
            'type' => 'boolean',
            'group' => 'Tehnologii',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
            'category_id' => $categoryId,
            'name' => '4G',
            'slug' => '4g',
            'type' => 'boolean',
            'group' => 'Tehnologii',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
            'category_id' => $categoryId,
            'name' => '5G',
            'slug' => '5g',
            'type' => 'boolean',
            'group' => 'Tehnologii',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
            'category_id' => $categoryId,
            'name' => 'Wi-Fi',
            'slug' => 'wi-fi',
            'type' => 'boolean',
            'group' => 'Conectivitate',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
            'category_id' => $categoryId,
            'name' => 'GPS',
            'slug' => 'gps',
            'type' => 'boolean',
            'group' => 'Conectivitate',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
            'category_id' => $categoryId,
            'name' => 'NFC',
            'slug' => 'nfc',
            'type' => 'boolean',
            'group' => 'Conectivitate',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
            'category_id' => $categoryId,
            'name' => 'Slot-uri SIM',
            'slug' => 'slot-uri-sim',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
            'category_id' => $categoryId,
            'name' => 'Culoare',
            'slug' => 'culoare',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);

        $nameArr = include(dirname(__FILE__) . '/data/phones/names.php');
        $memoryCapacitiesArr = include(dirname(__FILE__) . '/data/phones/memory-capacities.php');
        $internalMemoryCapacitiesArr = include(dirname(__FILE__) . '/data/phones/internalmemory-capacities.php');
        $screenSizesArr = include(dirname(__FILE__) . '/data/phones/screen-sizes.php');
        $colorsArr = include(dirname(__FILE__) . '/data/phones/colors.php');
        for ($i = ++$productId; $i < $productId + 5; $i++) {
            $price = rand(50, 500) * 10;
            $priceMin = $price * (1 - (rand(0, 30) / 100));

            $product=Product::firstOrCreate(['id' => $i], [
                'product_vendors_id' => ProductVendor::inRandomOrder()->first()->id,
                'product_category_id' => $categoryId,
                'name' => Arr::random($nameArr),
                'description' => $faker->text(200),
                'price' => $price,
                'price_min' => rand(0, 100) < 50 ? $priceMin : 0,
            ]);

            foreach ($memoryCapacitiesArr as $value) {
                $count = preg_match("/\W$value\s?GB\W/i", $product->name, $matches);
                if ($count) {
                    ProductCharacteristics::firstOrCreate(['product_id' => $i, 'category_characteristic_id' => CategoryCharacteristic::whereSlug('memorie-ram')->first()->id], ['val_numeric' => $value]);
                    break;
                }
            }
            foreach ($internalMemoryCapacitiesArr as $value) {
                $count = preg_match("/\W$value\s?GB RAM\W/i", $product->name, $matches);
                if ($count) {
                    ProductCharacteristics::firstOrCreate(['product_id' => $i, 'category_characteristic_id' => CategoryCharacteristic::whereSlug('memorie-interna')->first()->id], ['val_numeric' => $value]);
                    break;
                }
            }
            ProductCharacteristics::firstOrCreate(['product_id' => $i, 'category_characteristic_id' => CategoryCharacteristic::whereSlug('dimensiuni-ecran')->first()->id], ['val_numeric' => Arr::random($screenSizesArr)]);
            if (preg_match("/\W3G,\W/i", $product->name, $matches))
                ProductCharacteristics::firstOrCreate(['product_id' => $i, 'category_characteristic_id' => CategoryCharacteristic::whereSlug('3g')->first()->id], ['val_boolean' => 1]);
            if (preg_match("/\W4G,\W/i", $product->name, $matches))
                ProductCharacteristics::firstOrCreate(['product_id' => $i, 'category_characteristic_id' => CategoryCharacteristic::whereSlug('4g')->first()->id], ['val_boolean' => 1]);
            if (preg_match("/\W5G,\W/i", $product->name, $matches))
                ProductCharacteristics::firstOrCreate(['product_id' => $i, 'category_characteristic_id' => CategoryCharacteristic::whereSlug('5g')->first()->id], ['val_boolean' => 1]);
            ProductCharacteristics::firstOrCreate(['product_id' => $i, 'category_characteristic_id' => CategoryCharacteristic::whereSlug('wi-fi')->first()->id], ['val_boolean' => (rand(0, 100) < 50) ? 1 : 0]);
            ProductCharacteristics::firstOrCreate(['product_id' => $i, 'category_characteristic_id' => CategoryCharacteristic::whereSlug('gps')->first()->id], ['val_boolean' => (rand(0, 100) < 50) ? 1 : 0]);
            ProductCharacteristics::firstOrCreate(['product_id' => $i, 'category_characteristic_id' => CategoryCharacteristic::whereSlug('nfc')->first()->id], ['val_boolean' => (rand(0, 100) < 50) ? 1 : 0]);
            if (preg_match("/\Wdual\s*sim,\W/i", $product->name, $matches))
                ProductCharacteristics::firstOrCreate(['product_id' => $i, 'category_characteristic_id' => CategoryCharacteristic::whereSlug('slot-uri-sim')->first()->id], ['val_short_text' => 'Dual sim']);
            else
                ProductCharacteristics::firstOrCreate(['product_id' => $i, 'category_characteristic_id' => CategoryCharacteristic::whereSlug('slot-uri-sim')->first()->id], ['val_short_text' => 'Single sim']);

            foreach ($colorsArr as $value) {
                $count = preg_match("/\W$value\s*/i", $product->name, $matches);
                if ($count) {
                    ProductCharacteristics::firstOrCreate(['product_id' => $i, 'category_characteristic_id' => CategoryCharacteristic::whereSlug('culoare')->first()->id], ['val_short_text' => $value]);

                    if ($imageArr = include(dirname(__FILE__) . "/data/phones/images-".strtolower($value).".php")) {
                        $image = new ProductImages;
                        $image->fill(['product_id' => $i, 'file' => \Arr::random($imageArr), 'default' => 1]);
                        $image->save();
                    }
                    break;
                }
            }
        }
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
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
            'category_id' => $categoryId,
            'name' => 'Pentru',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
            'category_id' => $categoryId,
            'name' => 'Stil',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
            'category_id' => $categoryId,
            'name' => 'Imprimeu',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
            'category_id' => $categoryId,
            'name' => 'Model',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
            'category_id' => $categoryId,
            'name' => 'Material',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
            'category_id' => $categoryId,
            'name' => 'Mărime',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
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
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
            'category_id' => $categoryId,
            'name' => 'Pentru',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
            'category_id' => $categoryId,
            'name' => 'Croială',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
            'category_id' => $categoryId,
            'name' => 'Lungime',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
            'category_id' => $categoryId,
            'name' => 'Mărime',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
            'category_id' => $categoryId,
            'name' => 'Culoare',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
            'category_id' => $categoryId,
            'name' => 'Închidere',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
            'category_id' => $categoryId,
            'name' => 'Material',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
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
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
            'category_id' => $categoryId,
            'name' => 'Lungime mânecă',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
            'category_id' => $categoryId,
            'name' => 'Imprimeu',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
            'category_id' => $categoryId,
            'name' => 'Mărime',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
            'category_id' => $categoryId,
            'name' => 'Culoare',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
            'category_id' => $categoryId,
            'name' => 'Material',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
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
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
            'category_id' => $categoryId,
            'name' => 'Tip',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
            'category_id' => $categoryId,
            'name' => 'Gluga',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
            'category_id' => $categoryId,
            'name' => 'Mărime',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
            'category_id' => $categoryId,
            'name' => 'Culoare',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
            'category_id' => $categoryId,
            'name' => 'Material',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        CategoryCharacteristic::firstOrCreate(['id' => ++$characteristicId], [
            'category_id' => $categoryId,
            'name' => 'Stil',
            'type' => 'short_text',
            'is_filter' => 1,
        ]);
        $categoryId++;
    }

}
