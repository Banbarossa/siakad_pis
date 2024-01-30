<div class="content">
    @slot('title')
        <h1 class="font-weight-bold">Beasiswa</h1>
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
                                    <x-th-sort label="Tahun" name="tahun" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                                    <x-th-sort label="Bulan" name="bulan" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                                    <x-th-sort label="Tanggal Terima" name="tanggal_terima" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                                    <x-th-sort label="Sumber" name="sumber" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                                    <x-th-sort label="Jumlah" name="Jumlah" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $nomor = ($beasiswa->currentPage() - 1) * $beasiswa->perPage() + 1;
                                @endphp

                                @forelse($beasiswa as $item)
                                    <tr>
                                        <td>{{ $nomor++ }}</td>
                                        <td>{{ $item->student ? $item->student->nama : ''}}</td>
                                        <td>{{ $item->tahun }}</td>
                                        <td>{{ $item->bulan }}</td>
                                        <td>{{ $item->tanggal_terima }}</td>
                                        <td>{{ $item->sumber }}</td>
                                        <td> {{$item->jumlah ?'Rp ':''}}{{ number_format($item->jumlah,0,',','.') }}</td>
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
                            <div>{{ $beasiswa->links() }}</div>
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
                    <h4 class="modal-title">{{$beasiswa_id ? 'Edit Data' :'Tambah Data'}}</h4>
                    <button type="button" class="close" wire:click='clear' data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                @if ($beasiswa_id)
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
                        <div class="form-group">
                            <label for="tahun" class="text-muted font-weight-normal">Tahun</label>
                            <input type="number" id="tahun" wire:model="tahun" class="tahun form-control form-control-sm @error('tahun') is-invalid @enderror">
                            @error('tahun')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="bulan" class="text-muted font-weight-normal">Bulan</label>
                            <select wire:model.live='bulan' id="bulan" class="form-control form-control-sm @error('bulan') is-invalid @enderror">
                                <option>Pilih Bulan</option>
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                                
                            </select>
                            @error('bulan')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tanggal_terima" class="text-muted font-weight-normal">Tanggal Terima</label>
                            <input type="date" id="tanggal_terima" wire:model="tanggal_terima" class="form-control form-control-sm @error('tanggal_terima') is-invalid @enderror">
                            @error('tanggal_terima')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="sumber" class="text-muted font-weight-normal">Sumber</label>
                            <input type="text" id="sumber" wire:model="sumber" class="form-control form-control-sm @error('sumber') is-invalid @enderror">
                            @error('sumber')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jumlah" class="text-muted font-weight-normal">Jumlah</label>
                            <input type-currency="IDR" id="jumlah"  wire:model.live="jumlah" class="rupiah form-control form-control-sm @error('jumlah') is-invalid @enderror" >
                            @error('jumlah')
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
