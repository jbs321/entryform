<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\JsonResponse;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;

class PhotoController extends Controller
{
    public function show(string $fileName)
    {
        $path = storage_path('app/app/public/' . $fileName);

        if (!File::exists($path)) {
            abort(404);
        }

        $photo = Image::make($path)->resize(900, null, function (Constraint $constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        return $photo->response('jpg');
    }

    public function showWithSize(string $fileName, string $size)
    {
        if (!in_array($size, ['s', 'm', 'l'])) {
            abort(404);
        }

        $path = storage_path('app/app/public/' . $fileName);

        if (!File::exists($path)) {
            abort(404);
        }

        $sizeN = 300;

        switch ($size) {
            case 's':
                $sizeN = 300;
                break;
            case 'm':
                $sizeN = 600;
                break;
            case 'l':
                $sizeN = 900;
                break;
        }
        $photo = Image::make($path)->resize($sizeN, null, function (Constraint $constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        return $photo->response('jpg');
    }

    public function delete(File $file)
    {
        $file->delete();
        $status = $file->deleteFromStorage();

        return new JsonResponse(compact('status'));
    }
}
