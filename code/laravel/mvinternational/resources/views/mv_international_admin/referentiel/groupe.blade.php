@extends('layouts.app_custom')
 
@section('content')

<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Formulaire de Groupe</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Référentiel</a></li>
            <li class="breadcrumb-item active" aria-current="page">Groupe</li>
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
                <h3 class="card-title">Saisie des informations des Groupes</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('groupe_store') }}">
                    @csrf
                    <input type="hidden" name="id" class="form-control" @if(!empty($groupe)) value="{{ $groupe->id }}" @endif>
                    <input type="hidden" name="supp" class="form-control" @if(!empty($supp)) value="{{ $supp }}" @endif>

                    <div class="form-row">
                        @if(!empty($jours))
                            <div class="col-xl-6 mb-3">
                                <label for="validationDefault02">Jour</label>
                                <select class="form-control" name="jour_id">
                                    <option value="" required="required" >Sélectionnez un jour </option>
                                    @foreach($jours as $item)
                                        <option  value="{{ $item->id }}"  >{{ $item->libelle }}</option>
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
                        
                        @if(!empty($heures))
                            <div class="col-xl-6 mb-3">
                                <label for="validationDefault02">Jour</label>
                                <select class="form-control" name="jour_id">
                                    <option value="" required="required" >Sélectionnez une heure </option>
                                    @foreach($heures as $item)
                                        <option  value="{{ $item->id }}"  >{{ $item->libelle }}</option>
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
                            <label for="validationDefault01">Libellé</label>
                            <input type="text" name="libelle" class="form-control" @if(!empty($groupe)) value="{{ $groupe->libelle }}" @endif id="validationDefault01" required>
                             <div class="mt-2">
                            @if($errors->any())
                                @foreach($errors->all() as $error)
                                <span class="text-danger " style="font-size: 11.5px">{{ $error }}</span>
                                @endforeach
                            @endif
                            </div>

                        </div>
                        <div class="col-xl-6 mb-3">
                            <label for="validationDefault02">Description</label>
                            <input  type="text" name="description" @if(!empty($groupe)) value="{{ $groupe->description }}" @endif class="form-control" id="validationDefault02">
                        </div>
                    </div> 
                    <button class="btn btn-primary" type="submit">Valider</button>
                    <a class="btn btn-default" href="{{ route('groupes') }}" >Annuler</a>
                </form>
            </div>
        </div>
    </div> 

@endsection
@livewireScripts 