<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryCharacteristicsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('category_characteristics', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->nullable()->index();
            $table->string('name',255)->index();
            $table->string('group',255)->nullable()->index()->description('Group characteristics by this value. Useful for boolean types.');
            $table->enum('type', ['boolean','numeric','short_text','text'])->description('For boolean, numeric and short_text can be enabled the is_filter option.');
            $table->tinyInteger('is_filter')->unsigned()->default(0)->index()->description('If this characteristic is filter in the sidebar of the listing page');
            $table->string('append',255)->nullable()->description('Append this string to the field. Ex.: $field g/mp');
            $table->string('prepend',255)->nullable()->description('Prepend this string to the field.');
            $table->string('classname',255)->nullable()->description('Add this classname in the html.');
            $table->integer('order')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('category_characteristics');
    }

}
