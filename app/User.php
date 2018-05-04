<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname',
        'lname',
        'email',
        'password',
        'address',
        'city',
        'province',
        'postal_code',
        'phone_number',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function carvings()
    {
        return $this->hasMany('App\Carving');
    }

    /**
     * Event Handler for when User Is being deleted
     */
    public static function boot()
    {
        parent::boot();

        // Attach event handler, on deleting of the user
        User::deleting(function($user)
        {
            // Delete all tricks that belong to this user
            /** @var Carving $carving */
            foreach ($user->carvings as $carving) {
                $carving->delete();
            }
        });
    }
}
