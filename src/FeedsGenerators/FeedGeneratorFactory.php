<?php

namespace App\FeedsGenerators;

class FeedGeneratorFactory
{
    public static function getFeedGenerator($format = 'rss')
    {
        $type = ucfirst($format);
        $class_name = "\\App\\FeedsGenerators\\{$type}Generator";

        if (class_exists($class_name)) {
            return new $class_name();
        }

        throw new \RuntimeException('Cannot find feed generator class');
    }
}