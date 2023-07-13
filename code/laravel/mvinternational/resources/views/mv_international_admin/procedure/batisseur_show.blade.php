@extends('layouts.app_custom')

@section('content')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Détails sur les informations de {{ $batisseur->nom }}</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Procédure</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('batisseurs') }}">Batisseurs</a></li>
            </ol>
        </div>
    </div>
    @if (session()->has('message'))
        <div class="alert {{ Session::get('alert-class', 'alert-info') }} text-center">{{ Session::get('message') }}</div>
    @endif

    <!-- PAGE-HEADER END -->

    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="expanel expanel-default">

                                <div class="expanel-heading">

                                    <h3 class="expanel-title">Information générales</h3>
                                </div>
                                <div class="expanel-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-0">
                                            <div class="form-group">
                                                <label>Nom(s)</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 mb-0">
                                            <div class="form-group">
                                                <label><b>{{ $batisseur->nom }}</b></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-0">
                                            <div class="form-group">
                                                <label>Prénom(s)</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 mb-0">
                                            <div class="form-group">
                                                <label><b>{{ $batisseur->prenom }}</b></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-0">
                                            <div class="form-group">
                                                <label>Numéro</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 mb-0">
                                            <div class="form-group">
                                                <label><b>{{ $batisseur->id }}</b></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-0">
                                            <div class="form-group">
                                                <label>Genre</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 mb-0">
                                            <div class="form-group">
                                                <label><b>{{ $batisseur->genre->libelle }}</b></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-0">
                                            <div class="form-group">
                                                <label>Email</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 mb-0">
                                            <div class="form-group">
                                                <label><b>{{ $batisseur->email }}</b></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-0">
                                            <div class="form-group">
                                                <label>Pays</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 mb-0">
                                            <div class="form-group">
                                                <label><b>{{ $batisseur->ville->pays->libelle }}</b></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-0">
                                            <div class="form-group">
                                                <label>Ville</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 mb-0">
                                            <div class="form-group">
                                                <label><b>{{ $batisseur->ville->libelle }}</b></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-0">
                                            <div class="form-group">
                                                <label>tranche d'age</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 mb-0">
                                            <div class="form-group">
                                                <label><b>{{ $batisseur->tranche_age->libelle }}</b></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-0">
                                            <div class="form-group">
                                                <label>Eglise</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 mb-0">
                                            <div class="form-group">
                                                <label><b>{{ $batisseur->eglise }}</b></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            @foreach ($groupes as $item)
                                @php
                                    $groupe_batisseurs_jours = App\Models\GroupeBatisseurJour::where('groupe_batisseur_id', $item->id)->get();
                                @endphp
                                <div class="expanel expanel-default">
                                    <div class="expanel-heading">
                                        <h3 class="expanel-title">Groupe : <b>{{ $item->groupe->libelle }}</b></h3>
                                    </div>
                                    <div class="expanel-body">
                                        <div class="table-responsive table-lg">
                                            <table id="file-datatable" class="table border-top table-bordered mb-0">
                                                {{-- <thead>
                                                    <tr>
                                                        <th>Nom</th>
                                                        <th>Prénom</th>
                                                        <th>Téléphone</th>
                                                    </tr>
                                                </thead> --}}
                                                <tbody>
                                                    @if (!empty($groupe_batisseurs_jours))
                                                        @foreach ($groupe_batisseurs_jours as $groupe_batisseurs_jour)
                                                            @php
                                                                $groupe_batisseurs_jour_heures = App\Models\GroupeBatisseurJourHeure::where('groupe_batisseur_jour_id', $groupe_batisseurs_jour->id)->get();
                                                            @endphp
                                                            <tr>
                                                                <td rowspan="3"
                                                                    class="text-nowrap align-middle text-center">
                                                                    {{ $groupe_batisseurs_jour->jour->libelle }}

                                                                </td>
                                                            </tr>
                                                            @foreach ($groupe_batisseurs_jour_heures as $groupe_batisseurs_jour_heure)
                                                                <tr class="text-center">
                                                                    <td>{{ $groupe_batisseurs_jour_heure->heure->libelle }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@livewireScripts
