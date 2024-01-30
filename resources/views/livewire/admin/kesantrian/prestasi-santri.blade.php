<div class="content">
    @slot('title')
        <h1 class="font-weight-bold">Prestasi Santri</h1>
    @endslot


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">

                    <div class="card-tools">

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
                                    <th>Nama</th>
                                    <x-th-sort label="Tanggal" name="tanggal" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                                    <x-th-sort label="Tingkat" name="tingkat" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                                    <x-th-sort label="Peringkat" name="peringkat" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                                    <x-th-sort label="Deskripsi" name="deskripsi" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $nomor = ($prestasi->currentPage() - 1) * $prestasi->perPage() + 1;
                                @endphp

                                @forelse($prestasi as $item)
                                    <tr>
                                        <td>{{ $nomor++ }}</td>
                                        <td>{{ $item->student ? $item->student->nama : ''}}</td>
                                        <td>{{ $item->tanggal }}</td>
                                        <td>{{ $item->tingkat }}</td>
                                        <td>{{ $item->peringkat }}</td>
                                        <td>{{ $item->deskripsi }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-default" wire:click='edit({{$item->id}})'><i class="fas fa-edit mr-2"></i>Edit</button>
                                            <button class="btn btn-sm btn-danger" wire:confirm='Apakah Anda Yakin Untuk Menghapus?'  wire:click='destroy({{$item->id}})'><i class="fas fa-trash mr-2"></i>Hapus</button>
                                        </td>


                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">Tidak Ada Data Siswa</td>
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
                            <div>{{ $prestasi->links() }}</div>
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
                    <h4 class="modal-title">{{$prestasi_id ? 'Edit Data' :'Tambah Data'}}</h4>
                    <button type="button" class="close" wire:click='clear' data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                @if ($prestasi_id)
                <form action="" wire:submit='update'>
                    
                @else
                <form action="" wire:submit='store'>
                @endif
                    <div class="modal-body">
                        {{-- Student Id --}}
                        <div class="form-group">
                            <label for="student_id" class="text-muted font-weight-normal">Siswa</label>
                            <select wire:model.live='student_id' id="student_id" class="form-control form-control-sm @error('student_id') is-invalid @enderror" disabled>
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
                        {{-- $student_id, $tanggal, $tingkat, $peringkat, $deskripsi; --}}
                        <div class="form-group">
                            <label for="tanggal" class="text-muted font-weight-normal">Tanggal</label>
                            <input type="date" id="tanggal" wire:model="tanggal" class="form-control form-control-sm @error('tanggal') is-invalid @enderror">
                            @error('tanggal')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tingkat" class="text-muted font-weight-normal">Tingkat</label>
                            <input type="text" id="tingkat" wire:model="tingkat" class="form-control form-control-sm @error('tingkat') is-invalid @enderror">
                            @error('tingkat')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="peringkat" class="text-muted font-weight-normal">Peringkat</label>
                            <input type="text" id="peringkat" wire:model="peringkat" class="form-control form-control-sm @error('peringkat') is-invalid @enderror">
                            @error('peringkat')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        
                        {{-- Deskripsi --}}
                        <div class="form-group">
                            <label for="deskripsi" class="text-muted font-weight-normal">Deskripsi</label>
                            <textarea  id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" wire:model='deskripsi' rows="3" placeholder="Deskripsi Prestasi ..."></textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
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
