<?php

namespace App\Models;

use App\Models\TypeOrganisation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organisation extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Get the user that owns the Organisation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function typeOrganisation(): BelongsTo
    {
        return $this->belongsTo(TypeOrganisation::class, 'type_organisation_id', 'id');
    }
}
