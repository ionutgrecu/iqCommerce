<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductVendorsSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $faker = \Faker\Factory::create();

        for($id=1;$id<26;$id++)
        \App\Models\ProductVendor::firstOrCreate(['id' => $id],[
            'name'=>$faker->company,
            'image'=>'https://logoipsum.com/logo/logo-'. $id.'.svg'
        ]);
        
    }

}
