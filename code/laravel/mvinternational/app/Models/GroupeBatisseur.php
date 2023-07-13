<?php

namespace App\Models;

use App\Models\Batisseur;
use App\Models\Groupe;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupeBatisseur extends Model
{
    use HasFactory, SoftDeletes;

    public function groupe() : BelongsTo
    {
        return $this->belongsTo(Groupe::class);
    } 

    public function batisseur() : BelongsTo
    {
        return $this->belongsTo(Batisseur::class);
    }
    
   
}
