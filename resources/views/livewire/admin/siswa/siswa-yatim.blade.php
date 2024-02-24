<div class="content">
    @slot('title')
        <h1 class="font-weight-bold">{{ $title }}</h1>
    @endslot


    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-header">



                    <div class="card-tools">
                        {{-- <button type="button" wire:click='exportExcel' class="btn btn-tool btn-sm">
                            <i class="fas fa-download"></i>
                        </button> --}}
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
                                    <x-th-sort label="NISN" name="nisn" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                                    <th>Nama Kafil</th>
                                    <th>Nomor Kafil</th>
                                    <th>Nomor Yatim</th>
                                    <th>Nama Ayah</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $nomor = ($students->currentPage() - 1) * $students->perPage() + 1;
                                @endphp

                                @forelse($students as $item)
                                    <tr>
                                        <td>{{ $nomor++ }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->nisn }}</td>
                                        @if ($item->kafil)
                                        <td>
                                            <div>
                                                {{ optional( $item->kafil)->nama_kafil_indo  }}
                                            </div>
                                            <div>
                                                {{ optional( $item->kafil)->nama_kafil_arab  }}
                                            </div>
                                        </td>
                                        <td>{{ optional($item->kafil)->nomor_kafil  }}</td>
                                        <td>{{ optional($item->kafil)->nomor_yatim  }}</td>
                                        @else
                                            <td colspan="3" class="text-danger">Belum Ada Kafil</td>
                                        @endif

                                        <td>{{ optional($item->guardians->where('pivot.type','ayah')->first())->nama }}
                                        </td>
                                        <td>
                                            @if ($item->kafil)
                                            <button type="button" class="btn btn-outline-warning btn-sm"
                                            wire:click='editkafil({{ $item->kafil->id }})' data-toggle="modal"
                                            data-target="#modal-edit" title="edit">
                                            <i class="fas fa-edit"></i>
                                            </button>
                                            @else
                                            <button type="button" class="btn btn-outline-primary btn-sm"
                                                wire:click='getStudentId({{ $item->id }})' data-toggle="modal"
                                                data-target="#modal-registrasi" title="Kafil">
                                                <i class="fas fa-donate"></i>
                                            </button>
                                                
                                            @endif
                                            
                                            <a wire:navigate
                                                href="{{ route('admin.siswa.detail',$item->id) }}"
                                                class="btn btn-sm btn-outline-success" title="Lihat Detail Siswa"><i
                                                    class="fas fa-eye"></i></a>
                                        </td>


                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2">Tidak Ada Data Siswa</td>
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
                            <div>{{ $students->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>

    <div class="modal fade" id="modal-registrasi" wire:ignore.self>
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Kafil Santri</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        wire:click='clear'>
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" wire:submit='addKafil'>
                    @include('.livewire.admin.siswa.part.kafil-cu')
                </form>
            </div>

        </div>
    </div>
    <div class="modal fade" id="modal-edit" wire:ignore.self>
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Kafil Santri</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        wire:click='clear'>
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" wire:submit='kafilUpdate'>
                    @include('.livewire.admin.siswa.part.kafil-cu')
                </form>
            </div>

        </div>
    </div>


</div>
