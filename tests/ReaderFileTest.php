<?php

use App\Readers\ReaderFile;
use PHPUnit\Framework\TestCase;

class ReaderFileTest extends TestCase
{
    public function testRead()
    {
        $rss_file_path = implode(DIRECTORY_SEPARATOR, [__DIR__, 'rss.xml']);
        $reader = new ReaderFile($rss_file_path);
        $this->assertEquals(file_get_contents($rss_file_path), $reader->read());
    }
}