<?php

namespace youtube_parser;

require_once 'loggers/iLogger.php';

use youtube_parser\loggers\iLogger;

use YoutubeDl\Options;
use YoutubeDl\YoutubeDl;

class Downloader
{
    private $logger;
    
    public function __construct(iLogger $logger)
    {
        $this->logger = $logger;
    }
    
    public function download(string $download_path, string $url)
    {
        $yt = new YoutubeDl();
        
        $collection = $yt->download(
            Options::create()->downloadPath($download_path)
                ->url($url)
        );
        
        $res = [];
        foreach ($collection->getVideos() as $video) {
            if ($video->getError() !== null) {
                //echo "Error downloading video: {$video->getError()}.";
                //throw new \exception("Error downloading video: {$video->getError()}.");
                $this->logger->log("Error downloading video: {$video->getError()}.");
            } else {
                $res[0] = $video->getTitle(); // Will return Phonebloks
                // $video->getFile(); // \SplFileInfo instance of downloaded file
                //$res[2] = $video->getExt();
                $res[1] = $video->getFilename();
                
                $this->logger->log("file downloaded: {$res[0]}.");
            }
        }
        
        return $res;
    }
}
