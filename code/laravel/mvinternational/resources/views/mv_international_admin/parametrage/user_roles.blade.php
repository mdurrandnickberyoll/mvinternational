@extends('layouts.app_custom')
 

@section('content')

<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Liste des rôles de {{ $user->name }}</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('users') }}">Utilisateurs</a></li>
            <li class="breadcrumb-item active" aria-current="page">Rôles</li>
        </ol>
    </div>
</div> 
<!-- PAGE-HEADER END -->
@livewire('list-user-roles',['user'=>$user])
@endsection
@livewireScripts 