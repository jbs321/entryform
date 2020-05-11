<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \Illuminate\Support\Facades\DB;

class CreateUserRoleMigration extends Migration
{
    public function up()
    {
        Schema::create('user_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        DB::table('user_roles')->insert([
            ['id' => 0, 'name' => 'visitor'],
            ['id' => 10, 'name' => 'judge'],
            ['id' => 20, 'name' => 'admin'],
        ]);

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('user_role')->default(0);
        });

        Schema::table('carvings', function (Blueprint $table) {
            $table->string('nomination')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_roles');
        Schema::table('users', function(Blueprint $table) {
            $table->dropColumn('user_role');
        });
        Schema::table('carvings', function(Blueprint $table) {
            $table->dropColumn('nomination');
        });
    }
}
