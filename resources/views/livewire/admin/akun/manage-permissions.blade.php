<div class="content">
    @slot('title')
        <h1 class="font-weight-bold">Permission</h1>
    @endslot


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">

                        <button type="button" class="btn btn-tool btn-sm" data-toggle="modal"
                            data-target="#modal-create">
                            <i class="fas fa-plus"></i>
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
                                    <x-th-sort label="Nama" name="name" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
        
                                @php
                                    $nomor = ($permissions->currentPage() - 1) * $permissions->perPage() + 1;
                                @endphp
        
                                @forelse ($permissions as $item)
                                <tr>
                                    <td>{{ $nomor++ }}</td>
                                    <td>
                                        <div>{{$item->name}}</div>
                                    </td>
                                    <td>
                                        <button type="button"  wire:click='edit({{$item->id}})' class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-edit">
                                            <i class="mx-1 fas fa-edit"></i>
                                        </button>
                                    </td>
        
                                    
                                  </tr>
                                @empty
                                <tr>
                                    <td colspan="2">Tidak Ada Data User</td>
                                </tr>
                                @endforelse
        
                            
                            </tbody>
                        </table>
                    </div>
        
                </div>
                <div class="card-footer">
                    <div class="card-tools">
                        <div class="d-flex">
                            <div class="mr-4"><x-pagination-select></x-pagination-select></div>
                            <div>{{$permissions->links()}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    {{-- Modal create --}}
    <div class="modal fade" id="modal-create" wire:ignore.self>
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Permission</h5>
                    <button type="button" wire:click='clear' class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" wire:submit.prevent='store'>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="permission_name" class="text-muted font-weight-normal">Permission</label>
                            <input type="text" id="permission_name" wire:model="permission_name" class="form-control form-control-sm @error('permission_name') is-invalid @enderror">
                            @error('permission_name')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="button" wire:click='clear' class="btn btn-edit" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-edit" wire:ignore.self>
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Data</h5>
                    <button type="button" wire:click='clear' class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" wire:submit.prevent='perbaharuiData'>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="permission_name" class="text-muted font-weight-normal">Permission</label>
                            <input type="text" id="permission_name" wire:model="permission_name" class="form-control form-control-sm @error('permission_name') is-invalid @enderror">
                            @error('permission_name')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="button" wire:click='clear' class="btn btn-edit" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>