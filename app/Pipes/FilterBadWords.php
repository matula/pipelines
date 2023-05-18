<?php

namespace App\Pipes;

use Closure;

class FilterBadWords
{
    public function handle(Datasource $datasource, Closure $next)
    {
        $filteredWords = [
            '/fork/i' => 'f~~~',
            '/short/i' => 's~~~',
            '/heck/i' => 'h~~~',
        ];

        $datasource->filteredText = preg_replace(
            array_keys($filteredWords), array_values($filteredWords), $datasource->convertedText
        );

        return $next($datasource);
    }
}
