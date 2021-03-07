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
        $tableName = (new Product)->getTable();

        if (Schema::hasTable($tableName)) {
            echo "$tableName already exists. Migrate " . __FILE__ . " manually";
            return;
        }

        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_vendors_id')->nullable()->index();
            $table->timestamps();
        });
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
