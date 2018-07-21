<?php

namespace App;

class FeedCommand
{
    protected $params;
    protected $source;
    protected $command_parts;

    public function __construct($command_parts)
    {
        $this->command_parts = $command_parts;
    }

    public function getParsedCommand()
    {
        if (isset($this->params) && isset($this->source)) {
            return [$this->params, $this->source];
        }

        $last_flag = null;
        $command_parts = $this->command_parts;

        $this->source = array_pop($command_parts);
        unset($command_parts[0]);

        foreach ($command_parts as $flag) {
            if (strpos($flag, '-') === 0) {
                $last_flag = trim($flag, '-');
                $this->params[$last_flag] = null;
            } else {

                if ($last_flag === null) {
                    throw new \RuntimeException('Invalid format');
                    // TODO: show help
                }

                $this->params[$last_flag] = $flag;
                $last_flag = null;
            }
        }

        return [$this->params, $this->source];
    }
}