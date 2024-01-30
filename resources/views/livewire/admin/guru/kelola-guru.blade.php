<div class="content">
    @slot('title')
        <h1 class="font-weight-bold">Semester</h1>
    @endslot


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">

                        <button type="button" class="btn btn-tool btn-sm ml-2" data-toggle="modal" data-target='#modal-default'>
                            <i class="fas fa-plus"></i>
                        </button>
                        <button type="button" wire:click='export' class="btn btn-tool btn-sm">
                            <i class="fas fa-download"></i>
                        </button>
                    </div>
                    <span>
                        <x-search-default/>
                    </span>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-head-fixed text-nowrap table-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <x-th-sort label="Nama" name="nama_lengkap" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                                    <x-th-sort label="NIK" name="nik" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                                    <x-th-sort label="NUPTK" name="nuptk" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                                    <x-th-sort label="Tempat Lahir" name="tempat_lahir" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                                    <x-th-sort label="Tanggal Lahir" name="tanggal_lahir" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                                    <x-th-sort label="Jenis Kelamin" name="jenis_kelamin" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $nomor = ($data_guru->currentPage() - 1) * $data_guru->perPage() + 1;
                                @endphp

                                @forelse($data_guru as $guru)
                                    <tr>
                                        <td>{{ $nomor++ }}</td>
                                        <td>{{ $guru->nama_lengkap }}, {{ $guru->gelar }}</td>
                                        <td>{{ $guru->nip }}</td>
                                        <td>{{ $guru->nuptk }}</td>
                                        <td>{{ $guru->tempat_lahir }}</td>
                                        <td>{{ $guru->tanggal_lahir }}</td>
                                        <td>
                                            @if($guru->jenis_kelamin == 'L')
                                                Laki-Laki
                                            @else
                                                Perempuan
                                            @endif
                                        </td>
                                        <td>
                                            
                                                <button type="button" class="btn btn-warning btn-sm mt-1"
                                                    data-toggle="modal" data-target="#modal-default" wire:click='edit({{$guru->id}})'>
                                                    <i class="fas fa-pencil-alt"></i>
                                                </button>
                                                <button type="submit" class="btn btn-danger btn-sm mt-1"
                                                    wire:confirm='Hapus Guru'>
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8">Tidak Ada Data</td>
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
                            <div>{{ $data_guru->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        {{-- @include('livewire.admin.akademik.part.add-sekolah') --}}
    </div>

    {{-- Modal Import --}}
    <div class="modal fade" id="modal-import" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Guru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form name="contact-form" wire:submit.prevent='import' method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="callout callout-info">
                            <h5>Download format import</h5>
                            <p>Silahkan download file format import melalui tombol dibawah ini.</p>

                            <button class="btn btn-sm btn-primary" wire:click='downloadFormat'><i
                                    class="fas fa-file-download"></i> Download</button>

                        </div>

                        <div class="form-group row pt-2">
                            <label for="file_import" class="col-sm-2 col-form-label">File Import</label>
                            <div class="col-sm-10">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" wire:model="file_import"
                                        id="customFile" accept="application/vnd.ms-excel">
                                    <label class="custom-file-label" for="customFile">Pilih file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal import -->

    {{-- Modal Tambah --}}
    <div class="modal fade" id="modal-default" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{$guru_id ? 'Edit' :'Tambah'}}Tambah {{ $title }}</h5>
                    <button type="button" wire:click='clear' class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent='{{$guru_id ? 'update' : 'store'}}'>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="nama_lengkap" class="col-sm-3 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror"
                                    id="nama_lengkap" wire:model="nama_lengkap" placeholder="Nama Lengkap">
                                @error('nama_lengkap')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        @if (!$guru_id)
                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                                    wire:model="email" placeholder="Email">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>
                        @endif
                        <div class="form-group row">
                            <label for="gelar" class="col-sm-3 col-form-label">Gelar</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('gelar') is-invalid @enderror" id="gelar"
                                    wire:model="gelar" placeholder="Gelar">
                            </div>
                            @error('gelar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label for="nip" class="col-sm-3 col-form-label">NIK
                                <small><i>(opsional)</i></small></label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control @error('nip') is-invalid @enderror" id="nip"
                                    wire:model="nip" placeholder="NIP">
                                @error('nip')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-9 pt-1">
                                <label class="form-check-label mr-3"><input type="radio" wire:model="jenis_kelamin"
                                        value="L" @if (old('jenis_kelamin')=='L' ) checked @endif required>
                                    Laki-Laki</label>
                                <label class="form-check-label mr-3"><input type="radio" wire:model="jenis_kelamin"
                                        value="P" @if (old('jenis_kelamin')=='P' ) checked @endif required>
                                    Perempuan</label>
                            </div>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                        <div class="form-group row">
                            <label for="tempat_lahir" class="col-sm-3 col-form-label">Tempat Lahir</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" wire:model="tempat_lahir"
                                    placeholder="Tempat Lahir">
                                    @error('tempat_lahir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" wire:model="tanggal_lahir">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nuptk" class="col-sm-3 col-form-label">NUPTK
                                <small><i>(opsional)</i></small></label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control @error('nuptk') is-invalid @enderror" id="nuptk" wire:model="nuptk"
                                    placeholder="NUPTK">
                                    @error('nuptk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nuptk" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" wire:model="alamat"
                                    placeholder="Alamat"></textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="button" wire:click='clear' class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Modal tambah --}}



</div>
