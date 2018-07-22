<?php

namespace App\Readers;

use App\Enum\SourceTypes;
use App\Tools\Http;

class ReaderFactory
{
    public static function getReader($source)
    {
        $source_type = self::detectSource($source);

        if (!$source_type) {
            throw new \RuntimeException('Cannot detect source');
        }

        $type = ucfirst($source_type);
        $class_name = "\\App\\Readers\\Reader{$type}";

        if (class_exists($class_name)) {

            if ($source_type === SourceTypes::URL) {
                // FIXME: find another way to pass parameter to constructor
                return new $class_name(new Http());
            } else {
                return new $class_name();
            }
        }

        throw new \RuntimeException('Cannot find reader');
    }

    public static function detectSource($source)
    {
        if (file_exists($source)) {
            return SourceTypes::FILE;

        } elseif (filter_var($source, FILTER_VALIDATE_URL) !== false) {
            return SourceTypes::URL;
        }

        return false;
    }
}