<?php

namespace App\Models;

use App\Models\Heure;
use App\Models\Jour;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Groupe extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function jour() : BelongsTo
    {
        return $this->belongsTo(Jour::class);
    }

    public function heure() : BelongsTo
    {
        return $this->belongsTo(Heure::class);
    }


}
