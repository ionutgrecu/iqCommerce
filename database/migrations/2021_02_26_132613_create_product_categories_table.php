<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCategoriesTable extends Migration {

    public function up() {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category_id')->nullable();
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->string('image', 255)->nullable();
            $table->timestamps();
        });
        
        \DB::statement("ALTER TABLE `product_categories` ADD CONSTRAINT `FK_product_categories_product_categories` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`id`) ON UPDATE CASCADE ON DELETE SET NULL");
    }

    public function down() {
        Schema::dropIfExists('product_categories');
    }

}
