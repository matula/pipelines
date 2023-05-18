<?php

namespace App\Pipes;

class BasePipe
{
    public function skip(Datasource $datasource): bool
    {
        return false;
    }
}
