<?php

namespace App\Readers;

use App\SchemaManager;

class FeedReader
{
    protected $source;
    protected $reader;
    protected $schema_manager;
    protected $reader_factory;

    public function __construct($source, SchemaManager $schema_manager, ReaderFactory $reader_factory)
    {
        $this->source = $source;
        $this->schema_manager = $schema_manager;
        $this->reader_factory = $reader_factory;
    }

    public function getContents()
    {
        $reader = $this->getReader();
        return $reader->read();
    }

    protected function detectSource()
    {
        $source_checks = (array) $this->schema_manager->get('source_checks');

        foreach ($source_checks as $type => $checks) {
            $result = false;

            foreach ($checks as $check) {

                if (is_callable($check)) {
                    $result = (bool) call_user_func_array($check, [$this->source]);
                }
            }

            if ($result) {
                return $type;
            }
        }

        return false;
    }

    protected function getReader()
    {
        if (!$this->reader) {
            $this->reader = $this->reader_factory->getReader(
                $this->detectSource(),
                $this->source
            );
        }

        return $this->reader;
    }
}