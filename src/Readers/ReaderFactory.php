<?php

namespace App\Readers;

class ReaderFactory
{
    public function getReader($source_type, $source)
    {
        $type = ucfirst($source_type);
        $class_name = "Reader{$type}";
        $path = implode(DIRECTORY_SEPARATOR, [DIR_ROOT, 'src', 'Readers', "{$class_name}.php"]);

        if (file_exists($path)) {
            require_once($path);
            $full_class_name = "\\App\\Readers\\{$class_name}";
            return new $full_class_name($source);
        }

        throw new \RuntimeException('Cannot find reader');
    }
}