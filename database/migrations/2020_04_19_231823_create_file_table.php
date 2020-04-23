<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('carving_id');
            $table->string('size');
            $table->string('mime')->nullable();
            $table->string('filename')->nullable();
            $table->string('path')->nullable();
            $table->string('original_filename')->nullable();
            $table->timestamps();

            $table->index(['carving_id']);
            $table->foreign('carving_id')->references('id')->on('carvings')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
