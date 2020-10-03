<?php

namespace youtube_parser;

class Parser
{
    public function parse($content)
    {
        //$patt = '~https?://(?:www\.)?youtube\.com[^&\s]+(?=\s|$)~';
        //$patt = '~https?://(?:www\.)?youtube\.com[^&\s]+(?=\s|$)~';
        //$patt = '~(?:https?://)?(?:www\.)?youtu(?:be\.com/watch\?(?:.*?&(?:amp;)?)?v=|\.be/)([\w\-]+)(?:&(?:amp;)?[\w\?=]*)?~';
        //$patt = '"(?:.+?)?(?:\/v\/|watch\/|\?v=|\&v=|youtu\.be\/|\/v=|^youtu\.be\/)([a-zA-Z0-9_-]{11})+"';
        $patt = '/(http:|https:|)\/\/(player.|www.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com))\/(video\/|embed\/|channels\/(?:\w+\/)|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/';
        preg_match_all($patt, $content, $arr);
        
        return array_unique($arr[6]);
    }
}
