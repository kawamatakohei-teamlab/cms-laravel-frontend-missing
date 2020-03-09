<?php


namespace App\CmsCore\Logging;


use Monolog\Formatter\FormatterInterface;

class CustomLogFormatter implements FormatterInterface
{
    public function format(array $record)
    {

        $date_time = $record['datetime']->format('Y-m-d H:i:s');
        $context = $record['context'];
        if (empty($context)) {
            $context = "";
        } else {
            $context = json_encode($context);
        }
        # $GLOBALS["REQUEST_START_TIME"]が存在しないならつまり index.php が呼び出されていない、cliからのLog
        if (!isset($GLOBALS["REQUEST_START_TIME"]) || !isset( $GLOBALS["REQUEST_UNIQUE_ID"])) {
            return "$date_time [${record['level_name']}] ${record['message']} $context\n";
        }
        $now = round(microtime(true) * 1000);
        $time_from_request_start = $now - $GLOBALS["REQUEST_START_TIME"];
        $request_id = $GLOBALS["REQUEST_UNIQUE_ID"];
        $url = request()->getRequestUri();
        $msg = "$date_time [$request_id] [Time Spent From Start = ${time_from_request_start}ms] [${record['level_name']}] ${record['message']} $context URI:$url\n";
        return $msg;

    }

    public function formatBatch(array $records)
    {
        foreach ($records as $key => $record) {
            $records[$key] = $this->format($record);
        }

        return $records;
    }
}
