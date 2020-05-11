<?php

namespace App\Http\Controllers;

use App\Carving;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $request->flash();

        $skill = $request->get('skill');
        $division = $request->get('division');
        $category = $request->get('category');

        /** @var Collection $carvings */
        $carvings = Carving::where(function ($query) use ($skill, $division, $category){
            if($skill) {
                $query->where('skill', $skill);
            }
            if ($division) {
                $query->where('division', $division);
            }

            if ($category) {
                $query->where('category', $category);
            }
        })
            ->with('photos')
            ->paginate(8);

        $divisions = CarvingController::DIVISIONS;
        $divisionsCategories = CarvingController::CATEGORIES;

        return view('gallery', compact('carvings', 'divisions', 'divisionsCategories'));
    }
}
