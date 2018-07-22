<?php

namespace App;

use App\FeedsGenerators\FeedGeneratorFactory;
use App\Readers\ReaderFactory;
use App\Parsers\XmlToArrayParser;

class FeedConverter
{
    public function convert($source, $params)
    {
        try {
            $rss_reader = ReaderFactory::getReader($source);
            $raw_feed = $rss_reader->getContent($source);

            $parser = new XmlToArrayParser();
            $parsed_feed = $parser->parse($raw_feed);

            $feed = FeedGeneratorFactory::getFeedGenerator($params['format']);

            return $feed->toXml($parsed_feed);
        } catch (\RuntimeException $e) {
            return $e->getMessage() . PHP_EOL;
        }
    }
}