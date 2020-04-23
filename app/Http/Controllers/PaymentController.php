<?php

namespace App\Http\Controllers;

use App\User;

class PaymentController extends Controller
{
    public function show()
    {
        $users = User::all()
            ->map(function (User $user) {
                $user->price = $user->price();
                $user->paid = $user->payments();
                $user->outstanding = $user->outstanding();
                $user->carvings = $user->carvings()->get()->count('id');

                return $user;
            });

        $totalPaid = $users->sum('paid');
        $totalPrice = $users->sum('price');
        $totalOutstanding = $users->sum('outstanding');
        $totalCarvings = $users->sum('carvings');

        return view('admin.payments', compact('users', 'totalPaid', 'totalPrice', 'totalOutstanding', 'totalCarvings'));
    }
}
