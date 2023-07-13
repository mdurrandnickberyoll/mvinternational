<?php

namespace App\Models;

use App\Models\GroupeBatisseurJour;
use App\Models\Heure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupeBatisseurJourHeure extends Model
{
    use HasFactory, SoftDeletes;

    public function groupe_batisseur_jour() : BelongsTo
    {
        return $this->belongsTo(GroupeBatisseurJour::class);
    }
    public function heure() : BelongsTo
    {
        return $this->belongsTo(Heure::class);
    }
}
