<?php

namespace App\Feeds;

class FeedFactory
{
    public static function getFeed($format = 'rss')
    {
        $type = ucfirst($format);
        $class_name = "\\App\\Feeds\\{$type}";

        if (class_exists($class_name)) {
            return new $class_name();
        }

        throw new \RuntimeException('Cannot find feed class');
    }
}