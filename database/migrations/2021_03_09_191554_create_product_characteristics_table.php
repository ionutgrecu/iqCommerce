<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCharacteristicsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('product_characteristics', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->unsigned()->index();
            $table->integer('category_characteristic_id')->unsigned()->index();
            $table->tinyInteger('val_boolean')->default(0)->index();
            $table->float('val_numeric')->default(0)->index();
            $table->string('val_short_text', 512)->default('')->index();
            $table->mediumText('val_text')->default('');
            $table->timestamps();
            
            $table->unique(['product_id', 'category_characteristic_id'],'product_category_unique');
        });
        
        \DB::statement("ALTER TABLE `product_characteristics` ADD CONSTRAINT `FK_product_characteristics_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE ON DELETE CASCADE");
        \DB::statement("ALTER TABLE `product_characteristics` ADD CONSTRAINT `FK_product_characteristics_category_caracteristics` FOREIGN KEY (`category_characteristic_id`) REFERENCES `category_characteristics` (`id`) ON UPDATE CASCADE ON DELETE CASCADE");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('product_characteristics');
    }

}
