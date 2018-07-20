<?php

use App\FeedCommand;
use App\Readers\RssReader;
use App\Readers\ReaderFactory;
use App\SchemaManager;
use App\RssParser;

require_once(__DIR__ . '/src/bootstrap.php');

$command = new FeedCommand($argv);

try {
    list($params, $source) = $command->getParsedCommand();
    $rss_reader = new RssReader(
        $source,
        new SchemaManager(),
        new ReaderFactory()
    );

    $raw_feed = $rss_reader->getContents();
    $parser = new RssParser($raw_feed);
    var_export($parser->toArray());
} catch (RuntimeException $e) {
    echo $e->getMessage() . PHP_EOL;
}
