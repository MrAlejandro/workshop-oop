<?php

// based on https://en.wikipedia.org/wiki/RSS
// check https://en.wikipedia.org/wiki/Atom_(Web_standard)
return [
    'root_node' => 'feed',
    'root_namespace' => [
         'xmlns' => 'http://www.w3.org/2005/Atom',
    ],
    'guid'           => 'id',
    'pubDate'        => 'published',
    'item'           => 'entry',
    'description'    => 'summary',
    'managingEditor' => 'author',
    'copyright'      => 'right',
    'image'          => 'logo',
    'tll'            => false,
];