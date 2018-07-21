<?php

// based on https://en.wikipedia.org/wiki/RSS
// check https://en.wikipedia.org/wiki/Atom_(Web_standard)
return [
    'root_node' => 'rss',
    'root_namespace' => [
        'version' => '2.0',
    ],
    'id'             => 'guid',
    'published'      => 'pubDate',
    'entry'          => 'item',
    'summary'        => 'description',
    'author'         => 'managingEditor',
    'right'          => 'copyright',
    'logo'           => 'image',
];
