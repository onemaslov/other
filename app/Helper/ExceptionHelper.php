<?php

namespace App\Helper;

use Throwable;

class ExceptionHelper
{
    public static function getTrace(Throwable $throwable): array
    {
        $trace = [];

        foreach ($throwable->getTrace() as $item) {
            if (array_key_exists('file', $item) && strpos($item['file'], '/app/') !== false) {
                $trace[] = $item;
            }
        }

        return $trace;
    }
}
