<div class="content">
    @slot('title')
        <h1 class="font-weight-bold">Sekolah {{$sekolah->nama_sekolah}}</h1>
    @endslot


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#modal-default"><i class="fas fa-plus mr-2"></i>Tambah Data</button>
                       
                    </div>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" wire:model.live.debounce.100ms="search" class="form-control float-right"
                                placeholder="Search">

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
                        <table class="table table-head-fixed text-nowrap table-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <x-th-sort label="Nama Rombel" name="nama_rombel" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                                    <x-th-sort label="Tingkat Kelas" name="tingkat_kelas" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                                    <th>Nama Sekolah</th>
                                    <th>Anggota</th>
                                    <th>Aktif</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $nomor = ($models->currentPage() - 1) * $models->perPage() + 1;
                                @endphp

                                @forelse($models as $item)
                                    <tr>
                                        <td>{{ $nomor++ }}</td>
                                        <td>{{ $item->nama_rombel }}</td>
                                        <td>{{ $item->tingkat_kelas }}</td>
                                        <td>{{ $item->sekolah ? $item->sekolah->nama_sekolah:'' }}</td>
                                        <td><a href="{{route('admin.master.rombel.anggota',$item->id)}}" class="btn btn-sm btn-primary"><i class="fas fa-list mr-3"></i>{{ $item->jumlah_anggota}} siswa</a></td>
                                        <td>{{ $item->status ? 'Aktif':'Tidak Aktif' }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-warning" wire:click='edit({{$item->id}})' data-toggle="modal"
                                                data-target="#modal-default"><i class="fas fa-edit mr-2"></i>Edit</button>
                                            <button class="btn btn-sm btn-danger" wire:confirm='Apakah Yakin untuk menghapus,' wire:click='destroy({{$item->id}})'><i class="fas fa-trash mr-2"></i>Hapus</button>
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
                            <div>{{ $models->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        @include('livewire.admin.akademik.part.add-rombel-sekolah')
    </div>


    
</div>
