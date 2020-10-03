<?php

namespace youtube_parser\services;

interface iService
{
    public function upload(string $file_path, string $file_name, array $options = null);
}
