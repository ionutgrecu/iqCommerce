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
            $table->bigInteger('product_vendors_id')->unsigned()->nullable()->index();
            $table->bigInteger('product_category_id')->unsigned()->nullable()->index();
            $table->string('name',255);
            $table->longText('description')->nullable();
            $table->decimal('price',6,2,true)->comment('The default price');
            $table->decimal('price_min',6,2,true)->nullable()->default(null)->comment('The minimum price below which the virtual agent should not go');
            $table->timestamps();
            $table->softDeletes();
        });
        
        \DB::statement("ALTER TABLE products ADD FULLTEXT search(name,description)");
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
