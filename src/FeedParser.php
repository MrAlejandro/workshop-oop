<?php

namespace App;

use XMLReader;

class FeedParser
{
    protected $reader;
    protected $contents;
    protected $parsed_array;
    protected $current_path;

    const VAL = 'value';
    const VALS = 'values';
    const ATTS = 'attributes';

    public function __construct($contents)
    {
        $this->reader = new XMLReader();
        $this->contents = $contents;
    }

    public function toArray()
    {
        if ($this->parsed_array) {
            return $this->parsed_array;
        }

        $this->reader->xml($this->contents);
        $level = 0;
        $opened_nodes = [];

        while ($this->reader->read()) {
            $node_name = $this->reader->name;
            $node_type = $this->reader->nodeType;

            if ($node_type === XMLReader::END_ELEMENT) {
                if (end($opened_nodes) === $node_name) {
                    array_pop($opened_nodes);
                }
                continue;

            } elseif ($node_type === XMLReader::ELEMENT) {
                $opened_nodes[] = $node_name;
                $path_key = $this->reader->depth;
                $this->current_path[$path_key] = $node_name;

                foreach ($this->current_path as $key => $path_item) {
                    if ($key > $path_key) {
                        unset($this->current_path[$key]);
                    }
                }

                $attributes = $this->getAttributes();
                $this->createParentItem($attributes);

            } elseif ($node_type === XMLReader::TEXT || $node_type === XMLReader::CDATA) {
                $value = '';

                if ($this->reader->hasValue) {
                    $value = $this->reader->value;
                }

                $this->storeValue($value);
            }
        }

        return $this->parsed_array;
    }

    protected function getAttributes()
    {
        $attributes = array();

        if ($this->reader->hasAttributes) {
            while ($this->reader->moveToNextAttribute()) {
                $attributes[$this->reader->name] = $this->reader->value;
            }
        }

        return $attributes;
    }

    protected function createParentItem($attributes = array())
    {
        $path_length = count($this->current_path);
        $current_element = &$this->parsed_array;

        foreach ($this->current_path as $key) {
            $path_length--;
            if (!array_key_exists($key, (array) $current_element)) {
                $current_element[$key] = array();
            }

            if (isset($current_element[$key])) {
                $current_element = &$current_element[$key];
            }

            if ($path_length === 0) {
                if (!empty($current_element)) {
                    if (isset($current_element[self::VALS])) {
                        $max_key = max(array_keys($current_element[self::VALS]));
                        $current_element[self::VALS][$max_key + 1][self::ATTS] = $attributes;
                    } else {
                        $attr = $current_element[self::ATTS];
                        unset($current_element[self::ATTS]);
                        $rest = $current_element;

                        foreach ($current_element as $key => $value) {
                            unset($current_element[$key]);
                        }

                        $current_element[self::VALS][0] = $rest;
                        $current_element[self::VALS][0][self::ATTS] = $attr;
                        $current_element[self::VALS][1][self::ATTS] = $attributes;
                    }
                } else {
                    $current_element[self::ATTS] = $attributes;
                }
            } elseif (isset($current_element[self::VALS])) {
                $max_key = max(array_keys($current_element[self::VALS]));
                $current_element = &$current_element[self::VALS][$max_key];
            }
        }

        unset($current_element);

        return $this;
    }

    protected function storeValue($value = null)
    {
        $path_length = count($this->current_path);
        $current_element = &$this->parsed_array;

        foreach ($this->current_path as $key) {
            $path_length--;

            if (isset($current_element[$key])) {
                $current_element = &$current_element[$key];

                if (isset($current_element[self::VALS])) {
                    $maxKey = max(array_keys($current_element[self::VALS]));
                    $current_element = &$current_element[self::VALS][$maxKey];
                }
            }

            if ($path_length === 0) {
                $current_element[self::VAL] = $value;
            }
        }

        unset($current_element);

        return $this;
    }
}