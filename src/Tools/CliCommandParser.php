<?php

namespace App\Tools;

class CliCommandParser
{
    protected $params;
    protected $source;

    public function getParsedCommand($command_parts)
    {
        if (isset($this->params) && isset($this->source)) {
            return [$this->source, $this->params];
        }

        $last_flag = null;

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

        return [$this->source, $this->params];
    }
}