<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Etape extends Model
{
    use HasFactory, SoftDeletes;

    public function statut_final($id)
    {
        return Statut::find($id);
    }

    public function statut_initial($id)
    {
        return Statut::find($id);
    }

    public function workflow()
    {
        return $this->belongsTo(Workflow::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
