<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarvingData extends Model
{
    protected $table = "carving_data";

    protected $fillable = [
        "carving_id",
        "carving_data_type_id",
        "value",
    ];
}
