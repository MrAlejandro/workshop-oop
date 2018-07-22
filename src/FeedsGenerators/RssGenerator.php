<?php

namespace App\FeedsGenerators;

class RssGenerator extends FeedGenerator
{
    protected $root_namespace = ['version' => '2.0'];
    protected $fields_mapping = [
        'id'        => 'guid',
        'published' => 'pubDate',
        'entry'     => 'item',
        'summary'   => 'description',
        'author'    => 'managingEditor',
        'right'     => 'copyright',
        'logo'      => 'image',
    ];
}