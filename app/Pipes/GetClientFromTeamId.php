<?php

namespace App\Pipes;

use App\Repositories\ClientRepository;
use Closure;

class GetClientFromTeamId
{
    public function __construct(protected ClientRepository $clientRepository)
    {
    }

    public function handle(Datasource $datasource, Closure $next)
    {
        $datasource->client = $this->clientRepository
            ->getBySlackTeamId($datasource->slackTeamId);

        return $next($datasource);
    }
}
