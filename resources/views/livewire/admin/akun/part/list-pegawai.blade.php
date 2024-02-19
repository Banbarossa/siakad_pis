<div class="col-12">
    <div class="card">
        <div class="card-header">
          <h3 class="card-title"><i class="mr-3 fas fa-users"></i>Daftar Akun Pegawai</h3>

            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" wire:model.live.debounce.100ms="search" class="float-right form-control" placeholder="Search">

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
                            <x-th-sort label="Nama" name="name" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                            <x-th-sort label="Email" name="email" sortColumn="{{ $sortColumn }}"
                                        sortDirection="{{ $sortDirection }}"></x-th-sort>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        @php
                            $nomor = ($users->currentPage() - 1) * $users->perPage() + 1;
                        @endphp

                        @forelse ($users as $item)
                        <tr>
                            <td>{{ $nomor++ }}</td>
                            <td>
                                <div>{{$item->name}}</div>
                            </td>
                            <td>
                                <div>{{$item->email}}</div>
                            </td>
                            <td>
                                @forelse ($item->roles as $role)
                                    <button class="badge bg-primary" data-toggle="tooltip" data-placement="top" title="Hapus Role" wire:confirm='Apakah Yakin untuk menghapus role dari user ini?' wire:click='revokeRole({{ $item->id }} ,{{ $role->id }})'><i class="mr-2 fas fa-trash"></i>{{ $role->name }}</button>
                                    
                                @empty
                                    <div class="badge bg-warning">Belum Ada role</div>
                                @endforelse
                                    <button class="badge bg-success" data-toggle="modal" data-target="#modal-create" wire:click='getUserId({{ $item->id }})'><i class="fas fa-plus"></i></button>

                            </td>
                            <td>
                                <button type="button"  wire:click='changeActive({{$item->id}})' class="btn btn-sm btn-{{ $item->is_aktif ? 'danger' :'success' }}" data-toggle="modal" data-target="#modal-lg">
                                    <i class="mr-2 fas fa-toggle-{{ $item->is_aktif ? 'off' :'on' }}"></i>{{ $item->is_aktif ? 'Nonaktifkan' :'Aktifkan' }}
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
                    <div>{{$users->links()}}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-create" wire:ignore.self>
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Permission</h5>
                    <button type="button" wire:click='clear' class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" wire:submit.prevent='addRoleToUser'>
                    <div class="modal-body">


                        @forelse ($roles as $item)
                        <div class="form-check">
                            <input class="form-control-input" type="checkbox" value="{{ $item->name }}" wire:model.live='selectedRoles' id="role-{{ $item->id }}">
                            <label class="form-check-label" for="role-{{ $item->id }}">
                                {{ $item->name }}
                            </label>
                        </div>
                        @empty
                            <div class="text-danger">Tidak Ada Role Yang belum di Assign</div>
                        @endforelse
                        
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