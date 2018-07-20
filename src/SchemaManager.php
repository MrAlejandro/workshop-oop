<?php

namespace App;

class SchemaManager
{
    public function get($name)
    {
        $path = implode(DIRECTORY_SEPARATOR, [DIR_ROOT, 'schemas', "{$name}.php"]);

        if (file_exists($path)) {
            return include($path);
        }

        return [];
    }
}