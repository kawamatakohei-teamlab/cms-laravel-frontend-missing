<?php
# ログを出力する時に、ログにつける必要な情報をグローバル変数として設定
# リクエストが始まった時間
$GLOBALS["REQUEST_START_TIME"] = round(microtime(true) * 1000);
# リクエストのUniqueID（あらゆるたくさんのリクエストのログから、リクエストを特定できるID）
$GLOBALS["REQUEST_UNIQUE_ID"]= uniqid("PHP_RUID_");
