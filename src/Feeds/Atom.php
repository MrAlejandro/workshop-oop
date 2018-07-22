<?php

namespace App\Feeds;

class Atom
{
    protected $root_namespace = ['xmlns' => 'http://www.w3.org/2005/Atom'];
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