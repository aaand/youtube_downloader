<?php

namespace youtube_parser\services;

require_once 'iService.php';

//use youtube_parser\services\iService;

class Dailymotion implements iService
{
    private $api;
    
    public function __construct(string $api_key, string $api_secret, string $user, string $pas)
    {
        // Scopes you need to run your tests
        $scopes = array(
            'manage_videos',
        );
        // Dailymotion object instanciation
        $this->api = new Dailymotion();
        $this->api->setGrantType(
            Dailymotion::GRANT_TYPE_PASSWORD,
            $api_key,
            $api_secret,
            $scopes,
            array(
                'username' => $user,
                'password' => $pas,
            )
        );
    }
    
    public function upload(string $file_path, string $file_name, array $options = null)
    {
        $channel = '';
        if (isset($options['channel'])) {
            $channel = $options['channel'];
        }
        $tags = '';
        if (isset($options['tags'])) {
            $tags = $options['tags'];
        }
        // 1. Upload your file on Dailymotion's servers
        $url = $this->api->uploadFile($file_path);
        
        // 2. Create the video on your channel
        $this->api->post(
            '/videos',
            array(
                'url' => $url,
                'title' => $file_name,
                'tags' => $tags,
                'channel' => $channel,
                'published' => true,
            )
        );
    }
}
