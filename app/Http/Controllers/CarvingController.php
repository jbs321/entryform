<?php

namespace App\Http\Controllers;

use App\Carving;
use App\CarvingData;
use App\Exports\CarvingsExports;
use App\File;
use App\Http\Requests\NewCarvingRequest;
use App\Mail\NewCarving;
use App\Mail\NewCarving2;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use PhpParser\Node\Scalar\String_;

class CarvingController extends Controller
{
    const CATEGORY_A = 'A: Waterfowl, Realistic';
    const CATEGORY_B = 'B: Waterfowl';
    const CATEGORY_C = 'C: Birds';
    const CATEGORY_D = 'D: Birds';
    const CATEGORY_E = 'E: Animals';
    const CATEGORY_F = 'F: Head only in the round';
    const CATEGORY_G = 'G: In the round, Fish, Mammals, Reptiles';
    const CATEGORY_H = 'H: In the round, Human';
    const CATEGORY_I = 'I: Special Types';
    const CATEGORY_J = 'J: Special Types';
    const CATEGORY_K = 'K: Special Types';
    const CATEGORY_L = 'L: Relief';
    const CATEGORY_M = 'M: Relief';
    const CATEGORY_N = 'N: Native Northwest Coast Style';
    const CATEGORY_O = 'O: Other Native American Styles';
    const CATEGORY_P = 'P: Seminar Carvings';
    const CATEGORY_Q = 'Q: Stone Carvings';
    const CATEGORY_R = 'R: Courtesy Carvings';
    const CATEGORY_S = 'S: Woodturning';

    const DIVISIONS = [
        "" => "",
        self::CATEGORY_A => self::CATEGORY_A,
        self::CATEGORY_B => self::CATEGORY_B,
        self::CATEGORY_C => self::CATEGORY_C,
        self::CATEGORY_D => self::CATEGORY_D,
        self::CATEGORY_E => self::CATEGORY_E,
        self::CATEGORY_F => self::CATEGORY_F,
        self::CATEGORY_G => self::CATEGORY_G,
        self::CATEGORY_H => self::CATEGORY_H,
        self::CATEGORY_I => self::CATEGORY_I,
        self::CATEGORY_J => self::CATEGORY_J,
        self::CATEGORY_K => self::CATEGORY_K,
        self::CATEGORY_L => self::CATEGORY_L,
        self::CATEGORY_M => self::CATEGORY_M,
        self::CATEGORY_N => self::CATEGORY_N,
        self::CATEGORY_O => self::CATEGORY_O,
        self::CATEGORY_P => self::CATEGORY_P,
        self::CATEGORY_Q => self::CATEGORY_Q,
        self::CATEGORY_R => self::CATEGORY_R,
        self::CATEGORY_S => self::CATEGORY_S,
    ];

    const CATEGORIES = [
        self::CATEGORY_A => [
            110 => 'Realistic ducks (list 110)',
            111 => 'Realistic ducks (list 111)',
            112 => 'Geese, Loons, Swans, Puffins, Grebe, Cormorant, Murres. Full-bodied – standing, flying',
            113 => 'All waterfowl in natural finish, Woodburn texture, Stylized or Smooth finish',
            114 => 'Decoys, hunting stool and service class',
        ],
        self::CATEGORY_B => [
            120 => 'All waterfowl one-third or one-half size',
            121 => 'Decoys',
            122 => 'All waterfowl not listed above',
            123 => 'Antiqued decoys',
        ],
        self::CATEGORY_C => [
            130 => 'Realistic songbirds full size (list 130)',
            131 => 'Realistic game birds & raptors full size (list 131)',
            132 => 'All songbirds, Game birds, Raptors – woodburn or natural finish or stylized incl. Miniaturized – one-third or one-halfsize',
        ],
        self::CATEGORY_D => [
            140 => 'Realistic shore birds, water birds, seabirds (list 140)',
            141 => 'All shore birds, water birds, sea birds – woodburn, natural finish or stylized',
            142 => 'All shore birds, water birds, seabirds – Miniaturized – one-third or one-half size',
            143 => 'Shore birds on a stick',
        ],
        self::CATEGORY_E => [
            210 => 'Wild and Game species, one or many, any finish',
            211 => 'Domesticated species, horse and rider, one or more any finish, etc.',
            212 => 'Caricatures, stylized, etc. incl. Carousel figures – any size or finish',
        ],
        self::CATEGORY_F => [
            220 => 'All animals',
            221 => 'All Waterfowl, game birds and raptors',
        ],
        self::CATEGORY_G => [
            230 => 'Fresh water fish',
            231 => 'Salt water fish',
            232 => 'Tropical Fish',
            233 => 'Fish, natural finish',
            236 => 'Whales, Walrus, Seals and Porpoise',
            237 => 'Mammals, natural finish',
            238 => 'Reptiles, Lizards, Turtles, Dragons, Dinosaurs, and Unicorns',
        ],
        self::CATEGORY_H => [
            240 => 'Human – Full figured any finish, several, group, scene',
            241 => 'Human – Head, Bust, any finish',
            242 => 'Human – Cottonwood bark, half-round',
            243 => 'Human – Caricature, cowboy, one or more',
            244 => 'Clowns, Santas and gnomes',
        ],
        self::CATEGORY_I => [
            310 => 'Woodburning, Pyrography',
            311 => 'Religious theme',
            312 => 'Functional and household items, clocks, trunks, large boxes',
            313 => 'Boots, shoes',
            314 => 'Floral, botanical',
            315 => 'Miscellaneous',
        ],
        self::CATEGORY_J => [
            320 => 'Traditional chip-carved items',
            321 => 'Free-style chip-carved items',
            322 => 'Designs, games, pipes, canes, sticks, stools, tools, and chains',
            323 => 'Comical, whimsical, abstract, ornamental, decorative sculpture any style',
            324 => 'Cottonwood bark whimsical carvings',
            325 => 'Miscellaneous',
        ],
        self::CATEGORY_K => [
            330 => 'Miscellaneous items not carved, any type, any style (see rule 12)',
            331 => 'Chain saw carvings (see rule 12)',
            332 => 'Cabinetry or other built items where the main feature is not the carving (see rule 12)',
            333 => 'Jewelry – includes mixed media',
            334 => 'Mixed or other media, bone, antlers, etc.',
            340 => 'Wood Turning',
            341 => 'Spoons, etc.',
            342 => 'Miscellaneous',
        ],
        self::CATEGORY_L => [
            410 => 'Human full figure, head, bust, clown, gnome, religious subject',
            411 => 'Designs, signs, plaques and other objects',
            412 => 'Landscape, buildings, seascapes, boats, transportation, domestic scenes, bust or objects',
            413 => 'Floral, botanical',
        ],
        self::CATEGORY_M => [
            420 => 'Applied relief, intarsia, marquetry and inlay',
            421 => 'Animals and Human – full figure, head, one or more',
            422 => 'Waterfowl and all birds, fish, reptiles, whales, etc.',
            423 => 'Miscellaneous relief carvings',
        ],
        self::CATEGORY_N => [
            510 => 'Helmets, hats and masks',
            511 => 'Bowls, spoons, rattles, pipes, paddles, spears and clubs',
            512 => 'Bentwood boxes and bentwood bowls',
            513 => 'All flat or half-round relief designs, carved and/or painted',
            514 => 'Totem poles any size (see rule 12)',
            515 => 'Miscellaneous Northwest Coast Style',
        ],
        self::CATEGORY_O => [
            520 => 'Kachina and other figures, relief not Northwest Coast style, in the round not Northwest Coast style',
        ],
        self::CATEGORY_P => [
            610 => 'These carvings include all classifications and are judged 1st, 2nd, and 3rd in each skill level. They do not qualify for Best of Division',
        ],
        self::CATEGORY_Q => [
            710 => 'Fish',
            711 => 'Mammals',
            712 => 'Birds',
            713 => 'Human Figure',
            714 => 'Abstracts',
            715 => 'Native American Style',
        ],
        self::CATEGORY_R => [
            810 => 'Non-judged Carvings',
        ],
        self::CATEGORY_S => [
            910 => 'Bowls',
            911 => 'Hollow Turnings',
            912 => 'Segmented',
            913 => 'Sculptural',
            914 => 'Surface Enhancment',
            915 => 'Small Objects',
        ],
    ];

    const HEADERS = [
        'Tag Number',
        'Name',
        'Skill',
        'Division',
        'Category',
        'Description',
        'Is for sale?',
        'Amount',
    ];

    const DATA_TYPE = "awards";

    const CARVING_DATA_TYPES = [
        self::DATA_TYPE,
    ];

    const TYPE = [
        'wood-carving' => 'Wood Carving',
        'wood-turning' => 'Wood Turning',
    ];

    const AWARDS = [
        'First',
        'Second',
        'Third',
//        'BoD Beginner',
//        'BoS Beginner',
        'Honourable Mention',

        'BoD Novice',
        'BoD Intermediate',
        'BoS Novice',
        'BoD Advanced',
        'BoS Intermediate',
        'BoS Advanced',
        'BoS Expert',
        'T P Award of Excellence',
        'Best of Show',
    ];

    public function __construct(\Maatwebsite\Excel\Excel $excel)
    {
        $this->excel = $excel;
    }

    public function index()
    {
        return view('home');
    }

    public function create(NewCarvingRequest $request)
    {
        /** @var User $user */
        $user = Auth::user();
        $newCarving = new Carving();
        $newCarving->user_id = $user->id;
        $newCarving->fill($request->all());
        $newCarving->save();

        /** @var UploadedFile $photo */
        foreach ($request->file('photos') as $idx => $photo) {
            $savedPhoto = $this->saveFileForCarvingInDB($newCarving, $photo, $user, $idx);
            $this->savePhotoForCarving($photo, $savedPhoto);
        }

        return redirect('home');
    }

    private function saveFileForCarvingInDB(Carving $carving, UploadedFile $photo, User $user, $key)
    {
        $fileName = "carving_{$user->id}_{$carving->id}_{$key}.{$photo->getClientOriginalExtension()}";
        $file = new File;

        $file->fill([
            'carving_id' => $carving->id,
            'size' => $photo->getSize(),
            'mime' => $photo->getMimeType(),
            'filename' => $fileName,
        ]);

        $file->save();
        return $file;
    }

    private function savePhotoForCarving(UploadedFile $photo, File $photoModel)
    {
        $photo->storeAs('app/public', $photoModel->filename);

        $photoModel->update(['path' => storage_path("app") . $photoModel->filename]);
        $photoModel->save();
    }

    public function delete(Carving $carving)
    {
        $carving->deletePhotos();
        $carving->delete();

        return redirect('home');
    }

    public function downloadCarvingsForUser(User $user)
    {
        $carvings = $user->carvings;
        $carvings = $carvings->map(function (Carving $carving) use ($user) {
            $carving->is_for_sale = ($carving->is_for_sale) ? "yes" : "no";
            $carving->user_id = $user['fname'] . " " . $user['lname'];
            $carving->division = substr($carving->division, 0, 1);
            unset($carving->created_at);
            unset($carving->updated_at);

            return $carving;
        });

        return Excel::download(new CarvingsExports($carvings, self::HEADERS), 'carvings.xlsx');
    }

    public function downloadCarvingsForAll()
    {
        $carvings = Carving::all();
        $carvings = $carvings->map(function (Carving $carving) {
            $user = $carving->user()->first();
            $carving->is_for_sale = ($carving->is_for_sale) ? "yes" : "no";
            $carving->user_id = $user['fname'] . " " . $user['lname'];
            $carving->division = substr($carving->division, 0, 1);
            $carving->amount = "8";

            if ($carving->division == self::CATEGORY_R ||
                $carving->skill == "Student") {
                $carving->amount = "0";
            }

            unset($carving->created_at);
            unset($carving->updated_at);

            return $carving;
        });

        return Excel::download(new CarvingsExports($carvings, self::HEADERS), 'carvings.xlsx');
    }

    public function edit(Carving $carving)
    {
        $photos = $carving->photos()->get();
        $user = Auth::user();
        return view('editcarving', compact('user', 'carving', 'photos'));
    }

    public function update(Request $request, Carving $carving)
    {
        $request->validate([
            "skill" => 'required|string|max:255',
            "division" => [
                'required',
                'string',
                'max:255',
            ],
            "category" => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) use ($request) {
                    if (!in_array($value, array_keys(self::CATEGORIES[$request->division]))) {
                        return $fail('Category doesn\'t match the division');
                    }
                },
            ],
            "description" => 'required|string|max:255',
            "is_for_sale" => 'required|boolean',
            "photos" => ['array', function ($attribute, $value, $fail) {
                if (count($value) > 2) {
                    return $fail('Max photo limit is 2 photos.');
                }
            }, function ($attribute, $value, $fail) {
                if (count($value) == 0) {
                    return $fail('Select at least 1 photo.');
                }
            },
            ],
            "photos.*" => 'image|mimes:jpeg,png,jpg,git|max:4000'
        ]);


        /** @var User $user */
        $user = Auth::user();
        $carving->fill($request->all());
        $carving->save();

        if ($request->has('photos')) {
            $carving->deletePhotos();

            /** @var UploadedFile $photo */
            foreach ($request->file('photos') as $idx => $photo) {
                $savedPhoto = $this->saveFileForCarvingInDB($carving, $photo, $user, $idx);
                $this->savePhotoForCarving($photo, $savedPhoto);
            }
        }

        $photos = $carving->photos()->get();
        $user = Auth::user();
        return view('editcarving', compact('carving', 'photos', 'user'));
    }

    public function editAward(Carving $carving)
    {
        $awards = self::AWARDS;
        $photo = $carving->photos()->first();
        $selected = $carving->awards()->get()->map(function (CarvingData $cd) {
            return $cd->value;
        })->toArray();

        return view('award', compact('awards', 'carving', 'photo', 'selected'));
    }

    public function saveAward(Carving $carving, Request $request)
    {
        CarvingData::where('carving_id', $carving->id)->delete();

        $awards = [];
        foreach ($request->all() as $item) {
            if (in_array($item, self::AWARDS)) {
                $awards [] = [
                    "carving_id" => $carving->id,
                    "carving_data_type_id" => 1,
                    "value" => $item,
                ];
            }
        }


        CarvingData::insert($awards);

        return redirect('gallery');
    }
}

