<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'files';
    protected $fillable = [
        'carving_id',
        'size',
        'mime',
        'filename',
        'path',
        'original_filename',
    ];

    public function carving()
    {
        return $this->belongsTo(Carving::class);
    }

    public function deleteFromStorage()
    {
        $path = storage_path("/app/app/public/" . $this->filename);
        $status = \Illuminate\Support\Facades\File::delete($path);
        return $status;
    }

    public function link()
    {
        return "/storage/" . $this->filename;
    }
}
