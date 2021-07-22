<?php

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
            $table->string('session_id')->index();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->enum('status', ['new', 'accepted', 'rejected', 'processed', 'delivered', 'reverted'])->default('new');
            $table->enum('status_paid', ['paid', 'unpaid', 'pending', 'refunded'])->default('unpaid');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `carts` ADD CONSTRAINT `FK_carts_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE ON DELETE CASCADE");
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
