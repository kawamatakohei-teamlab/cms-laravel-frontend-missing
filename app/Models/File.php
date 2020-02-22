<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\FileNotFoundException;

class File extends DaisyModelBase
{
    protected $table = 'files';

    public static function getItemByName($name): ?File
    {
        $item = File::where('name', $name)->first();
        return $item;
    }

    public function getFileObjectAsResponse()
    {
        $s3_disk = Storage::disk('s3');
        $file_path = config('settings.assets_info.files.prefix') . '/' . $this->name;
        #TODO: Have to check file is not exixts: League\Flysystem\FileNotFoundException
        try {
            $response = $s3_disk->response($file_path);
        } catch (FileNotFoundException $e) {
            abort(500,"[FileModel] Error happened when getting file from storage: {$e->getMessage()}");
            return null;
        }
        return $response;

    }
}
