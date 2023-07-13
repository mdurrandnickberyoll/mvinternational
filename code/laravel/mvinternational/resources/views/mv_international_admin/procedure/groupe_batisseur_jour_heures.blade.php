@extends('layouts.app_custom')
 

@section('content')

<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Liste des heures de {{ $groupe_batisseur_jour->jour->libelle }}</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ back()}}">Jours</a></li>
            <li class="breadcrumb-item active" aria-current="page">Heure</li>
        </ol>
    </div>
</div> 
<!-- PAGE-HEADER END -->
@livewire('list-groupe-batisseur-jour-heures',['groupe_batisseur_jour'=>$groupe_batisseur_jour])
@endsection
@livewireScripts 