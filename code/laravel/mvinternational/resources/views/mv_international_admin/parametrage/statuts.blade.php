@extends('layouts.app_custom')


@section('content')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Liste des statuts</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Référentiel</a></li>
                <li class="breadcrumb-item active" aria-current="page">Statut</li>
            </ol>
        </div>
    </div>
    @if (session()->has('message'))
        <div class="alert alert-success text-center">{{ session('message') }}</div>
    @endif
    <!-- PAGE-HEADER END -->
    @livewire('list-statuts')
@endsection
@livewireScripts 
