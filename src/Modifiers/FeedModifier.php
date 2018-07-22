<?php

namespace App\Modifiers;

class FeedModifier
{
    protected $params;
    protected $item_nodes = ['item', 'entry'];

    public function __construct($params)
    {
        $this->params = $params;
    }

    public function modify($parsed_feed)
    {
        return $parsed_feed;
    }
}