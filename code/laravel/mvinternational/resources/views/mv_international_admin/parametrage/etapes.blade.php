@extends('layouts.app_custom')
 

@section('content')

<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Liste des étapes</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('workflows') }}">Workflow</a></li>
            <li class="breadcrumb-item active" aria-current="page">Etape</li>
        </ol>
    </div>
</div> 
<!-- PAGE-HEADER END -->
@livewire('list-etapes',['workflow'=>$workflow])
@endsection
@livewireScripts 