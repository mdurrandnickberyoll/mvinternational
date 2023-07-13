@extends('layouts.app_custom')
 

@section('content')

<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Liste des groupes de {{ $groupe_batisseur->groupe->libelle }}</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ back()}}">Groupes</a></li>
            <li class="breadcrumb-item active" aria-current="page">Jours</li>
        </ol>
    </div>
</div> 
<!-- PAGE-HEADER END -->
@livewire('list-groupe-batisseur-jour',['groupe_batisseur'=>$groupe_batisseur])
@endsection
@livewireScripts 