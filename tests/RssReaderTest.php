<?php

use PHPUnit\Framework\TestCase;
use App\SchemaManager;
use App\Enum\SourceTypes;
use App\Readers\RssReader;
use App\Readers\ReaderFactory;

class RssReaderTest extends TestCase
{
    public function setUp()
    {
        if (!defined('DIR_ROOT')) {
            define('DIR_ROOT', implode(DIRECTORY_SEPARATOR, [__DIR__, '..']));
        }
    }

    /**
     * @dataProvider sourceProvider
     */
    public function testDetectSource($source, $expected)
    {
        $reader_factory = new ReaderFactory();
        $schema_manager = new SchemaManager();
        $rss_reader = new RssReader($source, $schema_manager, $reader_factory);
        $this->assertEquals($expected, $this->invokeMethod($rss_reader, 'detectSource'));
    }

    public function sourceProvider()
    {
        return [
            [implode(DIRECTORY_SEPARATOR, [__DIR__, 'rss.xml']), SourceTypes::FILE],
            ['https://ru.hexlet.io/lessons.rss', SourceTypes::URL],
        ];
    }

    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);
        return $method->invokeArgs($object, $parameters);
    }
}
