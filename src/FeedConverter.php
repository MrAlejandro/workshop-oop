<?php

namespace App;

use App\Readers\FeedReader;
use App\Readers\ReaderFactory;
use App\Parsers\XmlToArrayParser;
use App\Feeds\FeedFactory;
use App\Enum\SourceTypes;

class FeedConverter
{
    public function convert($source, $params)
    {
        $source_type = $this->detectSource($source);

        try {
            if (!$source_type) {
                throw new \RuntimeException('Cannot detect source');
            }

            $rss_reader = new FeedReader(
                ReaderFactory::getReader($source_type)
            );
            $raw_feed = $rss_reader->getContents($source);

            $parser = new XmlToArrayParser();
            $feed = FeedFactory::getFeed($params['format']);

            return $feed->toXml(
                $parser->parse($raw_feed)
            );
        } catch (\RuntimeException $e) {
            return $e->getMessage() . PHP_EOL;
        }
    }

    protected function detectSource($source)
    {
        if (file_exists($source)) {
            return SourceTypes::FILE;

        } elseif (filter_var($source, FILTER_VALIDATE_URL) !== false) {
            return SourceTypes::URL;
        }

        return false;
    }
}