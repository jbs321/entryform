<?php

namespace App\Http\Controllers;

use App\Carving;
use App\Summernote;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $note = DB::table('summernotes')->latest("id")->first();

        return view('home', ['carvings' => $carvings, 'note' => $note->content ?? '']);
    }

    public function showTicket()
    {
        $carvings = Carving::all();

        return view('ticketlist', ['carvings' => $carvings]);
    }

    static function calcPrice(int $numCarvings = 0) {
        $total = $numCarvings * 8;
        $sumPayments = Auth::user()->payments();

        $total -= $sumPayments;

        $total = $total < 0 ? 0 : $total;

        return $total;
    }
}
