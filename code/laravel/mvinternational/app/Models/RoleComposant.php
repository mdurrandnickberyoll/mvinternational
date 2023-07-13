<?php

namespace App\Models;

use App\Models\Composant;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleComposant extends Model
{
    use HasFactory, SoftDeletes;

    public function role() : BelongsTo
    {
        return $this->belongsTo(Role::class);
    } 

    public function composant() : BelongsTo
    {
        return $this->belongsTo(Composant::class);
    } 
}
