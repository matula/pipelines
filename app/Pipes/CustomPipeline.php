<?php

namespace App\Pipes;

use Closure;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Log;

class CustomPipeline extends Pipeline
{
    public function start(Datasource $datasource, array $pipes, $dispatchFunc = null)
    {
        return $this->send($datasource)->through($this->preprocess($pipes))->then($dispatchFunc);
    }

    public function preprocess($pipes): array
    {
        $newPipes = [];
        foreach ($pipes as $pipe) {
            $newPipes[] = function ($datasource, Closure $next) use ($pipe) {
                $pipe = new $pipe;
                Log::info('Pipe -> ' . get_class($pipe), ['start' => microtime(true)]);
                $pipe->handle($datasource, $next);
                Log::info('Pipe -> ' . get_class($pipe), ['end' => microtime(true)]);
                return $next($datasource);
            };
        }

        return $newPipes;
    }
}
