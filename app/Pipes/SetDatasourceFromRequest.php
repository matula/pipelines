<?php

namespace App\Pipes;

use Closure;

class SetDatasourceFromRequest
{
    public function handle(Datasource $datasource, Closure $next)
    {
        $datasource->slackTeamId = $datasource->request->input('team_id');
        $datasource->slackUserId = $datasource->request->input('event.user');
        $datasource->message = $datasource->request->input('event.text');
        return $next($datasource);
    }
}
