<?php

namespace App\Pipes;

use Illuminate\Support\Facades\Mail;

class SendPlumberAlert
{
    public function handle(Datasource $datasource): bool
    {
        Mail::to($datasource->availablePlumber->email)
            ->send(new \App\Mail\PlumberAlert($datasource->client, $datasource->filteredText));

        return true;
    }
}
