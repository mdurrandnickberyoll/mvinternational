@extends('layouts.app_custom')
 
@section('content')

<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Formulaire d'affectation des compsants</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Paramétrage</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('role_composants',[$role->id]) }}">Composants</a></li>
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
                <form method="POST" action="{{ route('role_composant_store') }}">
                    @csrf
                    <input type="hidden" name="id" class="form-control" @if(!empty($role_composant)) value="{{ $role_composant->id }}" @endif>
                    <input type="hidden" name="supp" class="form-control" @if(!empty($supp)) value="{{ $supp }}" @endif>
                    <input type="hidden" name="role_id" @if(!empty($role)) value="{{ $role->id }}" @endif>

                    <div class="form-row">
                         
                        @if(!empty($composants))
                        <div class="col-xl-6 mb-3">
                            <label for="validationDefault02">Composant</label>
                            <select class="form-control" name="composant_id">
                                <option value="" required="required" >Sélectionnez le composant </option>
                                @foreach($composants as $item)
                                    <option  value="{{ $item->id }}" @if(!empty($role_composant->composant) && $item->id == $role_composant->composant->id) selected @endif >{{ $item->libelle }}</option>
                                @endforeach
                            </select>
 
                             <div class="mt-2">
                            @error('composant_id')
                                <span class="text-danger " style="font-size: 11.5px">{{ $message }}</span>
                             @enderror
                            </div>

                        </div> 
                        @endif
                    </div> 
                    <button class="btn btn-primary" type="submit">Valider</button>
                    <a class="btn btn-default" href="{{ route('role_composants',[$role->id]) }}" >Annuler</a>
                </form>
            </div>
        </div>
    </div> 

@endsection
@livewireScripts 