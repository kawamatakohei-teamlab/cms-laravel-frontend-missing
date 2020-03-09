<?php

namespace App\CmsCore\Models;

use Illuminate\Database\Eloquent\Model;

class DaisyModelBase extends Model
{
    public static function generateLastModified($updatedAt)
    {
        $dt = new \Datetime($updatedAt);
        // NOTE: RFC 1123 の書式らしいが、JSTで動かしたら一部のブラウザでは勝手にGMTに…
        // しかもタイムゾーン考慮してない値になっていたのでGMT変換するようにしました。
        $dt->setTimezone(new \DateTimeZone('GMT'));
        $lastModified = $dt->format('D, d M Y H:i:s T');
        return $lastModified;
    }

    public static function isPublished($publish, $expire)
    {
        $today = date("Y-m-d H:i");
        if ($publish && $expire) {
            //両方送られてきた場合は両方チェック
            if ($publish->format("Y-m-d H:i") <= $today && $today < $expire->format("Y-m-d H:i")) {
                return true;
            }
        } elseif ($publish && !$expire) {
            //publishのみの場合は公開日より先になっていればtrueを返す
            if ($today >= $publish->format("Y-m-d H:i")) {
                return true;
            }
        } elseif (!$publish && $expire) {
            //expireのみの場合は終了日より前になっていればtrueを返す
            if ($today < $expire->format("Y-m-d H:i")) {
                return true;
            }
        }
        return false;
    }

    public function itemIsPublished()
    {
        # TODO: Check - CMSのStyleSheetやJavascriptsテーブルのpublish_atたexpire_atの型はLONGBLOB？？？？？
        $publish_at = $this->pulish_at ? new \DateTime($style->pulish_at) : false;
        $expire_at = $this->expire_at ? new \DateTime($style->expire_at) : false;
        if (($publish_at || $expire_at) && !$this->isPublished($publish_at, $expire_at)) {
            return false;
        }
        return true;
    }

    /**
     * @param $modifiedSince
     * @return bool
     */
    public function checkIfModified($ifModifiedSince)
    {
        $dt = new \Datetime($this->updated_at);
        // NOTE: RFC 1123 の書式らしいが、JSTで動かしたら一部のブラウザでは勝手にGMTに…
        // しかもタイムゾーン考慮してない値になっていたのでGMT変換するようにしました。
        $dt->setTimezone(new \DateTimeZone('GMT'));
        $lastModifiedTime = $dt->format('D, d M Y H:i:s T');

        if($ifModifiedSince == $lastModifiedTime) {
            return false;
        }
        return $lastModifiedTime;

    }

}
