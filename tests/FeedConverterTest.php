<?php

use PHPUnit\Framework\TestCase;
use App\FeedConverter;

class FeedConverterTest extends TestCase
{
    protected $feed_converter;

    public function setUp()
    {
        $this->feed_converter = new FeedConverter();
    }

    /**
     * @dataProvider converterDataProvider
     */
    public function testConvert($source, $params, $expected_file)
    {
        $this->assertXmlStringEqualsXmlFile(
            $expected_file,
            $this->feed_converter->convert($source, $params)
        );
    }

    public function converterDataProvider()
    {
        return [
            [
                implode(DIRECTORY_SEPARATOR, [__DIR__, 'fixtures', 'atom.xml']),
                ['format' => 'rss'],
                implode(DIRECTORY_SEPARATOR, [__DIR__, 'fixtures', 'expected_result.xml']), // expected result
            ],
        ];
    }
}

