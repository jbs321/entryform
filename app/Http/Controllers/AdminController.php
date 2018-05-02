<?php

namespace App\Http\Controllers;

use App\Carving;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function viewDashboard()
    {
        $carvings = Carving::all();
        $carvings = $carvings->map(function(Carving $carving) {
            $carving->user;
            return $carving;
        });
        return view('admin', ['carvings' => $carvings]);
    }
}
