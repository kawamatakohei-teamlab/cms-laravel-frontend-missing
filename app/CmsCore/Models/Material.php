<?php

namespace App\CmsCore\Models;

use Illuminate\Support\Facades\Storage;

class Material extends DaisyModelBase
{
    protected $table = 'materials';
    
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
