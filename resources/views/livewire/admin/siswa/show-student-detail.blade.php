<div class="content">
    @slot('title')
        <h1 class="font-weight-bold">Informasi Detail {{ $student->nama }}</h1>
    @endslot


    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline card-tabs p-3">
                <div class="card-header p-0 pt-1 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link {{ $level==1 ? 'active':'' }}"
                                id="profil-santri-tab" data-toggle="pill" href="#profil-santri" role="tab"
                                aria-controls="profil-santri" aria-selected="false">Profil Siswa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $level==2 ? 'active':'' }}"
                                id="profil-ayah-tab" data-toggle="pill" href="#profil-ayah" role="tab"
                                aria-controls="profil-ayah" aria-selected="false">Data Orang Tua</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $level==3 ? 'active':'' }}"
                                id="wali-tab" data-toggle="pill" href="#wali" role="tab" aria-controls="wali"
                                aria-selected="false">Wali</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $level==4 ? 'active':'' }}"
                                id="akun-tab" data-toggle="pill" href="#akun" role="tab" aria-controls="akun"
                                aria-selected="false">Akun</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-three-tabContent">
                        <div class="tab-pane fade {{ $level==1 ? 'active show' :'' }}"
                            id="profil-santri" role="tabpanel" aria-labelledby="profil-santri-tab">
                            <div class="row">
                                <div class="col 12">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h4 class="card-title mb-3"><i class="fas fa-user mr-2"></i><strong>Profile Siswa</strong>
                                        </h4>
                                        <a wire:navigate href="{{route('admin.siswa.edit',$student->id)}}" class="btn btn-sm btn-tool"><i class="fas fa-edit"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-lg-6">
                                    <div class="table-responsive">
                                        @include('livewire.admin.siswa.part-detail.profile-1')
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-6">
                                    <div class="table-responsive">
                                        @include('livewire.admin.siswa.part-detail.profile-2')
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade {{ $level==2 ? 'active show' :'' }}"
                            id="profil-ayah" role="tabpanel" aria-labelledby="profil-ayah-tab">
                            <div class="row">
                                <div class="col-sm-12 col-lg-6">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h4 class="card-title mb-3"><i class="fas fa-male mr-2"></i><strong>Ayah</strong>
                                        </h4>
                                        @if ($ayah)
                                        <button class="btn btn-sm btn-tool" wire:click='getGuardian({{$ayah->id}})' data-toggle="modal" data-target="#modal-edit"><i class="fas fa-edit"></i></button>
                                        @else
                                        <button class="btn btn-sm btn-tool" wire:click='updateType("ayah")' data-toggle="modal" data-target="#modal-create"><i class="fas fa-plus"></i></button>
                                            
                                        @endif
                                    </div>
                                    @include('livewire.admin.siswa.part-detail.ayah')
                                </div>
                                <div class="col-sm-12 col-lg-6">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h4 class="card-title mb-3"><i class="fas fa-female mr-2"></i><strong>Ibu</strong>
                                        </h4>
                                        @if ($ibu)
                                        <button class="btn btn-sm btn-tool" wire:click='getGuardian({{$ibu->id}})' data-toggle="modal" data-target="#modal-edit"><i class="fas fa-edit"></i></button>
                                        @else
                                        <button class="btn btn-sm btn-tool" wire:click='updateType("ibu")' data-toggle="modal" data-target="#modal-create"><i class="fas fa-plus"></i></button>
                                            
                                        @endif
                                    </div>
                                    
                                    @include('livewire.admin.siswa.part-detail.ibu')
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade {{ $level==3 ? 'active show' :'' }}"
                            id="wali" role="tabpanel" aria-labelledby="wali-tab">
                            <div class="row">
                                <div class="col-sm-12 col-lg-6">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h4 class="card-title mb-3"><i class="fas fa-user-shield mr-2"></i><strong>Wali</strong>
                                        </h4>
                                        @if ($wali)
                                        <button class="btn btn-sm btn-tool" wire:click='getGuardian({{$wali->id}})' data-toggle="modal" data-target="#modal-edit"><i class="fas fa-edit"></i></button>
                                        @else
                                        <button class="btn btn-sm btn-tool" wire:click='updateType("wali")' data-toggle="modal" data-target="#modal-create"><i class="fas fa-plus"></i></button>
                                        @endif
                                    </div>
                                    @include('livewire.admin.siswa.part-detail.wali')
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade {{ $level==4 ? 'active show' :'' }}"
                            id="akun" role="tabpanel" aria-labelledby="akun-tab">
                            @include('livewire.admin.siswa.part-detail.akun')
                        </div>

                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>


    {{-- Modal Tambah Guardian --}}
    <div class="modal fade" id="modal-create" wire:ignore.self>
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data</h5>
                    <button type="button" wire:click='clearGuardian' class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" wire:submit.prevent='storeGuardian'>
                    <div class="modal-body">
                        @include('livewire.admin.siswa.part-detail.form-cu')
                        
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="button" wire:click='clearGuardian' class="btn btn-edit" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Modal Edit Guardian --}}
    <div class="modal fade" id="modal-edit" wire:ignore.self>
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data</h5>
                    <button type="button" wire:click='clearGuardian' class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" wire:submit.prevent='updateData'>
                    <div class="modal-body">
                        @include('livewire.admin.siswa.part-detail.form-cu')
                        
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="button" wire:click='clearGuardian' class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
