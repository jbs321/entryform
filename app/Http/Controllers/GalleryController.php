<?php

namespace App\Http\Controllers;

use App\Carving;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(int $year)
    {
        $carvings = Carving::all()->map(function(Carving $carving) {
            $carving->photos;
            return $carving;
        });

        return view('gallery', compact('carvings'));
    }

    public function index2(int $year)
    {
        $carvings = Carving::all()->map(function(Carving $carving) {
            $carving->photos;
            return $carving;
        });

        return view('gallery2', compact('carvings'));
    }
}
