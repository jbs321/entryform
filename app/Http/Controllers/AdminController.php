<?php

namespace App\Http\Controllers;

use App\Carving;
use App\User;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function viewDashboard()
    {
        $users = User::all()->sortBy('fname')->map(function(User $user) {
            /** @var Carbon $pst */
            $pst =  Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at, 'UTC');
            $pst->setTimezone('America/Los_Angeles');
            $user->pst = $pst->toDateTimeString();
            return $user;
        });

        $carvings = Carving::with('user')->orderBy('user.fname')->get();

        $categories = CarvingController::CATEGORIES;

        return view('admin', compact('carvings', 'users', 'categories'));
    }
}
