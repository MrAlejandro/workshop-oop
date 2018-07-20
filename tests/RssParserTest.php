<?php

use PHPUnit\Framework\TestCase;
use App\RssParser;

class RssParserTest extends TestCase
{

    /**
     * @dataProvider contentsProvider
     */
    public function testToArray()
    {
    }

    public function contentsProvider()
    {
        return [
            [
                file_get_contents(implode(DIRECTORY_SEPARATOR, [__DIR__, 'mixed.xml'])),
                array(
                    'rss' => array(
                        'attributes'            => array(
                            'xmlns:atom'        => 'http://www.w3.org/2005/Atom',
                            'xmlns:blogChannel' => 'http://backend.userland.com/blogChannelModule',
                            'version'           => '2.0',
                        ),
                        'channel'                     => array(
                            'attributes' => array(),
                            'title'      => array(
                                'attributes' => array(),
                                'value'      => 'Scripting News',
                            ),
                        ),
                        'blogChannel:blogRoll'        => array(
                            'attributes' => array(),
                            'value'      => '
        http://radio.weblogs.com/0001015/userland/scriptingNewsLeftLinks.opml
    ',
                        ),
                        'blogChannel:mySubscriptions' => array(
                            'attributes' => array(),
                            'value'      => '
        http://radio.weblogs.com/0001015/gems/mySubscriptions.opml
    ',
                        ),
                        'category'                    => array(
                            'attributes' => array(
                                'domain' => 'Syndic8',
                            ),
                            'value'      => '1765',
                        ),
                        'webMaster'                   => array(
                            'attributes' => array(),
                            'value'      => 'dave@userland.com',
                        ),
                        'item'                        => array(
                            'attributes'  => array(),
                            'title'       => array(
                                'attributes' => array(),
                                'value'      => 'Pipeline challenge / Главные испытания',
                            ),
                            'guid'        => array(
                                'attributes' => array(
                                    'isPermaLink' => 'false',
                                ),
                                'value'      => '150',
                            ),
                            'link'        => array(
                                'attributes' => array(),
                                'value'      => 'https://ru.hexlet.io/courses/main/lessons/pipeline/theory_unit',
                            ),
                            'description' => array(
                                'attributes' => array(),
                                'value'      => 'Цель: Написать клиент, реализующий передачу сообщений в условиях канала передачи с помехами.',
                            ),
                            'pubDate'     => array(
                                'attributes' => array(),
                                'value'      => 'Wed, 21 Jan 2015 08:59:51 +0000',
                            ),
                        ),
                    ),
                ),
            ]
        ];
    }
}