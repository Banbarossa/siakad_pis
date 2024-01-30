<div class="content">
    @slot('title')
        <h1 class="font-weight-bold">Pelanggaran Santri</h1>
    @endslot


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">

                        <button type="button" wire:click='export' class="btn btn-tool btn-sm"><i class="fas fa-download ml-2"></i></button>
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
                                    <x-th-sort label="Tanggal" name="tanggal" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                                    <th>Jam</th>
                                    <x-th-sort label="Level pelanggaran" name="level_pelanggaran" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                                    <x-th-sort label="Point" name="point" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                                    <th>Tampilkan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $nomor = ($pelanggaran->currentPage() - 1) * $pelanggaran->perPage() + 1;
                                @endphp

                                @forelse($pelanggaran as $item)
                                    <tr>
                                        <td>{{ $nomor++ }}</td>
                                        <td>{{ $item->student ? $item->student->nama : ''}}</td>
                                        <td>{{ $item->tanggal }}</td>
                                        <td>{{ $item->jam }}</td>
                                        <td>{{ $item->level_pelanggaran }}</td>
                                        <td>{{ $item->point }}</td>
                                        <td>
                                            @if ($item->is_show)
                                            <button wire:click='updateShow({{$item->id}})' class="btn btn outline"><i class="mr-2 fas fa-eye-slash"></i>Sembunyikan dari Orang Tua</button>
                                            @else
                                            <button wire:click='updateShow({{$item->id}})' class="btn btn outline"><i class="mr-2 fas fa-eye"></i>Tampilkan ke Orang Tua</button>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default" wire:click='edit({{$item->id}})'><i class="fas fa-edit mr-2"></i>Edit</button>
                                            <button class="btn btn-danger btn-sm" wire:click='destroy({{$item->id}})'><i class="fas fa-trash mr-2"></i>Hapus</button>
                                        </td>


                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8">Tidak Ada Data Siswa</td>
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
                            <div>{{ $pelanggaran->links() }}</div>
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
                    <h4 class="modal-title">{{$pelanggaran_id ? 'Update Data':'Tambah Data'}}</h4>
                    <button type="button" class="close" wire:click='clear' data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                @if ($pelanggaran_id)
                    <form action="" wire:submit='update'>
                @else
                    <form action="" wire:submit='store'>
                @endif
                    <div class="modal-body">
                        {{-- Student Id --}}
                        <div class="form-group">
                            <label for="student_id" class="text-muted font-weight-normal">Siswa</label>
                            <select wire:model.live='student_id' id="student_id" class="form-control form-control-sm @error('student_id') is-invalid @enderror">
                                <option>Pilih Siswa</option>
                                @foreach ($students as $item)
                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                @endforeach
                                
                            </select>
                            @error('student_id')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="tanggal" class="text-muted font-weight-normal">Tanggal</label>
                                    <input type="date" id="tanggal" wire:model="tanggal" class="form-control form-control-sm @error('tanggal') is-invalid @enderror">
                                    @error('tanggal')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="jam" class="text-muted font-weight-normal">Jam</label>
                                    <input type="time" id="jam" wire:model="jam" class="form-control form-control-sm @error('jam') is-invalid @enderror">
                                    @error('jam')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="level_pelanggaran" class="text-muted font-weight-normal">Kategori</label>
                                    <select wire:model.live='level_pelanggaran' id="level_pelanggaran" class="form-control form-control-sm @error('level_pelanggaran') is-invalid @enderror">
                                        <option>Pilih</option>
                                        <option value="Ringan">Ringan</option>
                                        <option value="Sedang">Sedang</option>
                                        <option value="Berat">Berat</option>
                                    </select>
                                    @error('level_pelanggaran')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="point" class="text-muted font-weight-normal">Point</label>
                                    <input type="number" id="point" wire:model="point" class="form-control form-control-sm @error('point') is-invalid @enderror">
                                    @error('point')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi" class="text-muted font-weight-normal">Deskripsi</label>
                            <textarea  id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" wire:model='deskripsi' rows="3" placeholder="Tuliskan deskripsi Pelanggaran ..."></textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="penanganan" class="text-muted font-weight-normal">Penanganan</label>
                            <textarea  id="penanganan" class="form-control @error('penanganan') is-invalid @enderror" wire:model='penanganan' rows="3" placeholder="Tuliskan penanganan yang sudah dilakukan ..."></textarea>
                            @error('penanganan')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" wire:model='is_show' id="is_show" type="checkbox">
                                <label class="form-check-label" for="is_show">Tampilkan Ke orang Tua/Santri</label>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" wire:click='clear' data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"><i class="far fa-paper-plane mr-3"></i>Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
</div>
