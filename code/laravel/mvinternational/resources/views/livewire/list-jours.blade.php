<div>
    <!-- ROW OPEN -->
    <div class="row row-cards">
        <div class="col-lg-12 col-xl-12">
            <div class="input-group mb-5">

                <input type="text" wire:model.debounce.500ms="src_val" class="form-control" placeholder="Recherche...">
                <div class="input-group-text btn btn-primary">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </div>
            </div>
            <div class="card">
                <div class="card-header border-bottom-0 p-4">
                    <h2 class="card-title"></h2>
                    <div class="page-options d-flex float-end">
                        <a class="btn btn-primary mb-4" href="{{ route('jour') }}"> Ajouter une ligne</a>
                    </div>
                </div>
                <div class="e-table px-5 pb-5">
                    <div class="table-responsive table-lg">
                        <table id="file-datatable" class="table border-top table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>Libellé</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($datas))
                                    @foreach ($datas as $item)
                                        <tr>

                                            <td class="text-nowrap align-middle">{{ $item->libelle }}</td>
                                            <td class="text-center align-middle">
                                                <div class="btn-group align-top">
                                                    <a class="btn btn-sm btn-primary badge"
                                                        href="{{ route('jour_edit', [$item->id]) }}" type="button"><i
                                                            class="fa fa-edit"></i></a>
                                                    <a class="btn btn-sm btn-primary badge"
                                                        href="{{ route('jour_del', [$item->id, 'supp']) }}"
                                                        type="button"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>

                        {{-- <div>
                            <ul class="pagination justify-content-center">
                                <li class="page-item page-prev {{ $datas->previousPageUrl() ? '' : 'disabled' }}">
                                    <a class="page-link" href="{{ $datas->previousPageUrl() ?? 'javascript:void(0)' }}"
                                        tabindex="-1">Prev</a>
                                </li>


                                @foreach ($datas->getUrlRange(1, $datas->lastPage()) as $page => $url)
                                    <li class="page-item {{ $datas->currentPage() == $page ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach

                                <li class="page-item page-next {{ $datas->nextPageUrl() ? '' : 'disabled' }}">
                                    <a class="page-link"
                                        href="{{ $datas->nextPageUrl() ?? 'javascript:void(0)' }}">Next</a>
                                </li>
                            </ul>
                        </div> --}}
                        
                        
                        
                        
                        
                        
                        
                    </div>
                </div>
            </div>

        </div>
        <!-- COL-END -->
    </div>
    <!-- ROW CLOSED -->
</div>
