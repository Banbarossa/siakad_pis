<div class="content">
    @slot('title')
        <h1 class="font-weight-bold">Rombongan belajar</h1>
    @endslot


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">

                        <button type="button" class="ml-2 btn btn-tool btn-sm" data-toggle="modal" data-target='#modal-default'>
                            <i class="fas fa-plus"></i>
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
                                    <x-th-sort label="Nama Rombel" name="nama_rombel" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                                    <x-th-sort label="Tingkat Kelas" name="tingkat_kelas" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                                    <th>Nama Sekolah</th>
                                    <th>Wali Kelas</th>
                                    <th>Anggota</th>
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
                                        <td>{{ $item->pegawai? $item->pegawai->nama:'' }}</td>
                                        <td><a href="{{route('admin.master.rombel.anggota',$item->id)}}" class="btn btn-sm btn-primary"><i class="mr-3 fas fa-list"></i>{{ $item->jumlah_anggota}} siswa</a></td>
                                        <td>
                                            <button class="btn btn-sm btn-warning" wire:click='edit({{$item->id}})' data-toggle="modal"
                                                data-target="#modal-default"><i class="mr-2 fas fa-edit"></i>Edit</button>
                                            <button class="btn btn-sm btn-danger" wire:confirm='Apakah Yakin untuk menghapus,' wire:click='destroy({{$item->id}})'><i class="mr-2 fas fa-trash"></i>Hapus</button>
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




        @include('livewire.admin.akademik.part.add-rombel')
    </div>


    
</div>
