<?php

use App\Models\ProductCharacteristics;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCharacteristicsTable extends Migration {

    private $tableName;

    function __construct() {
        $this->tableName == (new ProductCharacteristics)->getTable();
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->unsigned()->index();
            $table->integer('category_characteristic_id')->unsigned()->index();
            $table->tinyInteger(ProductCharacteristics::COLUMN_BOOLEAN)->default(0)->index();
            $table->float(ProductCharacteristics::COLUMN_NUMERIC)->default(0)->index();
            $table->string(ProductCharacteristics::COLUMN_SHORT_TEXT, 512)->default('')->index();
            $table->mediumText(ProductCharacteristics::COLUMN_TEXT)->default('');
            $table->timestamps();

            $table->unique(['product_id', 'category_characteristic_id'], 'product_category_unique');
        });

        DB::statement("ALTER TABLE `product_characteristics` ADD CONSTRAINT `FK_product_characteristics_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE ON DELETE CASCADE");
        DB::statement("ALTER TABLE `product_characteristics` ADD CONSTRAINT `FK_product_characteristics_category_caracteristics` FOREIGN KEY (`category_characteristic_id`) REFERENCES `category_characteristics` (`id`) ON UPDATE CASCADE ON DELETE CASCADE");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists($this->tableName);
    }

}
