<?php

namespace App\Models;

use App\Http\Livewire\Groupe;
use App\Models\Genre;
use App\Models\Heure;
use App\Models\TrancheAge;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Batisseur extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['nom'];

    public function ville()
    {
        return $this->belongsTo(Ville::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function heure()
    {
        return $this->belongsTo(Heure::class);
    }

    public function Jour()
    {
        return $this->belongsTo(Jour::class);
    }

    public function tranche_age()
    {
        return $this->belongsTo(TrancheAge::class);
    }

    public function groupe()
    {
        return $this->belongsTo(Groupe::class);
    }


}
