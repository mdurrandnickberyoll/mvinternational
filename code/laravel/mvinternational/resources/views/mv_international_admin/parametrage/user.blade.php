@extends('layouts.app_custom')
 
@section('content')

<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Formulaire d'ajout d'utilisateur</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Paramétrage</a></li>
            <li class="breadcrumb-item active" aria-current="page">Type de composant</li>
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
                <form method="POST" action="{{ route('user_store') }}">
                    @csrf
                    <input type="hidden" name="id" class="form-control" @if(!empty($user)) value="{{ $user->id }}" @endif>
                    <input type="hidden" name="supp" class="form-control" @if(!empty($supp)) value="{{ $supp }}" @endif>

                    <div class="form-row">
                        <div class="col-xl-6 mb-3">
                            <label for="validationDefault01">Nom</label>
                            <input type="text" name="name" class="form-control" @if(!empty($user)) value="{{ $user->name }}" @endif id="validationDefault01" required>

                        </div>
                        <div class="col-xl-6 mb-3">
                            <label for="validationDefault01">Prénom</label>
                            <input type="text" name="prenom" class="form-control" @if(!empty($user)) value="{{ $user->prenom }}" @endif id="validationDefault01" required>

                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-xl-6 mb-3">
                            <label for="validationDefault01">Email</label>
                            <input type="text" name="email" class="form-control" @if(!empty($user)) value="{{ $user->email }}" @endif id="validationDefault01" required>

                        </div>
                        <div class="col-xl-6 mb-3">
                            <label for="validationDefault01">Adresse</label>
                            <input type="text" name="adresse" class="form-control" @if(!empty($user)) value="{{ $user->adresse }}" @endif id="validationDefault01" required>

                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-xl-12 mb-6">
                            <label for="validationDefault01">Telephone</label>
                            <input type="text" name="telephone" class="form-control" @if(!empty($user)) value="{{ $user->telephone }}" @endif id="validationDefault01" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-xl-6 mb-3">
                            <label for="validationDefault01">Mot de passe</label>
                            <input type="password" name="password" class="form-control" @if(!empty($user)) value="{{ $user->password }}" @endif id="validationDefault01" required>

                        </div>
                        <div class="col-xl-6 mb-3">
                            <label for="validationDefault01">Confirmer le mot de passe</label>
                            <input type="password" name="password_confirmation" class="form-control" @if(!empty($user)) value="{{ $user->password_confirmation }}" @endif id="validationDefault01" required>
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
                    <a class="btn btn-default" href="{{ route('users') }}" >Annuler</a>
                </form>
            </div>
        </div>
    </div> 

@endsection
@livewireScripts 