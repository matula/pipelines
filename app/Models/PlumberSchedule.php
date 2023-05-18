<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlumberSchedule extends Model
{
    use HasFactory;

    public function plumber(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Plumber::class);
    }
}
