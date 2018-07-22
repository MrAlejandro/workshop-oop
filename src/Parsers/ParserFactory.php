<?php

namespace App\Parsers;

class ParserFactory
{
    public static function getParser($raw_feed)
    {
        $feed_type = self::detectFormat($raw_feed);
        $type = ucfirst($feed_type);
        $class_name = "\\App\\Parsers\\{$type}Parser";

        if (class_exists($class_name)) {
            return new $class_name();
        }

        throw new \RuntimeException('Cannot find feed parser');
    }

    public static function detectFormat($raw_feed)
    {
        $xml = simplexml_load_string($raw_feed);
        $namespaces = $xml->getDocNamespaces();

        foreach ($namespaces as $name => $namespace) {
            if (strpos(strtolower($name), 'atom') !== false
                && strpos(strtolower($namespace), 'atom') !== false
            ) {
                return 'atom';
            }
        }

        return 'rss';
    }
}
