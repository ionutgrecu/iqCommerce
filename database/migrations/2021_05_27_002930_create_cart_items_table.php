<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cart_id')->unsigned()->index(); 
            $table->bigInteger('product_id')->unsigned()->nullable()->index();
            $table->string('product_name',255);
            $table->decimal('price',2)->unsigned();
            $table->mediumInteger('qty')->unsigned();
            $table->timestamps();
        });
        
        \DB::statement("ALTER TABLE `cart_items` ADD CONSTRAINT `FK_cart_items_cart` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON UPDATE CASCADE ON DELETE CASCADE");
        \DB::statement("ALTER TABLE `cart_items` ADD CONSTRAINT `FK_cart_items_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE ON DELETE SET NULL");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
}
