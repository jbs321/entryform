<?php

namespace App\Http\Controllers;

use App\Carving;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();
        $carvings = $user->carvings;

        return view('home', ['carvings' => $carvings]);
    }

    public function showTicket()
    {
        $carvings = Carving::all();

        return view('ticketlist', ['carvings' => $carvings]);
    }

    static function calcPrice(int $numCarvings = 0) {
        if($numCarvings == 0) {
            return 0;
        } elseif($numCarvings == 1) {
            return 6;
        } elseif($numCarvings == 2) {
            return 12;
        } elseif($numCarvings == 3) {
            return 18;
        }

        return 24;
    }
}
