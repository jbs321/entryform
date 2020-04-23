<?php

namespace App;

use App\Http\Controllers\CarvingController;
use App\Http\Controllers\HomeController;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

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
        User::deleting(function ($user) {
            // Delete all tricks that belong to this user
            /** @var Carving $carving */
            foreach ($user->carvings as $carving) {
                $carving->delete();
            }
        });
    }

    public function paymentList()
    {
        return $this->hasMany(Payment::class)->get();
    }

    public function payments()
    {
        return $this->hasMany(Payment::class)->get()->sum('amount');
    }

    public function recordPayment(float $amount)
    {
        $payment = new Payment;
        $payment->fill(['user_id' => $this->id, 'amount' => $amount]);
        $payment->save();
    }

    public function price()
    {
        $countable = $this->carvings()->get()->filter(function (Carving $carving) {
            if (strtolower($carving->skill) == "student"
                || $carving->division == CarvingController::CATEGORY_R) {
                return false;
            }

            return true;
        });

        $price = $countable->count() * 6;
        return $price;
    }

    public function outstanding()
    {
        $outstanding = $this->price() - $this->payments();
        return $outstanding;
    }
}
