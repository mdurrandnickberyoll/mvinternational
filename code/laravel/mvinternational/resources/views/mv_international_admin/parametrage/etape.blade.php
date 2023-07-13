@extends('layouts.app_custom')
 
@section('content')

<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Formulaire de l'étape</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Référentiel</a></li>
            <li class="breadcrumb-item active" aria-current="page">Etape</li>
        </ol>
    </div>
</div> 
<!-- PAGE-HEADER END -->

<!-- formulaire -->
<div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Saisie des informations</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('etape_store') }}">
                    @csrf
                    <input type="hidden" name="id" class="form-control" @if(!empty($etape)) value="{{ $etape->id }}" @endif>
                    <input type="hidden" name="supp" class="form-control" @if(!empty($supp)) value="{{ $supp }}" @endif>
                    <input type="hidden" name="workflow_id" class="form-control" @if(!empty($workflow)) value="{{ $workflow->id }}" @endif>

                    <div class="form-row">
                        <div class="col-xl-6 mb-3">
                            <label for="validationDefault01">Action</label>
                            <input type="text" name="libelle" class="form-control" @if(!empty($etape)) value="{{ $etape->libelle }}" @endif id="validationDefault01" required>
                             <div class="mt-2">
                            @if($errors->any())
                                @foreach($errors->all() as $error)
                                <span class="text-danger " style="font-size: 11.5px">{{ $error }}</span>
                                @endforeach
                            @endif
                            </div>

                        </div>
                        <div class="col-xl-6 mb-3">
                            <label for="validationDefault01"><b>Séquence</b></label>
                            <input type="number" name="sequence" class="form-control" @if(!empty($etape)) value="{{ $etape->sequence }}" @endif id="validationDefault01" required>
                             <div class="mt-2">
                            @if($errors->any())
                                @foreach($errors->all() as $error)
                                <span class="text-danger " style="font-size: 11.5px">{{ $error }}</span>
                                @endforeach
                            @endif
                            </div> 
                         </div>
                         @if(!empty($statuts))
                        <div class="col-xl-6 mb-3">
                            <label for="validationDefault02">Statut initial</label>
                            <select class="form-control" name="statut_debut">
                                <option value="" required="required" >Sélectionnez le statut </option>
                                @foreach($statuts as $item)
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
                        <div class="col-xl-6 mb-3">
                            <label for="validationDefault02">Statut final</label>
                            <select class="form-control" name="statut_fin">
                                <option value="" required="required" >Sélectionnez le statut </option>
                                @foreach($statuts as $item)
                                    <option  value="{{ $item->id }}" >{{ $item->libelle }}</option>
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
                        @if(!empty($roles))
                        <div class="col-xl-6 mb-3">
                            <label for="validationDefault02">Rôle</label>
                            <select class="form-control" name="role">
                                <option value="" required="required" >Sélectionnez le rôle </option>
                                @foreach($roles as $item)
                                    <option  value="{{ $item->id }}" @if(!empty($etape->role) && $item->id == $etape->role->id) selected @endif >{{ $item->libelle }}</option>
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
                    <a class="btn btn-default" href="{{ route('etapes',[$workflow->id]) }}" >Annuler</a>
                </form>
            </div>
        </div>
    </div> 

@endsection
@livewireScripts 