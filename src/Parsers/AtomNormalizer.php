<?php

namespace App\Parsers;

use Carbon\Carbon;

class AtomNormalizer
{
    public static function normalize($parsed_xml)
    {
        array_walk($parsed_xml, function (&$item, $name) {
            if ($name === 'link') {
                $item = $item['@attributes']['href'];

            } elseif (in_array($name, ['published', 'updated'], true)) {
                if (isset($item['@value'])) {
                    $item['@value'] = Carbon::parse($item['@value']);
                } else {
                    $item = Carbon::parse($item);
                }

            } elseif (is_array($item)) {
                $item = self::normalize($item);
            }
        }, $parsed_xml);

        return $parsed_xml;
    }
}