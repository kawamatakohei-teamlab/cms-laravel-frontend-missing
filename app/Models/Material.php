<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Material extends DaisyModelBase
{
    protected $table = 'materials';

    // クラウドストレージからコンテンツ取得
    public function getObject()
    {
        $s3_disk = Storage::disk('s3');
        $mimeType = $s3_disk->mimeType('materials/' . $this->name);
        // $config = self::di()->get('config');
        // $result = $this->storageHelper->getObject($config->s3->files->bucket, $config->s3->files->prefix . '/' . $this->name);

        // return $result;
        return $mimeType;
    }

    public static function getItemByName($material_name): ?Material
    {
        return Material::where('name', $material_name)->first();
    }

    public function getMaterialObjectAsResponse()
    {
        $s3_disk = Storage::disk('s3');
        $file_path = config('settings.assets_info.materials.prefix') . '/' . $this->name;
        #TODO: Have to check file is not exixts: League\Flysystem\FileNotFoundException
        $response = $s3_disk->response($file_path);
        return $response;

    }
}
