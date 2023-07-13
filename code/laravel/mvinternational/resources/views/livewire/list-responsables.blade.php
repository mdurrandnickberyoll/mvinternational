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
                        <a class="btn btn-primary mb-4" href="{{ route('responsable') }}"> Ajouter une ligne</a>
                    </div>
                </div>
                <div class="e-table px-5 pb-5">
                    <div class="table-responsive table-lg">
                        <table class="table border-top table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Prénoms</th>
                                    <th>Adresse</th>
                                    <th>Téléphone</th>
                                    <th>Email</th>
                                    <th>Ville</th>
                                    <th>Statut</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($datas))
                                    @foreach ($datas as $item)
                                        <tr>
                                            <td class="text-nowrap align-middle">{{ $item->nom }}</td>
                                            <td class="text-nowrap align-middle">{{ $item->prenom }}</td>
                                            <td class="text-nowrap align-middle">{{ $item->adresse }}</td>
                                            <td class="text-nowrap align-middle">{{ $item->telephone }}</td>
                                            <td class="text-nowrap align-middle">{{ $item->email }}</td>
                                            <td class="text-nowrap align-middle">{{ $item->ville->libelle }}
                                            </td>
                                            <td class="text-nowrap align-middle">
                                                @if ($item->statut == 0)
                                                    <span style="color:red"> Inactif</span>
                                                    @endif @if ($item->statut == 1)
                                                        <span style="color:green"> Actif</span>
                                                    @endif
                                            </td>

                                            <td class="text-center align-middle">
                                                <div class="btn-group align-top">
                                                    @if ($item->statut == 0)
                                                        <a class="btn btn-sm btn-primary badge"
                                                            href="{{ route('responsable_activate', [$item->id]) }}"
                                                            type="button"><i class="fa fa-check-circle-o"></i></a>
                                                    @endif
                                                    <a class="btn btn-sm btn-primary badge"
                                                        href="{{ route('responsable_edit', [$item->id]) }}"
                                                        type="button"><i class="fa fa-edit"></i></a>
                                                    <a class="btn btn-sm btn-primary badge"
                                                        href="{{ route('responsable_del', [$item->id, 'supp']) }}"
                                                        type="button"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <div wire:loading>
                        </div>

                        {{-- Rafraîchir les données toutes les 10 secondes --}}
                        <div wire:poll.10s>

                        </div>
                    </div>
                </div>

                <div class="text-center px-5">
                    <div class="mb-5">
                        <ul class="pagination justify-content-end ml-auto ">
                            <li class="page-item page-prev {{ $datas->previousPageUrl() ? '' : 'disabled' }}">
                                <a class="page-link" wire:click="previousPage" tabindex="-1">Prev</a>
                            </li>
                    
                            @foreach ($datas->getUrlRange(1, $datas->lastPage()) as $page => $url)
                                <li class="page-item {{ $datas->currentPage() == $page ? 'active' : '' }}">
                                    <a class="page-link" wire:click="gotoPage({{ $page }})">{{ $page }}</a>
                                </li>
                            @endforeach
                    
                            <li class="page-item page-next {{ $datas->nextPageUrl() ? '' : 'disabled' }}">
                                <a class="page-link" wire:click="nextPage">Next</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        <!-- COL-END -->
    </div>
    <!-- ROW CLOSED -->
</div>

