<?php

use App\FeedCommand;
use PHPUnit\Framework\TestCase;

class FeedCommandTest extends TestCase
{
    /**
     * @dataProvider validCommandPartsProvider
     */
    public function testGetParsedCommand($command_parts, $expected)
    {
        $feed_command = new FeedCommand($command_parts);
        $this->assertEquals(
            $expected,
            $this->invokeMethod($feed_command, 'getParsedCommand')
        );
    }

    /**
     * @expectedException \RuntimeException
     * @dataProvider invalidCommandPartsProvider
     */
    public function testGetParsedCommandException($command_parts)
    {
        $feed_command = new FeedCommand($command_parts);
        $this->invokeMethod($feed_command, 'getParsedCommand');
    }

    public function invalidCommandPartsProvider()
    {
        return [
            [
                [ // command_parts
                    'script_name.php',
                    '--format',
                    'rss',
                    'invalid_entry',
                    'file.xml',
                ],
            ],
        ];
    }

    public function validCommandPartsProvider()
    {
        return [
            [
                [ // command_parts
                    'script_name.php',
                    '--format',
                    'rss',
                    'file.xml',
                ],
                [ // expected result
                    ['format' => 'rss'],
                    'file.xml',
                ],
            ],
            [
                [ // command_parts
                    'script.php',
                    '--format',
                    'atom',
                    '-a',
                    'b',
                    '--c',
                    '--d',
                    'e',
                    'https://ru.hexlet.io/lessons.rss',
                ],
                [ // expected result
                    ['format' => 'atom', 'a' => 'b', 'c' => null, 'd' => 'e'],
                    'https://ru.hexlet.io/lessons.rss',
                ]
            ],
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