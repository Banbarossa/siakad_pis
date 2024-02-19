<div class="content">
    @slot('title')
        <h1 class="font-weight-bold">Akun Siswa</h1>
    @endslot


    <div class="row">
        @include('livewire.admin.akun.part.user')
    </div>
    <div class="modal fade" id="modal-lg" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Siswa Ke akun</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h5><i class="mr-3 fas fa-user text-muted"></i>{{ $nama_akun }}</h5>
                            <p>{{ $email_akun }}</p>
                        </div>
                    </div>

                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Daftar siswa</h3>
        
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" wire:model.live.debounce.100ms="studentSearch"
                                        class="float-right form-control" placeholder="Search">
        
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
                                <table class="table">
                                    <thead>
                                        <tr>
                                            Nama
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($students as $item)
                                            <tr>
                                                <td>{{ $item->nama }}</td>
                                                <td><button class="btn btn-sm btn-default"
                                                        wire:click='attachSiswa({{ $item->id }})'><i
                                                            class="fas fa-plus"></i></button></td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="">Tidak Ada Data Siswa</td>
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
                                        <x-pagination-select model="studentPage"></x-pagination-select>
                                    </div>
                                    <div>{{ $students->links() }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


</div>
