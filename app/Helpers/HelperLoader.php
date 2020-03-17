<?php
/***
 * CmsCoreコメント： 各案件もし各自の Helper 関数を定義したいなら、このファイルで書く
 * 書き方は直接このファイルで関すを定義するか、
 * またはこのファイルと同じフォルダの下に XXXXHelper.php ファイルを作って、
 * require_once __DIR__ . '/XXXXHelper.php'; で呼び出す
 */

/* 例：
function testHelper()
{
    return 'hello';
}
 OR
require_once __DIR__ . '/XXXXHelper.php';
*/

require_once dirname(__FILE__) . '/DynamicContentHelper.php';
require_once dirname(__FILE__) . '/YouTubeHelper.php';
