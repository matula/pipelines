<?php

namespace App\Pipes;

use Closure;
use Illuminate\Support\Facades\DB;

class GetAvailablePlumber
{
    public function handle(Datasource $datasource, Closure $next)
    {
        $datasource->availablePlumber = \App\Models\Plumber::with('schedule')
            ->whereHas('schedule', function ($query) {
                // Current time
                $currentTime = now()->toTimeString();
                // current time is between start_time and end_time
                $query->whereRaw("'$currentTime' BETWEEN start_time AND end_time")
                    ->orWhere(function ($query) use ($currentTime) {
                        // for overnight schedules
                        $query->where('start_time', '>', DB::raw('`end_time`'))
                            ->where('start_time', '<=', $currentTime);
                    })
                    ->orWhere(function ($query) use ($currentTime) {
                        $query->where('start_time', '>', DB::raw('`end_time`'))
                            ->where('end_time', '>=', $currentTime);
                    });
            })
            ->firstOrFail();

        return $next($datasource);
    }
}
