<?php

namespace App\Parsers;

use Carbon\Carbon;

class AtomParser
{
    public function parse($content)
    {
        $xml = new \SimpleXMLElement($content);

        $parsed = [
            'title' => $xml->title,
            'link' => $xml->link->attributes()->href,
            'updated' => Carbon::parse($xml->updated),
            'webMaster' => $xml->webMaster,
            'entry' => $this->parseEntries($xml->entry),
        ];

        return $parsed;
    }

    protected function parseEntries($items)
    {
        $parsed = [];

        foreach ($items as $item) {
            $parsed[] = [
                'title' => $item->title,
                'link' => $item->link->attributes()->href,
                'id' => $item->id,
                'summary' => $item->summary,
                'published' => Carbon::parse($item->published),
            ];
        }

        return $parsed;
    }
}