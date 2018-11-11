<?php

namespace App\Parsers;

use LSS\XML2Array;

class XmlToArrayParser
{
    protected $normalizers_map = [
        'atom' => AtomNormalizer::class,
    ];

    public function parse($raw_feed)
    {
        try {
            $parsed_feed = XML2Array::createArray($raw_feed);
        } catch (\Exception $e) {
            throw new \RuntimeException($e->getMessage());
        }

        $feed_format = $this->detectFormat($raw_feed);
        $normalized = call_user_func_array(
            $this->normalizers_map[$feed_format] . '::normalize',
            [$parsed_feed]
        );

        return $normalized;
    }

    protected function detectFormat($raw_feed)
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