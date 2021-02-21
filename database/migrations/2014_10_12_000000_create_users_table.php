<?php

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        $tableName = (new User)->getTable();

        if (Schema::hasTable($tableName)) {
            echo "$tableName already exists. Migrate " . __FILE__ . " manually";
            return;
        }

        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['subscriber', 'author', 'admin', 'superadmin'])->default('subscriber');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        $tableName = (new User)->getTable();

        if (Product::count()) {
            echo "Can't rollback " . __FILE__ . " . The table $tableName has rows.";
            return;
        }

        Schema::dropIfExists($tableName);
    }

}
