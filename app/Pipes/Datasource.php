<?php

namespace App\Pipes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Datasource
{
    public function __construct(
        public Request $request,
        public ?string $slackTeamId = null,
        public ?string $slackUserId = null,
        public ?string $message = null,
        public ?\App\Models\Client $client = null,
        public ?string $convertedText = null,
        public ?string $filteredText = null,
        public \App\Models\Plumber|Model|null $availablePlumber = null,
        public ?bool $skipThisPipe = false,
        public ?bool $pipeNotSkipped = false,
    ) {
    }
}
