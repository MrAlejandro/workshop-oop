<?php

namespace App\FeedsGenerators;

use LSS\Array2XML;

abstract class FeedGenerator
{
    protected $root_namespace = '';
    protected $fields_mapping = [];

    public function toXml($feed_content)
    {
        $feed_content = $this->prepareNodes($feed_content);
        $feed_content = $this->prepare($feed_content);

        $feed_xml = Array2XML::createXML($feed_content);

        $doc = new \DomDocument('1.0');
        $doc->preserveWhiteSpace = false;
        $doc->formatOutput = true;
        $doc->loadXML($feed_xml);

        return $doc->saveXML();
    }

    protected function prepare($feed_content)
    {
        return $feed_content;
    }

    protected function prepareNodes($feed_content)
    {
        foreach ($feed_content as $name => $children) {
            if (array_key_exists($name, $this->fields_mapping)
                && $this->fields_mapping[$name] === null
            ) {
                unset($feed_content[$name]);
                continue;

            } elseif (is_array($children)) {
                $feed_content[$name] = $this->prepareNodes($children);
            }

            if (isset($this->fields_mapping[$name])) {
                $feed_content[$this->fields_mapping[$name]] = $children;
                unset($feed_content[$name]);
            }
        }

        return $feed_content;
    }
}