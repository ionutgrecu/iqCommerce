<?php

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartItemsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        $table=(new CartItem)->getTable();
        $tableCart=(new Cart)->getTable();
        $tableProducts=(new Product)->getTable();
        
        Schema::create($table, function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cart_id')->unsigned()->index();
            $table->bigInteger('product_id')->unsigned()->nullable()->index();
            $table->string('product_name', 255);
            $table->decimal('price', 7, 2)->unsigned();
            $table->mediumInteger('qty')->unsigned();
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `{$table}` ADD CONSTRAINT `FK_{$table}_{$tableCart}` FOREIGN KEY (`cart_id`) REFERENCES `{$tableCart}` (`id`) ON UPDATE CASCADE ON DELETE CASCADE");
        DB::statement("ALTER TABLE `{$table}` ADD CONSTRAINT `FK_{$table}_{$tableProducts}` FOREIGN KEY (`product_id`) REFERENCES `{$tableProducts}` (`id`) ON UPDATE CASCADE ON DELETE SET NULL");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists((new CartItem)->getTable());
    }

}
