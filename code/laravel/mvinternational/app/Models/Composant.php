<?php

namespace App\Models;

use App\Models\TypeComposant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Composant extends Model
{
    use HasFactory, SoftDeletes;

     /**
     * Get the user that owns the Organisation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function typeComposant(): BelongsTo
    {
        return $this->belongsTo(TypeComposant::class, 'type_composant_id', 'id');
    }
}
