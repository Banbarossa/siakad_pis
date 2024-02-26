<div class="content">
    @slot('title')
        <h1 class="font-weight-bold">{{ $title }}</h1>
    @endslot


    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <button type="button" wire:click='exportExcel' class="btn btn-tool btn-sm">
                            <i class="fas fa-download"></i>
                        </button>
                    </div>
                    <span>
                        <x-search-default />
                    </span>

                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-head-fixed text-nowrap table-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <x-th-sort label="Nama" name="nama" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                                    <x-th-sort label="NUPL" name="nupl" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                                    <x-th-sort label="Tempat Lahir" name="tempat_lahir" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                                    <x-th-sort label="Tanggal Lahir" name="tanggal_lahir" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                                    {{-- <th>Jabatan</th> --}}
                                    <x-th-sort label="Status Menikah" name="status_nikah" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $nomor = ($pegawais->currentPage() - 1) * $pegawais->perPage() + 1;
                                @endphp

                                @forelse($pegawais as $item)
                                    <tr>
                                        <td>{{ $nomor++ }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->nupl }}</td>
                                        <td>{{ $item->tempat_lahir }}</td>
                                        <td>{{ $item->tanggal_lahir }}</td>
                                        {{-- <td>
                                            Jabatan
                                        </td> --}}
                                        <td>
                                            @if ($item->status_nikah == 1)
                                                Belum Menikah
                                            @elseif ($item->status_nikah == 2)
                                                Menikah
                                            @elseif ($item->status_nikah == 3)
                                                Duda
                                            @else
                                                Janda
                                            @endif
                                        </td>
                                        <td>
                                            
                                            <a wire:navigate
                                                href="{{ route('admin.pegawai.show',$item->id) }}"
                                                class="btn btn-sm btn-outline-success" title="Lihat Detail"><i
                                                    class="fas fa-eye"></i>
                                            </a>
                                        </td>


                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2">Tidak Ada Data pegawai</td>
                                    </tr>
                                @endforelse


                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="card-tools">
                        <div class="d-flex">
                            <div class="mr-4">
                                <x-pagination-select></x-pagination-select>
                            </div>
                            <div>{{ $pegawais->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>

    



</div>
