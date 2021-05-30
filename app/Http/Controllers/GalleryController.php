<?php

namespace App\Http\Controllers;

use App\Carving;
use App\CarvingData;
use App\File;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;

class GalleryController extends Controller
{
    const AWARDS = [
        'Best of Show',
        'T P Award of Excellence',

        'BoS Expert',
        'BoS Advanced',
        'BoS Intermediate',
        'BoS Novice',
//        'BoS Beginner',

        'BoD Advanced',
        'BoD Intermediate',
        'BoD Novice',
//        'BoD Beginner',

        'First',
        'Second',
        'Third',
        'Honourable Mention',
    ];

    public function index(Request $request)
    {
        if(!empty($request->all())) {
            Session::put('gallery', $request->all());
        } else {
            $old = Session::get('gallery');

            if(isset($old) && !empty($old)) {
                $request->request->add($old);
            }
        }

        $request->flash();
        $page = $request->get('page', 1);

        $skill = $request->get('skill');
        $division = $request->get('division');
        $category = $request->get('category');
        $award = $request->get('award');
        $type = $request->get('type');
        $carver = $request->get('carver');
        $myCarving = $request->get('my_carving');

        //Allow showing user carvings see "Show Only My Carvings" in /gallery page
        $userQ = "1 as my_carvings";
        if (Auth::check()) {
            $userQ = "case when user_id = " . Auth::user()->id . " then 1 else 0 end as my_carvings";
        }

        /** @var Collection $carvings */
        $carvings = Carving::select(
            DB::raw('distinct carvings.id'),
            'carvings.user_id',
            'carvings.skill',
            'carvings.division',
            'carvings.category',
            'carvings.description',
            'carvings.is_for_sale',
            DB::raw('COALESCE(max(carving_data.priority), 0) as priority'),
            DB::raw($userQ)
        )
            ->leftjoin('carving_data', 'carving_data.carving_id', '=', 'carvings.id')
            ->orderBy('priority', 'desc')
            ->groupBy(DB::raw('carvings.id, carvings.user_id, carvings.skill, carvings.division, carvings.category, carvings.description, carvings.is_for_sale'))


            //Filter by skill/division/category/type/My Carvings/Carver's
            ->where(function ($query) use ($skill, $division, $category, $type, $myCarving, $carver) {
                if ($skill) {
                    $query->where('skill', $skill);
                }
                if ($division) {
                    $query->where('division', $division);
                }

                if ($category) {
                    $query->where('category', $category);
                }
                if ($type) {
                    switch ($type) {
                        case "wood-carving":
                            $query->where('division', '!=', CarvingController::CATEGORY_S);
                            break;
                        case "wood-turning":
                            $query->where('division', '=', CarvingController::CATEGORY_S);
                            break;
                    }
                }
                if ($myCarving && Auth::check()) {
                    $query->where('user_id', '=', Auth::user()->id);
                }
                if($carver) {
                    $query->where('user_id', '=', $carver);
                }
            });

        if ($award) {
            $carvings = $carvings->whereHas('awards', function ($query) use ($award) {
                $query->where('value', $award);
            });
        }

        $carvings = $carvings
            ->with('photos')
            ->with('user')
            ->with('awards')
            ->paginate(9, ['*'], "page", $page);



        $cdnPath = env('SIRV_PATH');
        $ribbonPath = $cdnPath ? "{$cdnPath}ribbons" : "/images/ribbon";

        $carvings->map(function (Carving &$carving) use ($ribbonPath) {
            $awards = $carving->awards->map(function (CarvingData $cd) use ($ribbonPath) {
                return "<img class='ribbon-show' src='{$ribbonPath}/{$cd->value}.gif'>";
            })->toArray();
            $awards = implode("", $awards);
            $carving->awardsShow = $awards;
            return $carving;
        });

        $divisions = CarvingController::DIVISIONS;
        $divisionsCategories = CarvingController::CATEGORIES;

        $awards = self::AWARDS;
        $types = CarvingController::TYPE;

        $myCarving = false;

        $carvers = User::whereHas('carvings', function ($query) {
            $query->where('carvings.id', '>', 0);
        })->orderBy('fname')->get()->all();


        $data = compact('carvings', 'divisions', 'divisionsCategories', 'awards', 'types', 'myCarving', 'carvers');

        if (Auth::check()) {
            $user = Auth::user();
            $data = array_merge($data, compact('user'));
        }

//        return new JsonResponse($carvings);

        return view('gallery', $data);
    }

    public function downloadImage(Carving $carving, int $file = null)
    {
        if($file) {
            $fileName = $carving->photos()->get()->toArray()[$file]['filename'];
        } else {
            $fileName = $carving->photos()->first()->filename;
        }

        $image = $this->fetchImageResourceByPath(storage_path("app/app/public/$fileName"), 900);

        $canvasWidth = $image->getWidth();

        $awards = $carving->awards;

        if ($awards->count()) {
            $ribbonWidth = $canvasWidth / $awards->count() * 0.8;
            $ribbonHeight = 350;
        } else {
            $ribbonWidth = $ribbonHeight = 0;
        }

        $logo = $this->fetchImageResourceByPath(public_path('/images/rcs-logo.jpg'), null, 150);

        $canvasHeight = $image->getHeight() + $ribbonHeight + $logo->getHeight();

        //insert carving image
        $canvas = Image::canvas($canvasWidth, $canvasHeight, '#fff');
        $canvas->insert($logo, 'top-left', 10, 10);
        $canvas->insert($image, 'top', 0, $logo->height());

        foreach ($awards as $idx => $award) {
            $ribbon = $this->fetchImageResourceByPath(public_path('/images/ribbon/' . $award->value . '.gif'), $ribbonWidth, $ribbonHeight);
            $canvas->insert($ribbon, 'top-left', $idx * $ribbon->getWidth(), $logo->getHeight() + $image->getHeight());
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

    public function welcome()
    {
        $carvings = Carving::all()->count();
        $carvers = User::all()->count();

        return view('gallery-welcome', compact('carvings', 'carvers'));
    }
}
