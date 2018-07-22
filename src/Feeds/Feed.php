<?php

namespace App\Feeds;

abstract class Feed
{
    protected $root_namespace = '';
    protected $fields_mapping = [];

    public function toXml($contents)
    {
        if (empty($this->fields_mapping)) {
            throw new \RuntimeException('Cannot generate xml');
        }

        $root_node = key($contents);
        $xml = new \SimpleXMLElement(
            sprintf('<?xml version="1.0" encoding="utf-8"?><%s></%s>', $root_node, $root_node)
        );

        $this->addAttributes($xml, $this->root_namespace);
        $xml = $this->build($xml, reset($contents));

        $doc = new \DomDocument('1.0');
        $doc->preserveWhiteSpace = false;
        $doc->formatOutput = true;
        $doc->loadXML($xml->asXML());

        return $doc->saveXML();
    }

    protected function addAttributes(&$node, $attributes)
    {
        foreach ($attributes as $name => $value) {
            $data = [
                'name' => $name,
                'value' => $value,
            ];

            if (strpos($name, ':') !== false) {
                list($namespace, $name) = explode(':', $name);
                $data['name'] = $name;
                $data['namespace'] = $namespace;
            }

            @call_user_func_array([$node, 'addAttribute'], $data);
        }
    }

    protected function build(&$xml, $contents, $parent_name = null)
    {
        foreach ($contents as $name => $data) {
            $name = isset($this->fields_mapping[$name]) ? $this->fields_mapping[$name] : $name;
            $name = is_numeric($name) && !is_null($parent_name) ? $parent_name : $name;

            if ($name === false) {
                continue;
            }

            if ($name == 'attributes') {
                $this->addAttributes($xml, $data);
            } elseif (isset($data['values'])) {
                $this->build($xml, $data['values'], $name);
            } elseif (!isset($data['value'])) {
                $child = $xml->addChild($name);
                $this->build($child, $data);
            } else {
                $child = $xml->addChild($name, $data['value']);
                $this->addAttributes($child, $data['attributes']);
            }
        }

        return $xml;
    }
}