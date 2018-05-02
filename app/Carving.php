<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carving extends Model
{
    protected $fillable = [
        "user_id",
        "skill",
        "division",
        "category",
        "description",
        "is_for_sale",
    ];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
