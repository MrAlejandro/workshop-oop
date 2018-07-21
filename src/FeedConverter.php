<?php

namespace App;

use App\Readers\FeedReader;
use App\Readers\ReaderFactory;

class FeedConverter
{
    public function convert($params)
    {
        $command = new FeedCommand($params);

        try {
            list($params, $source) = $command->getParsedCommand();
            $rss_reader = new FeedReader(
                $source,
                new SchemaManager(),
                new ReaderFactory()
            );

            $raw_feed = $rss_reader->getContents();
            $parser = new FeedParser($raw_feed);

            $feed_generator = new FeedGenerator($params['format'], new SchemaManager());
            return $feed_generator->toXml($parser->toArray());
        } catch (\RuntimeException $e) {
            return $e->getMessage() . PHP_EOL;
        }
    }
}