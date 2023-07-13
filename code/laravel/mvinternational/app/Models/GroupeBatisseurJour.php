<?php

namespace App\Models;

use App\Models\GroupeBatisseur;
use App\Models\Jour;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupeBatisseurJour extends Model
{
    use HasFactory, SoftDeletes;

    public function groupe_batisseur() : BelongsTo
    {
        return $this->belongsTo(GroupeBatisseur::class);
    }
    public function jour() : BelongsTo
    {
        return $this->belongsTo(Jour::class);
    }
}
