<div class="content">
    @slot('title')
        <h1 class="font-weight-bold">{{$title}}</h1>
    @endslot


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <button type="button" wire:click='downloadExcel' class="ml-2 btn btn-tool btn-sm">
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
                                    <x-th-sort label="Nama" name="nama" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                                    <x-th-sort label="Nisn" name="nisn" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                                    <x-th-sort label="NIS-S" name="nis_sekolah" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                                    <x-th-sort label="NIS-P" name="nis_pesantren" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                                    <x-th-sort label="Tanggal keluar" name="mutasi_keluars.tanggal_mutasi" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
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
                                        <td>{{ $item->tanggal_mutasi }}</td>
                                        <td>
                                            <button type="button" class="btn btn-outline-primary btn-sm" wire:click='showDetail({{$item->id}})' data-toggle="modal"
                                                data-target="#modal-detail" title="Registrasi Siswa">
                                                <i class="fas fa-eye"></i>
                                            </button>
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


    <div class="modal fade" id="modal-detail" wire:ignore.self>
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registrasi Siswa Keluar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        wire:click='clear'>
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="registration_student_name" class="text-muted font-weight-normal">Nama Siswa</label>
                        <input type="text" id="registration_student_name" wire:model="registration_student_name" class="form-control form-control-sm @error('registration_student_name') is-invalid @enderror" readonly>
                    </div>
                    <div class="form-group">
                        <label for="sebab_keluar" class="text-muted font-weight-normal">Keluar Karena</label>
                        <input type="text" id="sebab_keluar" wire:model="sebab_keluar" class="form-control form-control-sm @error('sebab_keluar') is-invalid @enderror" readonly>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_mutasi" class="text-muted font-weight-normal">Tanggal keluar</label>
                        <input type="date" id="tanggal_mutasi" wire:model="tanggal_mutasi" class="form-control form-control-sm @error('tanggal_mutasi') is-invalid @enderror" readonly>
                    </div>
                    <div class="form-group">
                        <label for="alasan_pindah" class="text-muted font-weight-normal">Alasan Pindah</label>
                        <input type="text" id="alasan_pindah" wire:model="alasan_pindah" class="form-control form-control-sm @error('alasan_pindah') is-invalid @enderror" readonly>
                    </div>
                    <div class="form-group">
                        <label for="sekolah_lanjutan" class="text-muted font-weight-normal">Sekolah Lanjutan</label>
                        <input type="text" id="sekolah_lanjutan" wire:model="sekolah_lanjutan" class="form-control form-control-sm @error('sekolah_lanjutan') is-invalid @enderror" readonly>
                    </div>
                    <div class="form-group">
                        <label for="npsn" class="text-muted font-weight-normal">NPSN Sekolah Lanjutan</label>
                        <input type="text" id="npsn" wire:model="npsn" class="form-control form-control-sm @error('npsn') is-invalid @enderror" readonly>
                    </div>

                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-default" data-dismiss="modal"
                        wire:click='clear'>Close</button>
                </div>
                
            </div>
        </div>
    </div>


    
</div>
