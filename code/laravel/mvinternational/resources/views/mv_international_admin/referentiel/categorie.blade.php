@extends('layouts.app_custom')
 
@section('content')

<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Formulaire categorie</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Référentiel</a></li>
            <li class="breadcrumb-item active" aria-current="page">Categorie</li>
        </ol>
    </div>
</div>
@if(session()->has('message'))
    <div class="alert alert-success text-center">{{ session('message') }}</div>
@endif
<!-- PAGE-HEADER END -->

<!-- formulaire -->
<div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Saisie des informations des categories</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('categorie_store') }}">
                    @csrf
                    <input type="hidden" name="id" class="form-control" @if(!empty($categorie)) value="{{ $categorie->id }}" @endif>
                    <input type="hidden" name="supp" class="form-control" @if(!empty($supp)) value="{{ $supp }}" @endif>

                    <div class="form-row">
                        <div class="col-xl-6 mb-3">
                            <label for="validationDefault01">Libellé</label>
                            <input type="text" name="libelle" class="form-control" @if(!empty($categorie)) value="{{ $categorie->libelle }}" @endif id="validationDefault01" required>
                             <div class="mt-2">
                            @if($errors->any())
                                @foreach($errors->all() as $error)
                                <span class="text-danger " style="font-size: 11.5px">{{ $error }}</span>
                                @endforeach
                            @endif
                            </div>
                        </div>
                        <div class="col-xl-6 mb-3">
                            <label for="validationDefault01">libellé de l'icone</label>
                            <input type="text" name="icone" class="form-control" @if(!empty($categorie)) {{ empty($categorie->icone) ? '' : 'value='.$categorie->icone }}  placeholder="Ex: fa-user-tie" @endif id="validationDefault01" required>
                             <div class="mt-2">
                            @if($errors->any())
                                @foreach($errors->all() as $error)
                                <span class="text-danger " style="font-size: 11.5px">{{ $error }}</span>
                                @endforeach
                            @endif
                            </div>
                        </div>
                    </div> 
                    <button class="btn btn-primary" type="submit">Valider</button>
                    <a class="btn btn-default" href="{{ route('categories') }}" >Annuler</a>
                </form>
            </div>
        </div>
    </div> 

@endsection
@livewireScripts 