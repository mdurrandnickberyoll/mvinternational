@extends('layouts.app_custom')
 
@section('content')

<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Formulaire d'affectation des jours</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Procédure</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('groupe_batisseur_jours',[$groupe_batisseur->id]) }}">Jours</a></li>
        </ol>
    </div>
</div> 
<!-- PAGE-HEADER END -->

<!-- formulaire -->
<div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Saisie des information</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('groupe_batisseur_jour_store') }}">
                    @csrf
                    <input type="hidden" name="id" class="form-control" @if(!empty($groupe_batisseur_jour)) value="{{ $groupe_batisseur_jour->id }}" @endif>
                    <input type="hidden" name="supp" class="form-control" @if(!empty($supp)) value="{{ $supp }}" @endif>
                    <input type="hidden" name="groupe_batisseur_id" @if(!empty($groupe_batisseur)) value="{{ $groupe_batisseur->id }}" @endif>

                    <div class="form-row">
                         
                        @if(!empty($jours))
                        <div class="col-xl-6 mb-3">
                            <label for="validationDefault02">Jour</label>
                            <select class="form-control select2-show-search form-select" name="jour_id">
                                <option value="" required="required" >Sélectionnez un jour</option>
                                @foreach($jours as $item)
                                    <option  value="{{ $item->id }}" @if(!empty($groupe_batisseur_jour->jour) && $item->id == $groupe_batisseur_jour->jour->id) selected @endif >{{ $item->libelle }}</option>
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
                    </div> 
                    <button class="btn btn-primary" type="submit">Valider</button>
                    <a class="btn btn-default" href="{{ route('groupe_batisseur_jours',[$groupe_batisseur->id]) }}" >Annuler</a>
                </form>
            </div>
        </div>
    </div> 

@endsection
@livewireScripts 