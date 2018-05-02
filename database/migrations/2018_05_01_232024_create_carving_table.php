<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarvingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carvings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('skill');
            $table->string('division');
            $table->string('category');
            $table->text('description');
            $table->boolean('is_for_sale');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carvings');
    }
}
