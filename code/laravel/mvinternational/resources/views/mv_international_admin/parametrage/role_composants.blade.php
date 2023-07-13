@extends('layouts.app_custom')
 

@section('content')

<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Liste des composant du rôle {{ $role->libelle }}</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('roles') }}">Rôles</a></li>
            <li class="breadcrumb-item active" aria-current="page">Composants</li>
        </ol>
    </div>
</div> 
<!-- PAGE-HEADER END -->
@livewire('list-roles-composants',['role'=>$role])
@endsection
@livewireScripts 