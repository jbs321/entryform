<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use App\CarvingData;
use App\Http\Controllers\CarvingController;

class GivePriorityForCarvingData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carving_data', function ($table) {
            $table->integer('priority')->default(0);
        });

        CarvingData::all()->each(function (CarvingData $carvingData) {
            $carvingData->priority = CarvingController::AWARD_PRIORITY[$carvingData->value];
            $carvingData->save();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carving_data', function ($table) {
            $table->dropColumn('priority');
        });
    }
}
