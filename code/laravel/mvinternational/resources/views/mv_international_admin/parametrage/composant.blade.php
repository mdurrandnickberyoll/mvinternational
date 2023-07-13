@extends('layouts.app_custom')

@section('content')

    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Formulaire du composant</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Paramétrage</a></li>
                <li class="breadcrumb-item active" aria-current="page">Composant</li>
            </ol>
        </div>
    </div>
    @if (session()->has('message'))
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
                <form method="POST" action="{{ route('composant_store') }}">
                    @csrf
                    <input type="hidden" name="id" class="form-control" @if (!empty($composant)) value="{{ $composant->id }}" @endif>
                    <input type="hidden" name="supp" class="form-control" @if (!empty($supp)) value="{{ $supp }}" @endif>

                    <div class="form-row">
                        @if (!empty($type_composants))
                            <div class="col-xl-6 mb-3">
                                <label for="validationDefault02">Type de composant</label>
                                <select class="form-control select2-show-search form-select" name="type_composant_id">
                                    <option value="" required="required">Sélectionnez le type de composant </option>
                                    @foreach ($type_composants as $item)
                                        <option value="{{ $item->id }}"
                                            @if (!empty($composant->typeComposant) && $item->id == $composant->typeComposant->id) selected @endif>{{ $item->libelle }}</option>
                                    @endforeach
                                </select>

                                <div class="mt-2">
                                    @error('type_composant_id')
                                        <span class="text-danger " style="font-size: 11.5px">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        @endif
                        <div class="col-xl-6 mb-3">
                            <label for="validationDefault01">Libellé</label>
                            <input type="text" name="libelle" class="form-control"
                                @if (!empty($composant)) value="{{ $composant->libelle }}" @endif
                                id="validationDefault01" required>
                            <div class="mt-2">
                            @error('libelle')
                                <span class="text-danger " style="font-size: 11.5px">{{ $message }}</span>
                             @enderror
                                 
                            </div>

                        </div>
                        <div class="col-xl-6 mb-3">
                            <label for="validationDefault01">Code interne</label>
                            <input type="text" name="codeInterne" class="form-control"
                                @if (!empty($composant)) value="{{ $composant->codeInterne }}" @endif
                                id="validationDefault01" required>
                            <div class="mt-2">
                            @error('codeInterne')
                                <span class="text-danger " style="font-size: 11.5px">{{ $message }}</span>
                             @enderror
                                 
                            </div>

                        </div>
                        
                    </div>
                    <button class="btn btn-primary" type="submit">Valider</button>
                    <a class="btn btn-default" href="{{ route('composants') }}">Annuler</a>
                </form>
            </div>
        </div>
    </div>

@endsection
@livewireScripts
