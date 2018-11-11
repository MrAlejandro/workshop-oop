<?php

namespace App;

use App\FeedsGenerators\FeedGeneratorFactory;
use App\Parsers\XmlToArrayParser;
use Spatie\ArrayToXml\ArrayToXml;
use App\Modifiers\FeedModifier;
use App\Readers\ReaderFactory;
use App\Parsers\ParserFactory;

class FeedConverter
{
    public function convert($source, $params)
    {
        try {
            $rss_reader = ReaderFactory::getReader($source);
            $raw_feed = $rss_reader->getContent($source);

            $parser = new XmlToArrayParser();
            $parsed_feed = $parser->parse($raw_feed);

            $feed_modifier = new FeedModifier($params);
            $modified_feed = $feed_modifier->modify($parsed_feed);

            $format = isset($params['format']) ? $params['format'] : 'rss';
            $feed = FeedGeneratorFactory::getFeedGenerator($format);

            $modified_feed = $parsed_feed;
            return $feed->toXml($modified_feed);
        } catch (\RuntimeException $e) {
            return $e->getMessage() . PHP_EOL;
        }
    }
}