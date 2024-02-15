<div class="content">
    @slot('title')
        <h1 class="font-weight-bold"><i class="mr-3 fas fa-book "></i>Daftar Mata Pelajaran</h1>
    @endslot
        

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-end">
                    <button wire:click ="showDataOtherStatus" class="mx-3 btn btn-sm btn-primary">Lihat Mapel yang {{ $is_active ? 'Tidak Aktif':'Aktif' }}</button>
                    <span>
                        <x-search-default/>
                    </span>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool btn-sm" data-toggle="modal"
                        data-target="#modal-create"><i class="fas fa-plus"></i></button>
                    </div>
                    
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-head-fixed text-nowrap table-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <x-th-sort label="Nama Mata Pelajaran" name="nama_mapel" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                                    <x-th-sort label="Ringkasan Mapel" name="ringkasan_mapel" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $nomor = ($mapels->currentPage() - 1) * $mapels->perPage() + 1;
                                @endphp

                                @forelse($mapels as $item)
                                    <tr>
                                        <td>{{ $nomor++ }}</td>
                                        <td>{{ $item->nama_mapel }}</td>
                                        <td>{{ $item->ringkasan_mapel }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-edit" wire:click='edit({{$item->id}})'><i class="mr-2 fas fa-edit"></i>Edit</button>
                                            <button class="btn btn-sm btn-{{ $is_active ? 'danger':'success' }} " wire:confirm='Apakah Anda Yakin merubah keaktifan Mata Pelajaran ini?'  wire:click='changeStatus({{$item->id}})'><i class="mr-2 fas fa-trash"></i>{{ $is_active ? 'Nonaktifkan':'Aktifkan' }}</button>
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
                            <div>{{ $mapels->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>

    {{-- Modal Create --}}
    <div class="modal fade" id="modal-create" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data</h4>
                    <button type="button" class="close" wire:click='clear' data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <form action="" wire:submit='store'>
                    @include('livewire.admin.mapel.form')
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" wire:click='clear' data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"><i class="mr-3 far fa-paper-plane"></i>Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div class="modal fade" id="modal-edit" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Data</h4>
                    <button type="button" class="close" wire:click='clear' data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <form action="" wire:submit='update'>
                    @include('livewire.admin.mapel.form')
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" wire:click='clear' data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"><i class="mr-3 far fa-paper-plane"></i>Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
</div>
