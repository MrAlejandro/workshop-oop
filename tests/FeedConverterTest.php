<?php

use PHPUnit\Framework\TestCase;
use App\FeedConverter;

class FeedConverterTest extends TestCase
{
    protected $feed_converter;

    public function setUp()
    {
        $this->feed_converter = new FeedConverter();
        if (!defined('DIR_ROOT')) {
            define('DIR_ROOT', implode(DIRECTORY_SEPARATOR, [__DIR__, '..']));
        }
    }

    /**
     * @dataProvider converterDataProvider
     */
    public function testConvert($command_parts, $expected)
    {
        $this->assertEquals(trim($expected, "\n"), trim($this->feed_converter->convert($command_parts), "\n"));
    }

    public function converterDataProvider()
    {
        return [
            [
                [ // command_parts
                    'script_name.php',
                    '--format',
                    'rss',
                    implode(DIRECTORY_SEPARATOR, [__DIR__, 'atom.xml']),
                ],
                $this->getExpectedResult(), // expected result
            ],
        ];
    }

    public function getExpectedResult()
    {
        return <<<XML
<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0">
  <channel>
    <title>Новые уроки на Хекслете</title>
    <description>Практические уроки по программированию</description>
    <link>https://ru.hexlet.io/</link>
    <webMaster>info@hexlet.io</webMaster>
    <item>
      <title>Pipeline challenge / Главные испытания</title>
      <guid isPermaLink="false">150</guid>
      <link>https://ru.hexlet.io/courses/main/lessons/pipeline/theory_unit</link>
      <description>Цель: Написать клиент, реализующий передачу сообщений в условиях канала передачи с помехами.</description>
      <pubDate>Wed, 21 Jan 2015 08:59:51 +0000</pubDate>
    </item>
    <item>
      <title>Rails для начинающих / Фреймворки</title>
      <guid isPermaLink="false">226</guid>
      <link>https://ru.hexlet.io/courses/frameworks/lessons/rails_getting_started/theory_unit</link>
      <description>Цель: Научиться работать с фреймворком Rails</description>
      <pubDate>Wed, 25 Mar 2015 12:05:14 +0000</pubDate>
    </item>
    <item>
      <title>Ареалы проживания членистоногих. Конкурс по функциональному программированию 03.2015. / Главные испытания</title>
      <guid isPermaLink="false">205</guid>
      <link>https://ru.hexlet.io/courses/main/lessons/functional-contest-03-2015/theory_unit</link>
      <description>Цель: Получить сатисфакцию</description>
      <pubDate>Thu, 05 Mar 2015 14:56:47 +0000</pubDate>
    </item>
    <item>
      <title>CRUD / Веб-разработка на PHP</title>
      <guid isPermaLink="false">1179</guid>
      <link>https://ru.hexlet.io/courses/php-mvc/lessons/crud/theory_unit</link>
      <description>Цель: Научиться создавать стандартный набор маршрутов для полного управления сущностью</description>
      <pubDate>Mon, 16 Jul 2018 07:50:43 +0000</pubDate>
    </item>
    <item>
      <title>Cookies / Веб-разработка на PHP</title>
      <guid isPermaLink="false">1168</guid>
      <link>https://ru.hexlet.io/courses/php-mvc/lessons/cookies/theory_unit</link>
      <description>Цель: Научиться использовать куки в PHP</description>
      <pubDate>Sun, 15 Jul 2018 18:55:20 +0000</pubDate>
    </item>
    <item>
      <title>Деплой / Веб-разработка на PHP</title>
      <guid isPermaLink="false">1177</guid>
      <link>https://ru.hexlet.io/courses/php-mvc/lessons/deploy/theory_unit</link>
      <description>Цель: Познакомиться с ключевыми понятиями и процессом деплоя</description>
      <pubDate>Sun, 15 Jul 2018 18:40:10 +0000</pubDate>
    </item>
    <item>
      <title>Сессия / Веб-разработка на PHP</title>
      <guid isPermaLink="false">1173</guid>
      <link>https://ru.hexlet.io/courses/php-mvc/lessons/session/theory_unit</link>
      <description>Цель: Научиться использовать сессию в PHP</description>
      <pubDate>Sun, 15 Jul 2018 18:39:53 +0000</pubDate>
    </item>
    <item>
      <title>Стандарт PSR7 / Веб-разработка на PHP</title>
      <guid isPermaLink="false">1163</guid>
      <link>https://ru.hexlet.io/courses/php-mvc/lessons/psr7/theory_unit</link>
      <description>Цель: Познакомиться с интерфейсами HTTP сообщений</description>
      <pubDate>Sun, 15 Jul 2018 18:30:43 +0000</pubDate>
    </item>
    <item>
      <title>Именованные маршруты / Веб-разработка на PHP</title>
      <guid isPermaLink="false">1180</guid>
      <link>https://ru.hexlet.io/courses/php-mvc/lessons/named-routes/theory_unit</link>
      <description>Цель: Научиться использовать более устойчивую систему для управления маршрутизацией</description>
      <pubDate>Sun, 15 Jul 2018 18:30:20 +0000</pubDate>
    </item>
    <item>
      <title>Model-View-Controller (MVC) / Веб-разработка на PHP</title>
      <guid isPermaLink="false">1181</guid>
      <link>https://ru.hexlet.io/courses/php-mvc/lessons/mvc/theory_unit</link>
      <description>Цель: Познакомиться с одним из ключевых архитектурных паттернов построения пользовательских приложений</description>
      <pubDate>Sun, 15 Jul 2018 18:30:13 +0000</pubDate>
    </item>
  </channel>
</rss>
XML;

    }
}

