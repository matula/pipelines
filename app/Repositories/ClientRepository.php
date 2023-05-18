<?php

namespace App\Repositories;

class ClientRepository
{
    public function getBySlackTeamId(string $slackTeamId)
    {
        return \App\Models\Client::where('slack_team_id', $slackTeamId)
            ->firstOrFail();
    }
}
