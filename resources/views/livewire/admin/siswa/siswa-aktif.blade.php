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
                        <a href="{{ route('admin.siswa.tambah') }}"
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
                                    <x-th-sort label="NISN" name="nisn" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                                    <x-th-sort label="NIS-S" name="nis_sekolah" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                                    <x-th-sort label="NIS-P" name="nis_pesantren" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                                    <th>Kelas Saat Ini</th>
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
                                        <td>{{ $item->nis_sekolah }}</td>
                                        <td>{{ $item->nis_pesantren }}</td>

                                        <td>
                                            @if($item->rombel_id == null)
                                                <span class="badge light badge-warning">Belum masuk rombel</span>
                                            @else
                                                {{ $item->rombel->nama_rombel }}
                                            @endif
                                        </td>
                                        <td>{{ optional($item->guardians->where('pivot.type','ayah')->first())->nama }}
                                        </td>
                                        {{-- <td>{{ $item->ayah_nama }}</td> --}}
                                        <td>
                                            @if($item->rombel_id != null)
                                            <button type="button" class="btn btn-outline-primary btn-sm"
                                                wire:click='showRegistration({{ $item->id }})' data-toggle="modal"
                                                data-target="#modal-registrasi" title="Registrasi Siswa">
                                                <i class="fas fa-user-cog"></i>
                                            </button>
                                            
                                            @else
                                                <button type="button" class="btn btn-tool btn-sm" data-toggle="modal"
                                                    data-target="#modal-registrasi" title="Registrasi Siswa" disabled>
                                                    <i class="fas fa-user-cog"></i>
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

    <div class="modal fade" id="modal-default" wire:ignore.self>
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
                                    <input type="file" wire:model='uploadSiswa'
                                        class="custom-file-input @error('uploadSiswa') is-invalid @enderror"
                                        id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <button type="submit" class="input-group-text">Upload</button>
                                </div>
                            </div>
                            @error('uploadSiswa')
                                <div class="text-danger">
                                    <small>
                                        {{ $message }}
                                    </small>
                                </div>
                            @enderror
                        </div>

                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal registrasi --}}
    <div class="modal fade" id="modal-registrasi" wire:ignore.self>
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registrasi Siswa Keluar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        wire:click='clearRegistration'>
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" wire:submit.prevent='storeRegistration'>
                    <div class="modal-body">
                        <div class="callout callout-info">
                            <h5>Diisi saat siswa keluar dari sekolah</h5>
                            <p>Siswa yang dapat diluluskan hanyalah siswa yang berada pada kelas tingkat akhir pada
                                semester genap.</p>
                        </div>
                        <div class="form-group row">
                            <label for="nama_lengkap" class="col-sm-3 col-form-label">Nama Siswa</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama_lengkap"
                                    wire:model="registration_student_name" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="keluar_karena" class="col-sm-3 col-form-label">Keluar Karena</label>
                            <div class="pt-1 col-sm-9">
                                <select class="form-control select2 @error('sebab_keluar') is-invalid @enderror"
                                    wire:model="sebab_keluar" style="width: 100%;" required>
                                    <option value="">-- Pilih Jenis Keluar --</option>
                                    <option value="Mutasi">Mutasi</option>
                                    <option value="Dikeluarkan">Dikeluarkan</option>
                                    <option value="Mengundurkan Diri">Mengundurkan Diri</option>
                                    <option value="Putus Sekolah">Putus Sekolah</option>
                                    <option value="Wafat">Wafat</option>
                                    <option value="Hilang">Hilang</option>
                                </select>
                                @error('sebab_keluar')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal_keluar" class="col-sm-3 col-form-label">Tanggal Keluar Sekolah</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control @error('tanggal_mutasi') is-invalid @enderror"
                                    id="tanggal_mutasi" wire:model="tanggal_mutasi">
                                @error('tanggal_mutasi')
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
                        <div class="form-group row">
                            <label for="sekolah_lanjutan" class="col-sm-3 col-form-label">Sekolah Lanjutan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control  @error('sekolah_lanjutan') is-invalid @enderror"
                                    id="sekolah_lanjutan" wire:model="sekolah_lanjutan">
                                @error('sekolah_lanjutan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="npsn" class="col-sm-3 col-form-label">NPSN Sekolah Lanjutan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('sekolah_lanjutan') is-invalid @enderror"
                                    id="npsn" wire:model="npsn">
                                @error('npsn')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="button" class="btn btn-default" data-dismiss="modal"
                            wire:click='clearRegistration'>Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
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
                                    <input type="file" wire:model='uploadSiswa'
                                        class="custom-file-input @error('uploadSiswa') is-invalid @enderror"
                                        id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">
                                        {{ $uploadSiswa ? $this->getUploadSiswaFileName() : 'Choose file' }}</label>
                                </div>
                                <div class="input-group-append">
                                    <button type="submit" class="input-group-text">Upload</button>
                                </div>
                            </div>
                            @error('uploadSiswa')
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


</div>
