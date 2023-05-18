<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plumber extends Model
{
    use HasFactory;

    public function schedule(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(PlumberSchedule::class);
    }
}
