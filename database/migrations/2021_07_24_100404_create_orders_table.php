<?php

use App\Models\Cart;
use App\Models\Orders;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        $table=(new Orders)->getTable();
        $tableUsers=(new User)->getTable();
        $tableCart=(new Cart)->getTable();
                
        Schema::create($table, function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('cart_id')->unsigned()->nullable();
            $table->enum('status', ['new', 'accepted', 'rejected', 'processed', 'delivered', 'reverted'])->default('new')->index();
            $table->enum('status_paid', ['paid', 'unpaid', 'pending', 'refunded'])->default('unpaid')->index();
            $table->string('name',255);
            $table->string('email',255);
            $table->string('phone',255);
            $table->string('delivery_address');
            $table->decimal('amount', 7, 2)->unsigned();
            
            $table->timestamps();
        });
        
        DB::statement("ALTER TABLE `{$table}` ADD CONSTRAINT `FK_{$table}_{$tableUsers}` FOREIGN KEY (`user_id`) REFERENCES `{$tableUsers}` (`id`) ON UPDATE CASCADE ON DELETE SET NULL");
        DB::statement("ALTER TABLE `{$table}` ADD CONSTRAINT `FK_{$table}_{$tableCart}` FOREIGN KEY (`cart_id`) REFERENCES `{$tableCart}` (`id`) ON UPDATE CASCADE ON DELETE SET NULL");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists((new Orders)->getTable());
    }

}
