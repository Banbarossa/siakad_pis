<div class="col-12">
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Daftar User</h3>

            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" wire:model.live.debounce.100ms="search" class="form-control float-right" placeholder="Search">

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
                    </thead>
                    <tbody>

                        @php
                            $nomor = ($users->currentPage() - 1) * $users->perPage() + 1;
                        @endphp

                        @forelse ($users as $item)
                        <tr>
                            <td>{{ $nomor++ }}</td>
                            <td>
                                <i class="fas fa-user mr-2 text-muted"></i>{{$item->name}}
                                <div>{{$item->email}}</div>
                            </td>
                            <td>
                                @forelse ($item->students as $student)
                                <div>
                                    <a href="javascript:void(0)" wire:click="detachStudent({{$item->id}},{{$student->id}})"><i class="fas fa-trash mr-2 text-danger"></i></a>
                                    <span>{{$student->nama}}</span>
                                </div>

                                @empty
                                    <p>Tidak Ada Siswa diakun ini</p>
                                @endforelse
                            </td>
                            <td>
                                <button type="button"  wire:click='getUser({{$item->id}})' class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-lg">
                                    <i class="fas fa-plus mr-2"></i> Tambah Siswa
                                </button>
                                <button type="button"  wire:click='getUser({{$item->id}})' class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-lg">
                                    <i class="fas fa-power-off mr-2"></i>NonAktif
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
</div>