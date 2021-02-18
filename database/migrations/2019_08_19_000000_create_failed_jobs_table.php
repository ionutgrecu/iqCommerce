<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFailedJobsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        $tableName = 'failed_jobs';

        if (Schema::hasTable($tableName)) {
            echo "$tableName already exists. Migrate " . __FILE__ . " manually";
            return;
        }

        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('failed_jobs');
    }

}
