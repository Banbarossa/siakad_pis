<div class="content">
    @slot('title')
        <h1 class="font-weight-bold">{{ $title }}</h1>
    @endslot


    <div class="row">

        @if(session()->has('failures'))
        <div class="col-12">
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">Gagal Upload</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Baris</th>
                                    <th>Attribute</th>
                                    <th>Errors</th>
                                    <th>Values</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(session()->get('failures') as $item)
                                    <tr>
                                        <td>{{ $item->row() }}</td>
                                        <td>{{ $item->attribute() }}</td>
                                        <td>
                                            <ul>
                                                @foreach($item->errors() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>{{ $item->values()[$item->attribute()] }}</td>
                                    </tr>

                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif




        <div class="col-12">
            <div class="card">
                <div class="card-header">



                    <div class="card-tools">

                        <a wire:navigate href="{{ route('admin.pegawai.index.create') }}"
                            class="btn btn-tool btn-sm"><i class="ml-2 fas fa-plus"></i></a>
                        <button type="button" class="btn btn-tool btn-sm" data-toggle="modal"
                            data-target="#modal-import">
                            <i class="fas fa-upload"></i>
                        </button>
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
                                            <button type="button" class="btn btn-outline-primary btn-sm"
                                                wire:click='registrasi({{ $item->id }})' data-toggle="modal"
                                                data-target="#modal-registrasi" title="Registrasi Siswa">
                                                <i class="fas fa-user-cog"></i>
                                            </button>
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

    {{-- Modal Upload --}}
    <div class="modal fade" id="modal-import" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Upload Data Santri</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-sm btn-success" wire:click='unduhTemplate'> <i
                                class="mr-2 fas fa-download fa-xs"></i>Unduh Template</button>
                    </div>

                    <form action="" wire:submit='uploadData' enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleInputFile">File Upload</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" wire:model='uploadPegawai'
                                        class="custom-file-input @error('uploadPegawai') is-invalid @enderror"
                                        id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">
                                        {{ $uploadPegawai ? $this->getUploadPegawaiFileName() : 'Choose file' }}</label>
                                </div>
                                <div class="input-group-append">
                                    <button type="submit" class="input-group-text">Upload</button>
                                </div>
                            </div>
                            @error('uploadPegawai')
                                <div class="text-danger">
                                    <small>
                                        {{ $message }}
                                    </small>
                                </div>
                            @enderror
                        </div>

                        <div class="mt-3" wire:loading wire:target="uploadData">
                            <div class="d-flex align-items-center">
                                <strong>Loading...</strong>
                                <div class="ml-auto spinner-border" role="status" aria-hidden="true"></div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Registrasi --}}
    <div class="modal fade" id="modal-registrasi" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registrasi Pegawai Keluar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        wire:click='clear'>
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" wire:submit.prevent='storeRegistration'>


                    
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="tanggal_keluar" class="col-sm-3 col-form-label">Tanggal Keluar</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control @error('tanggal_keluar') is-invalid @enderror"
                                    id="tanggal_keluar" wire:model="tanggal_keluar">
                                @error('tanggal_keluar')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="alasan_keluar" class="col-sm-3 col-form-label">Alasan Keluar</label>
                            <div class="col-sm-9">
                                <textarea class="form-control  @error('alasan_pindah') is-invalid @enderror"
                                    id="alasan_keluar" wire:model="alasan_pindah"
                                    placeholder="Alasan Keluar"></textarea>
                                @error('alasan_pindah')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="button" class="btn btn-default" data-dismiss="modal"
                            wire:click='clear'>Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>
