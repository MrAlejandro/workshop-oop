<?php

namespace App\FeedsGenerators;

class AtomGenerator extends FeedGenerator
{
    protected $root_name = 'feed';
    protected $root_namespace = ['xmlns' => 'http://www.w3.org/2005/AtomGenerator'];
    protected $fields_mapping = [
        'entry'          => null,
        'feed'           => 'rss',
        'guid'           => 'id',
        'pubDate'        => 'published',
        'item'           => 'entry',
        'description'    => 'summary',
        'managingEditor' => 'author',
        'copyright'      => 'right',
        'image'          => 'logo',
        'tll'            => null, // remove node and containing information
        'channel'        => false // remove node but leave containing information
    ];

    public function prepare($feed_content)
    {
        foreach ($feed_content as $name => $children) {

            if ($name ) {

            }
        }
    }
}