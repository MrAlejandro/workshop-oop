<?php

namespace App\Readers;

class ReaderFactory
{
    public function getReader($source_type, $source)
    {
        if (!$source_type) {
            throw new \RuntimeException('Invalid source type provided');
        }

        $type = ucfirst($source_type);
        $class_name = "\\App\\Readers\\Reader{$type}";//"Reader{$type}";
//        $path = implode(DIRECTORY_SEPARATOR, [DIR_ROOT, 'src', 'Readers', "{$class_name}.php"]);

        if (class_exists($class_name)) {
//            require_once($path);
//            $full_class_name = "\\App\\Readers\\{$class_name}";
            return new $class_name($source);
        }

        throw new \RuntimeException('Cannot find reader');
    }
}