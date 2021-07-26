<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsersExtradata extends Migration {

    public function up() {
        $tableName = (new User)->getTable();

        Schema::table($tableName, function (Blueprint $table) {
            $table->string('phone', 32)->index()->nullable()->after('password');
            $table->string('delivery_address')->nullable()->after('phone');
        });
    }

    public function down() {
        $tableName = (new User)->getTable();

        Schema::table($tableName, function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->dropColumn('delivery_address');
        });
    }

}
