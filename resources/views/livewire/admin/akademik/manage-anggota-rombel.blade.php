<div class="content">
    @slot('title')
        <h1 class="font-weight-bold">Anggota Rombel</h1>
    @endslot


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">

                    <h3 class="card-title"><i class="fas fa-user mr-2"></i>Anggota Rombel {{$rombel_aktif->nama_rombel}} semester {{$semester_login->semester}}</h3>


                    <div class="card-tools">

                        <button type="button" class="btn btn-tool btn-sm" data-toggle="modal"
                            data-target="#modal-default">
                            <i class="fas fa-plus"></i>
                        </button>
                        <button type="button" class="btn btn-tool btn-sm" wire:click='download'>
                            <i class="fas fa-download"></i>
                        </button>
           
                    </div>
                </div>
                <div class="card-body">
                    <x-search-default/>
                    <div class="table-responsive">
                        <table class="table table-head-fixed text-nowrap table-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NISN</th>
                                    <th>NIS-P</th>
                                    <th>Pendaftaran</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $nomor = ($anggotaRombels->currentPage() - 1) * $anggotaRombels->perPage() + 1;
                                @endphp

                                @forelse($anggotaRombels as $item)
                                    <tr>
                                        <td>{{ $nomor++ }}</td>
                                        <td>{{ $item->student ? $item->student->nama :'' }}
                                        </td>
                                        <td>{{ $item->student ? $item->student->nisn :'' }}
                                        </td>
                                        <td>{{ $item->student ? $item->student->nis_pesantren :'' }}
                                        </td>
                                        <td>
                                            @if($item->pendaftaran == 1)
                                            Siswa Baru
                                        @elseif($item->pendaftaran == 2)
                                            Pindahan
                                        @elseif($item->pendaftaran == 3)
                                            Naik Kelas
                                        @elseif($item->pendaftaran == 4)
                                            Lanjutan Semester
                                        @elseif($item->pendaftaran == 5)
                                            Mengulang
                                        @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-danger"
                                                wire:click='destroy({{ $item->id }})' wire:confirm='Pakah yakin untuk mengeluarkan anggota rombel'><i class="fas fa-trash"></i>
                                            </button>
                                        </td>


                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">Tidak Ada Data</td>
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
                            <div>{{ $anggotaRombels->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>







        {{-- Tambah Siswa --}}



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
                        <div class="row">
                            <div class="col-6">
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
                                                        <th>Kelas Sebelumnya</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($siswa_belum_masuk_kelas as $item)
                                                        <tr>
                                                            <td>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input class="custom-control-input"
                                                                        wire:model.live='selectedStudent'
                                                                        type="checkbox"
                                                                        id="selected-stundent-{{ $item->id }}"
                                                                        value="{{ $item->id }}">
                                                                    <label for="selected-stundent-{{ $item->id }}"
                                                                        class="custom-control-label">{{ $item->nama }}</label>
                                                                </div>
                                                            </td>
                                                            <td>{{ $item->nisn }}</td>
                                                            <td>{{ $item->kelas_sebelumhya }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="4">Tidak ada data santri aktif😒</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Siswa Yang Terpilih --}}
                            <div class="col-6">
                                <div class="card" style="height: 450px;overflow:scroll">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Nama</th>
                                                        <th>NISN</th>
                                                        <th>Kelas Sebelumnya</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($siswa_terpilih as $item)
                                                        <tr>
                                                            <td>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input class="custom-control-input"
                                                                        wire:model.live='selectedStudent'
                                                                        type="checkbox"
                                                                        id="selected-stundent-{{ $item->id }}"
                                                                        value="{{ $item->id }}">
                                                                    <label for="selected-stundent-{{ $item->id }}"
                                                                        class="custom-control-label">{{ $item->nama }}</label>
                                                                </div>
                                                            </td>
                                                            <td>{{ $item->nisn }}</td>
                                                            <td>{{ $item->kelas_sebelumhya }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="4">Tidak Ada Santri Yang dipilih😒</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>

                                            </table>
                                        </div>


                                    </div>
                                </div>
                                <div class="form-group row pt-3 pb-0 justify-content-end">
                                    <label for="pendaftaran" class="col-sm-4 col-form-label">Jenis Pendaftaran</label>
                                    <div class="col-sm-6">
                                        <select class="form-control @error('jenis_pendaftaran') is-invalid @enderror" wire:model="jenis_pendaftaran" required>
                                            <option value="">-- Pilih Jenis Pendaftaran --</option>
                                            <option value="2">Pindahan</option>
                                            <option value="1">Siswa Baru</option>
                                            <option value="3">Naik Kelas</option>
                                            <option value="5">Mengulang</option>
                                            <option value="4">Lanjutan Semester</option>
                                        </select>

                                       
                                        @error('jenis_pendaftaran')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Jenis Pendaftaran --}}


                        </div>
                        <!-- /.row -->
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="button" wire:click='clear' class="btn btn-default"
                            data-dismiss="modal">Batal</button>
                        @if(!empty($selectedStudent))
                            <button wire:click='assignAllToRombel'
                                wire:confirm='Apakah yakin untuk mendaftarkan siswa ke kelas {{ $rombel_aktif->nama_rombel }}??'
                                class="btn btn-sm btn-primary"><i class="fas fa-plus mr-2"></i>Simpan</button>

                        @endif
                    </div>
                </div>
            </div>
        </div>



    </div>



</div>
