<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function show(string $fileName)
    {
        $path = storage_path('app/app/public/' . $fileName);

        if (!File::exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }

    public function delete(File $file)
    {
        $file->delete();
        $status = $file->deleteFromStorage();

        return new JsonResponse(compact('status'));
    }
}
