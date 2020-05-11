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
        "nomination",
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function photos()
    {
        return $this->hasMany(File::class, 'carving_id', 'id');
    }

    public function deletePhotos()
    {
        /** @var File $photo */
        foreach ($this->photos()->get() as $photo) {
            $photo->delete();
            $photo->deleteFromStorage();
        }
    }
}
