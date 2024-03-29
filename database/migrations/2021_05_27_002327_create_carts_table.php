<?php

use App\Models\Cart;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->enum('status', [Cart::STATUS_NEW, Cart::STATUS_FINISHED])->default('new')->index();
            $table->string('session_id')->index();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `carts` ADD CONSTRAINT `FK_carts_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE ON DELETE SET NULL");
        DB::statement("ALTER TABLE `carts` ADD CONSTRAINT `FK_carts_sessions` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON UPDATE CASCADE ON DELETE SET NULL");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('carts');
    }

}
