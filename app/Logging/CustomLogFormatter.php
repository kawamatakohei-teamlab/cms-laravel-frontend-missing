<?php


namespace App\Logging;


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
        $now = round(microtime(true) * 1000);
        $time_from_request_start = $now - $GLOBALS["REQUEST_START_TIME"];
        $request_id = $GLOBALS["REQUEST_UNIQUE_ID"];
        $msg = "$date_time [$request_id] [Time Spent From Start = ${time_from_request_start}ms] [${record['level_name']}] ${record['message']} $context \n";
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
