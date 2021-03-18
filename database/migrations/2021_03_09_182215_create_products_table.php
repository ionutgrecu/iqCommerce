<?php

use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('product_vendors_id')->unsigned()->nullable();
            $table->integer('product_category_id')->unsigned()->nullable();
            $table->string('name', 255);
            $table->longText('description')->nullable();
            $table->decimal('price', 7, 2, true)->comment('The default price');
            $table->decimal('price_min', 7, 2, true)->nullable()->default(null)->comment('The minimum price below which the virtual agent should not go');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement("ALTER TABLE products ADD FULLTEXT search(name,description)");
        DB::statement("ALTER TABLE `products` ADD CONSTRAINT `FK_product_vendors_id` FOREIGN KEY (`product_vendors_id`) REFERENCES `product_vendors` (`id`) ON UPDATE CASCADE ON DELETE SET NULL");
        DB::statement("ALTER TABLE `products` ADD CONSTRAINT `FK_product_category_id` FOREIGN KEY (`product_category_id`) REFERENCES `product_categories` (`id`) ON UPDATE CASCADE ON DELETE SET NULL");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        $tableName = (new Product)->getTable();

        if (Product::count()) {
            echo "Can't rollback " . __FILE__ . " . The table $tableName has rows.";
            return;
        }

        Schema::dropIfExists($tableName);
    }

}
