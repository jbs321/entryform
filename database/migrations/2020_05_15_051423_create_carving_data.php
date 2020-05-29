<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \Illuminate\Support\Facades\DB;

class CreateCarvingData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carving_data', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('carving_id');
            $table->unsignedBigInteger('carving_data_type_id');
            $table->string('value');
            //index
            $table->index('carving_id');
            $table->index('carving_data_type_id');
            $table->index(['carving_id', 'carving_data_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('carving_data');
    }
}
