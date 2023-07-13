@extends('layouts.app_custom')

@section('content')

    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Formulaire entreprise</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Procédure</a></li>
                <li class="breadcrumb-item active" aria-current="page">Entreprise</li>
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
                <h3 class="card-title">Saisie des informations des entreprises</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('entreprise_store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" class="form-control"
                        @if (!empty($entreprise)) value="{{ $entreprise->id }}" @endif>
                    <input type="hidden" name="supp" class="form-control"
                        @if (!empty($supp)) value="{{ $supp }}" @endif>

                    <div class="form-row">
                        <div class="col-xl-12 mb-3">
                            <label for="validationDefault01">Nom</label>
                            <input type="text" name="nom" class="form-control"
                                @if (!empty($entreprise)) value="{{ $entreprise->nom }}" @endif
                                id="validationDefault01" required>
                            <div class="mt-2">
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <span class="text-danger " style="font-size: 11.5px">{{ $error }}</span>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="col-xl-12 mb-3">
                            <label for="validationDefault01">Description</label>
                            <textarea class="form-control mb-4" class="form-control" name="description" id="validationDefault01" required
                                rows="4">
@if (!empty($entreprise))
{{ empty($entreprise->description) ? '' : $entreprise->description }}
@endif
</textarea>
                            <div class="mt-2">
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <span class="text-danger " style="font-size: 11.5px">{{ $error }}</span>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        @php
                            if (isset($entreprise)) {
                                $file = App\Models\File::where('id', $entreprise->file_id)
                                    ->latest()
                                    ->first();
                            }
                        @endphp
                        <div class="col-xl-12 mb-3">
                            <input type="file" name="file" class="dropify" data-bs-height="180"
                                data-default-file="{{ empty($entreprise->file_id) ? '' : 'data:application/octet-stream;base64,' . base64_encode($file->binaire) }}" />
                        </div>

                    </div>
                    <button class="btn btn-primary" type="submit">Valider</button>
                    <a class="btn btn-default" href="{{ route('entreprises') }}">Annuler</a>
                </form>
            </div>
        </div>
    </div>

@endsection
@livewireScripts

@section('scripts')
    <!-- FILE UPLOADES JS -->
    <script src="{{ asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>

    <!-- INTERNAL Bootstrap-Datepicker js-->
    <script src="{{ asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

    <!-- INTERNAL File-Uploads Js-->
    <script src="{{ asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>

    <!-- SELECT2 JS -->
    <script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>

    <!-- BOOTSTRAP-DATERANGEPICKER JS -->
    <script src="{{ asset('assets/plugins/bootstrap-daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

    <!-- INTERNAL Bootstrap-Datepicker js-->
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>

    <!-- INTERNAL Sumoselect js-->
    <script src="{{ asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>

    <!-- TIMEPICKER JS -->
    <script src="{{ asset('assets/plugins/time-picker/jquery.timepicker.js') }}"></script>
    <script src="{{ asset('assets/plugins/time-picker/toggles.min.js') }}"></script>

    <!-- INTERNAL intlTelInput js-->
    <script src="{{ asset('assets/plugins/intl-tel-input-master/intlTelInput.js') }}"></script>
    <script src="{{ asset('assets/plugins/intl-tel-input-master/country-select.js') }}"></script>
    <script src="{{ asset('assets/plugins/intl-tel-input-master/utils.js') }}"></script>

    <!-- INTERNAL jquery transfer js-->
    <script src="{{ asset('assets/plugins/jQuerytransfer/jquery.transfer.js') }}"></script>

    <!-- INTERNAL multi js-->
    <script src="{{ asset('assets/plugins/multi/multi.min.js') }}"></script>

    <!-- DATEPICKER JS -->
    <script src="{{ asset('assets/plugins/date-picker/date-picker.js') }}"></script>
    <script src="{{ asset('assets/plugins/date-picker/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/plugins/input-mask/jquery.maskedinput.js') }}"></script>

    <!-- COLOR PICKER JS -->
    <script src="{{ asset('assets/plugins/pickr-master/pickr.es5.min.js') }}"></script>
    <script src="{{ asset('assets/js/picker.js') }}"></script>

    <!-- MULTI SELECT JS-->
    <script src="{{ asset('assets/plugins/multipleselect/multiple-select.js') }}"></script>
    <script src="{{ asset('assets/plugins/multipleselect/multi-select.js') }}"></script>

    <!-- FORMELEMENTS JS -->
    <script src="{{ asset('assets/js/formelementadvnced.js') }}"></script>
    <script src="{{ asset('assets/js/form-elements.js') }}"></script>
@endsectioN
