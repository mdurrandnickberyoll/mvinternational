@extends('layouts.app_custom')
 
@section('content')

<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Formulaire d'affectation de rôle</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Paramétrage</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('user_roles',[$user->id]) }}">Rôles</a></li>
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
                <form method="POST" action="{{ route('user_role_store') }}">
                    @csrf
                    <input type="hidden" name="id" class="form-control" @if(!empty($user_role)) value="{{ $user_role->id }}" @endif>
                    <input type="hidden" name="supp" class="form-control" @if(!empty($supp)) value="{{ $supp }}" @endif>
                    <input type="hidden" name="user_id" @if(!empty($user)) value="{{ $user->id }}" @endif>

                    <div class="form-row">
                         
                        @if(!empty($roles))
                        <div class="col-xl-6 mb-3">
                            <label for="validationDefault02">Rôle</label>
                            <select class="form-control select2-show-search form-select" name="role_id">
                                <option value="" required="required" >Sélectionnez le rôle </option>
                                @foreach($roles as $item)
                                    <option  value="{{ $item->id }}" @if(!empty($user_role->role) && $item->id == $user_role->role->id) selected @endif >{{ $item->libelle }}</option>
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
                    <a class="btn btn-default" href="{{ route('user_roles',[$user->id]) }}" >Annuler</a>
                </form>
            </div>
        </div>
    </div> 

@endsection
@livewireScripts 