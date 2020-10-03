<?php

namespace youtube_parser\loggers;

include_once 'iLogger.php';

class Terminal implements iLogger
{
    public function log($message)
    {
        echo date('Y-m-d H:i:s') . '>>' . $message . "\n\n";
    }
}
