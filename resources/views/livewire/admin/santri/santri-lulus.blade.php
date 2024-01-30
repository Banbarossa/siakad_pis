<div class="content">
    @slot('title')
        <h1 class="font-weight-bold">{{$title}}</h1>
    @endslot


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">

                        <button type="button" class="btn btn-tool btn-sm" data-toggle="modal" data-target='#modal-default'>
                            <i class="fas fa-plus"></i>
                        </button>
                        <button type="button" wire:click='download' class="btn btn-tool btn-sm">
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
                                    <th>Tanggal Lulus</th>
                                    <th>Contact</th>
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
                                        <td>{{ $item->alumni ? \Carbon\Carbon::parse($item->alumni->tanggal_lulus)->format('d-m-Y') :'' }}</td>
                                        <td>{{ $item->alumni ? $item->alumni->contact :''  }}</td>


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

    

    {{-- Modal Luluskan --}}

    <div class="modal fade" id="modal-default" wire:ignore.self>
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah {{ $title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click='clear'>
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if ($form_level == 1)
                    <div class="row">
                        <div class="col-12">
                            <div class="card" style="height: 450px;overflow:scroll">
                                <div class="card-header">
                                    <div class="card-tools">
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <input type="text" wire:model.live.debounce.100ms="searchBelumMasuk"
                                                class="form-control float-right" placeholder="Search">

                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>NISN</th>
                                                    <th>Rombel</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($students_kelas_akhir as $item)
                                                    <tr>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input class="custom-control-input"
                                                                    wire:model.live='selectedStudent'
                                                                    type="checkbox"
                                                                    id="selected-student-{{ $item->id }}"
                                                                    value="{{ $item->id}}">
                                                                <label for="selected-student-{{ $item->id }}"
                                                                    class="custom-control-label">{{ $item->student ? $item->student->nama :'' }}</label>
                                                            </div>
                                                        </td>
                                                        <td>{{ $item->student ? $item->student->nisn :'' }}</td>
                                                        <td>{{ $item->rombel ? $item->rombel->nama_rombel :'' }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4">Tidak ada data santri kelas 12😒</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                        {{-- Jenis Pendaftaran --}}


                    </div>
                    @endif
                    @if ($form_level == 2)
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="tanggal_lulus" class="col-sm-3 col-form-label">Tanggal Lulus</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control @error('tanggal_lulus') is-invalid @enderror"
                                                id="tanggal_lulus" wire:model="tanggal_lulus" placeholder="tanggal Lulus">
                                            @error('tanggal_lulus')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lanjutan_pendidikan" class="col-sm-3 col-form-label">Pendidikan lanjutan</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('lanjutan_pendidikan') is-invalid @enderror"
                                                id="lanjutan_pendidikan" wire:model="lanjutan_pendidikan" placeholder="Pendidikan lanjutan">
                                            @error('lanjutan_pendidikan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="contact" class="col-sm-3 col-form-label">Contact</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('contact') is-invalid @enderror"
                                                id="contact" wire:model="contact" placeholder="Contact yang dapat di hubungi">
                                            @error('contact')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    @endif
                    <!-- /.row -->
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" wire:click='clear' class="btn btn-sm btn-default"
                        data-dismiss="modal">Batal</button>
                    @if(!empty($selectedStudent) && $form_level == 1)
                        <button wire:click='updateLevel'
                            class="btn btn-sm btn-primary">Lanjutkan</button>

                    @endif
                    @if($form_level == 2)
                        <button wire:click='luluskan'
                            wire:confirm='Apakah yakin untuk melulusakan siswa ini??'
                            class="btn btn-sm btn-primary"><i class="fas fa-plus mr-2"></i>Luluskan</button>

                    @endif
                </div>
            </div>
        </div>
    </div>


    
</div>
