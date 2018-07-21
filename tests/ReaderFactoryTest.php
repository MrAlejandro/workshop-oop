<?php

use App\Readers\ReaderFile;
use App\Readers\ReaderUrl;
use App\Readers\ReaderFactory;
use PHPUnit\Framework\TestCase;

class ReaderFactoryTest extends TestCase
{
    public function setUp()
    {
        if (!defined('DIR_ROOT')) {
            define('DIR_ROOT', implode(DIRECTORY_SEPARATOR, [__DIR__, '..']));
        }
    }

    /**
     * @dataProvider readersTypesProvider
     */
    public function testGetReader($type, $source, $check)
    {
        $reader_factory = new ReaderFactory();
        $this->assertTrue(call_user_func_array($check, [$reader_factory->getReader($type, $source)]));
    }

    /**
     * @expectedException \RuntimeException
     * @dataProvider nonExistentReadersTypesProvider
     */
    public function testGetReaderException($type, $source)
    {
        $reader_factory = new ReaderFactory();
        $reader_factory->getReader($type, $source);
    }

    public function nonExistentReadersTypesProvider()
    {
         return [
            ['dummy', 'does_not_matter.xml'],
        ];
    }

    public function readersTypesProvider()
    {
        return [
            ['file', 'file.xml', function ($object) {
                return $object instanceof ReaderFile;
            }],
            ['url', 'https://ru.hexlet.io/lessons.rss', function ($object) {
                return $object instanceof ReaderUrl;
            }],
        ];
    }
}