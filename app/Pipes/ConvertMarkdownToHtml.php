<?php

namespace App\Pipes;

use Closure;

class ConvertMarkdownToHtml
{
    public function handle(Datasource $datasource, Closure $next)
    {
        $datasource->convertedText = (new \League\CommonMark\CommonMarkConverter())
            ->convert($datasource->message);

        return $next($datasource);
    }
}
