@extends('layouts.app_custom')

@section('content')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Détails sur les informations de {{ $entreprise->nom }}</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Procédure</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('entreprises') }}">entreprises</a>
                </li>
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
                                                <label>Nom de l'entreprise</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 mb-0">
                                            <div class="form-group">
                                                <label><b>{{ $entreprise->nom }}</b></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-0">
                                            <div class="form-group">
                                                <label>Description</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 mb-0">
                                            <div class="form-group">
                                                <label><b>{{ $entreprise->description }}</b></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="expanel expanel-default">
                                <div class="expanel-heading">
                                    <h3 class="expanel-title">Entreprise : <b>{{ $entreprise->nom }}</b></h3>
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
                                                @if (!empty($entreprise->file_id))
                                                    @php
                                                        $file = App\Models\File::where('id', $entreprise->file_id)->latest()->first();
                                                    @endphp
                                                    <tr>
                                                        <td rowspan="3" class="text-nowrap align-middle text-center">
                                                            {{ $file->file_name }}
                                                        </td>
                                                    </tr>
                                                    <tr class="text-center">
                                                        <td>
                                                            <div class="btn-group align-top">
                                                                <a class="btn btn-sm btn-primary badge" target="_blank"
                                                                    href="{{ route('entreprise_image_show', [$entreprise->file_id]) }}"
                                                                    type="button"><i class="fa fa-binoculars"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@livewireScripts
