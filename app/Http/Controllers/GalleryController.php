<?php

namespace App\Http\Controllers;

use App\Carving;
use App\CarvingData;
use App\File;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $request->flash();
        $page = $request->get('page', 1);

        $skill = $request->get('skill');
        $division = $request->get('division');
        $category = $request->get('category');

        /** @var Collection $carvings */
        $carvings = Carving::select('carvings.*', DB::raw('(SELECT count(id) FROM carving_data WHERE carving_data.carving_id = carvings.id ) as sort'))
            ->where(function ($query) use ($skill, $division, $category) {
                if ($skill) {
                    $query->where('skill', $skill);
                }
                if ($division) {
                    $query->where('division', $division);
                }

                if ($category) {
                    $query->where('category', $category);
                }
            })
            ->orderBy('sort', 'desc')
            ->with('photos')
            ->with('awards')
            ->paginate(8, ['*'], "page", $page);


        $carvings->map(function (Carving &$carving) {
            $awards = $carving->awards->map(function (CarvingData $cd) {
                return "<img class='ribbon-show' src='/images/ribbon/{$cd->value}.gif'>";
            })->toArray();
            $awards = implode("", $awards);
            $carving->awardsShow = $awards;
            return $carving;
        });

        $divisions = CarvingController::DIVISIONS;
        $divisionsCategories = CarvingController::CATEGORIES;

        return view('gallery', compact('carvings', 'divisions', 'divisionsCategories', 'user'));
    }

    public function downloadImage(Carving $carving)
    {
        $image = $this->fetchImageResourceByPath(storage_path('app/app/public/' . $carving->photos()->first()->filename), 900);

        $canvasHeight = $image->getHeight();
        $canvasWidth = $image->getWidth();

        $awards = $carving->awards;

        if($awards->count()) {
            $ribbonWidth = 900 / $awards->count();
            $ribbonHeight = 350;
        } else {
            $ribbonWidth = $ribbonHeight = 0;
        }

        $logo = $this->fetchImageResourceByPath(public_path('/images/rcs-logo.jpg'), null,150);

        //insert carving image
        $canvas = Image::canvas($canvasWidth, $canvasHeight + $ribbonHeight + $logo->getHeight(), '#fff');
        $canvas->insert($logo, 'top-left', 10, 10);
        $canvas->insert($image, 'top',0, $logo->height());

        foreach ($awards as $idx => $award) {
            $ribbon = $this->fetchImageResourceByPath(public_path('/images/ribbon/' . $award->value . '.gif'), $ribbonWidth);
            $canvas->insert($ribbon, 'bottom-left', $idx * $ribbon->getWidth(), 0);
        }

        return $canvas->response('jpg');
    }

    private function fetchImageResourceByPath(string $path, $width = null, $height = null)
    {
        if (!File::exists($path)) {
            abort(404);
        }

        return Image::make($path)->resize($width, $height, function (Constraint $constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
    }
}
