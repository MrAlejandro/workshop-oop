<?php

namespace App\FeedsGenerators;

class AtomGenerator extends FeedGenerator
{
    protected $root_namespace = ['xmlns' => 'http://www.w3.org/2005/AtomGenerator'];
    protected $fields_mapping = [
        'guid'           => 'id',
        'pubDate'        => 'published',
        'item'           => 'entry',
        'description'    => 'summary',
        'managingEditor' => 'author',
        'copyright'      => 'right',
        'image'          => 'logo',
        'tll'            => false,
    ];
}