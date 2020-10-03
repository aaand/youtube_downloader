<?php

namespace youtube_parser;

require_once 'services/iService.php';

use youtube_parser\services\iService;

class Uploader
{
    private $service;
    private $logger;
    
    public function __construct(iService $service, $logger)
    {
        $this->service = $service;
        $this->logger = $logger;
    }
    
    public function upload(string $file_path, string $file_name, array $options = null)
    {
        $this->service->upload($file_path, $file_name, $options);
    }
}
