<?php

namespace App\Models;

use App\Models\Ville;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Responsable extends Model
{
    use HasFactory, SoftDeletes;

    public function ville()
    {
        return $this->belongsTo(Ville::class);
    }
}
