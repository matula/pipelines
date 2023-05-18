<?php

namespace App\Pipes;

use Closure;

class SkipThisPipe extends BasePipe
{
    public function handle(Datasource $datasource, Closure $next)
    {
        $datasource->pipeNotSkipped = true;
        return $next($datasource);
    }

    public function skip(Datasource $datasource): bool
    {
        return $datasource->skipThisPipe ?? false;
    }
}
