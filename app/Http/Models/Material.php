<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Material extends Model
{
    protected $table = 'materials';

    // クラウドストレージからコンテンツ取得
    public function getObject()
    {
        $s3_disk = Storage::disk('s3');
        $mimeType = $s3_disk->mimeType('materials/'.$this->name);
        // $config = self::di()->get('config');
        // $result = $this->storageHelper->getObject($config->s3->files->bucket, $config->s3->files->prefix . '/' . $this->name);

        // return $result;
        return $mimeType;
    }
}
