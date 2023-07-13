@extends('layouts.app_custom')
 
@section('content')

<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Formulaire du Responsable</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Procédure</a></li>
            <li class="breadcrumb-item active" aria-current="page">Responsable</li>
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
                <h3 class="card-title">Saisie des informations</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('responsable_store') }}">
                    @csrf
                    <input type="hidden" name="id" class="form-control" @if(!empty($responsable)) value="{{ $responsable->id }}" @endif>
                    <input type="hidden" name="supp" class="form-control" @if(!empty($supp)) value="{{ $supp }}" @endif>

                    <div class="form-row">
                        @if(!empty($villes))
                            <div class="col-xl-6 mb-3">
                                <label for="validationDefault02">Ville</label>
                                <select class="form-control select2-show-search form-select" name="ville_id">
                                    <option value="" required="required" >Sélectionnez la ville</option>
                                    @foreach($villes as $item)
                                        <option  value="{{ $item->id }}" @if(!empty($responsable->ville) && $item->id == $responsable->ville->id) selected @endif >{{ $item->libelle }}</option>
                                    @endforeach
                                </select>
    
                                <div class="mt-2">
                                @if($errors->any())
                                    @foreach($errors->all() as $error)
                                    <span class="text-danger " style="font-size: 11.5px">{{ $error }}</span>
                                    @endforeach
                                @endif
                                </div>

                            </div> 
                            @endif
                        <div class="col-xl-6 mb-3">
                            <label for="validationDefault01">Nom</label>
                            <input type="text" name="nom" class="form-control" @if(!empty($responsable)) value="{{ $responsable->nom }}" @endif id="validationDefault01" required>
                             <div class="mt-2">
                            @if($errors->any())
                                @foreach($errors->all() as $error)
                                <span class="text-danger " style="font-size: 11.5px">{{ $error }}</span>
                                @endforeach
                            @endif
                            </div>

                        </div>
                        <div class="col-xl-6 mb-3">
                            <label for="validationDefault01">Prénoms</label>
                            <input type="text" name="prenom" class="form-control" @if(!empty($responsable)) value="{{ $responsable->prenom }}" @endif id="validationDefault01" required>
                             <div class="mt-2">
                            @if($errors->any())
                                @foreach($errors->all() as $error)

                                <span class="text-danger " style="font-size: 11.5px">{{ $error }}</span>
                                @endforeach
                            @endif
                            </div>

                        </div>
                        <div class="col-xl-6 mb-3">
                            <label for="validationDefault01">Adresse</label>
                            <input type="text" name="adresse" class="form-control" @if(!empty($responsable)) value="{{ $responsable->adresse }}" @endif id="validationDefault01" required>
                             <div class="mt-2">
                            @if($errors->any())
                                @foreach($errors->all() as $error)
                                <span class="text-danger " style="font-size: 11.5px">{{ $error }}</span>
                                @endforeach
                            @endif
                            </div>

                        </div>
                        <div class="col-xl-6 mb-3">
                            <label for="validationDefault01">Téléphone</label>
                            <input type="text" name="telephone" class="form-control" @if(!empty($responsable)) value="{{ $responsable->telephone }}" @endif id="validationDefault01" required>
                             <div class="mt-2">
                            @if($errors->any())
                                @foreach($errors->all() as $error)
                                <span class="text-danger " style="font-size: 11.5px">{{ $error }}</span>
                                @endforeach
                            @endif
                            </div>

                        </div>
                        <div class="col-xl-6 mb-3">
                            <label for="validationDefault01">Email</label>
                            <input type="text" name="email" class="form-control" @if(!empty($responsable)) value="{{ $responsable->email }}" @endif id="validationDefault01" >
                             <div class="mt-2">
                            @if($errors->any())
                                @foreach($errors->all() as $error)
                                <span class="text-danger " style="font-size: 11.5px">{{ $error }}</span>
                                @endforeach
                            @endif
                            </div>

                        </div> 

                        <div class="col-xl-6 mb-3">
                            <label for="validationDefault01">Mot de passe</label>
                            <input type="password" name="password" class="form-control" @if(!empty($responsable)) value="{{ $responsable->email }}" @endif id="validationDefault01" >
                             <div class="mt-2">
                            @if($errors->any())
                                @foreach($errors->all() as $error)
                                <span class="text-danger " style="font-size: 11.5px">{{ $error }}</span>
                                @endforeach
                            @endif
                            </div>

                        </div> 

                        <div class="col-xl-6 mb-3">
                            <label for="validationDefault01">Confirmer le Mot de passe</label>
                            <input type="password" name="password_confirmation" class="form-control" @if(!empty($responsable)) value="{{ $responsable->email }}" @endif id="validationDefault01" >
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
                    <a class="btn btn-default" href="{{ route('responsables') }}" >Annuler</a>
                </form>
            </div>
        </div>
    </div> 

@endsection
@livewireScripts 