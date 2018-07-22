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
    public function testConvert($source, $params, $expected)
    {
        $this->assertEquals(
            trim($expected, "\n"),
            trim(
                $this->feed_converter->convert($source, $params),
                "\n"
            )
        );
    }

    public function converterDataProvider()
    {
        return [
            [
                implode(DIRECTORY_SEPARATOR, [__DIR__, 'fixtures', 'atom.xml']),
                ['format' => 'rss'],
                file_get_contents(implode(DIRECTORY_SEPARATOR, [__DIR__, 'fixtures', 'expected_result.xml'])), // expected result
            ],
        ];
    }
}

