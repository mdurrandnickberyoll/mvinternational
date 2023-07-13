@extends('layouts.app_custom')
 

@section('content')

<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Liste des groupes de {{ $batisseur->nom }}</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('batisseurs') }}">Batisseurs</a></li>
            <li class="breadcrumb-item active" aria-current="page">Groupes</li>
        </ol>
    </div>
</div> 
<!-- PAGE-HEADER END -->
@livewire('list-groupe-batisseurs',['batisseur'=>$batisseur])
@endsection
@livewireScripts 