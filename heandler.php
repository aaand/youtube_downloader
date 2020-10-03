<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

require_once('classes/Parser.php');
require_once('classes/Downloader.php');
require_once('classes/loggers/Terminal.php');
require_once('classes/Uploader.php');
require_once('classes/services/DailymotionServ.php');
require_once 'vendor/dailymotion/sdk/Dailymotion.php';

$logger = new \youtube_parser\loggers\Terminal();

$logger->log('start');

$config = include 'config.php';
$download_path = $config['download_path'];

$dailymotion_opt = $config['dailymotion'];

$site_url = $argv[1] ?: die('url not transferred');
$content = file_get_contents($site_url);

$parser = new youtube_parser\Parser();

$videos = $parser->parse($content);

$downloader = new youtube_parser\Downloader($logger);

$service = new \youtube_parser\services\DailymotionServ($dailymotion_opt['api_key'], $dailymotion_opt['api_secret'], $dailymotion_opt['user'], $dailymotion_opt['pas']);
$uploader = new \youtube_parser\Uploader($service, $logger);

foreach ($videos as $video) {
    try {
        $url = 'https://www.youtube.com/watch?v=' . $video;
        
        $download_res = $downloader->download($download_path, $url);
        $title = $download_res[0];
        $file_path = $download_res[1];
        
        $uploader->upload($file_path, $title, [
            'channel' => $dailymotion_opt['channel'],
            'tags' => $dailymotion_opt['tags']
        ]);
        unlink($file_path);
    } catch (\Exception $e) {
        $logger->log($e);
    }
}

$logger->log('end');
