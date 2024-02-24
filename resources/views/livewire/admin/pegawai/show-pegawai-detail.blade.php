<div class="content">
    @slot('title')
        <h1 class="font-weight-bold">Informasi Detail {{ $pegawai->nama }}</h1>
    @endslot


    <div class="row">
        <div class="col-12">
            <div class="p-3 card card-primary card-outline card-tabs">
                <div class="p-0 pt-1 card-header border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link {{ $level==1 ? 'active':'' }}" wire:click='changeLevel({{1}})'
                                id="profil-santri-tab" data-toggle="pill" href="#profil-santri" role="tab"
                                aria-controls="profil-santri" aria-selected="false">Profil Siswa</a>
                        </li>
                        @if ($pegawai->status_nikah != 1)
                        <li class="nav-item">
                            <a class="nav-link {{ $level==2 ? 'active':'' }}" wire:click='changeLevel({{2}})'
                                id="profil-ayah-tab" data-toggle="pill" href="#profil-ayah" role="tab"
                                aria-controls="profil-ayah" aria-selected="false">Suami/Istri</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link {{ $level==3 ? 'active':'' }}" wire:click='changeLevel({{3}})'
                                id="anak-tab" data-toggle="pill" href="#anak" role="tab" aria-controls="anak"
                                aria-selected="false">Anak</a>
                        </li>
                        @endif
                        
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-three-tabContent">
                        <div class="tab-pane fade {{ $level==1 ? 'active show' :'' }}"
                            id="profil-santri" role="tabpanel" aria-labelledby="profil-santri-tab">
                            <div class="row">
                                <div class="col 12">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h4 class="mb-3 card-title"><i class="mr-2 fas fa-user"></i><strong>Profile Pegawai</strong>
                                        </h4>
                                        <a href="{{ route('admin.pegawai.index.update',$pegawai->id) }}" wire:navigate class="btn btn-sm btn-tool"><i class="fas fa-edit"></i></a>
                                        {{-- <button class="btn btn-sm btn-tool" data-toggle="modal" data-target="#modal-update-pegawai"><i class="fas fa-edit"></i></button> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-lg-6">
                                    <div class="table-responsive">
                                        @include('livewire.admin.pegawai.detail.profile')
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-6">
                                    <div class="table-responsive">
                                        @include('livewire.admin.pegawai.detail.alamat')
                                    </div>
                                </div>
                            </div>

                        </div>
                        @if ($pegawai->status_nikah != 1)
                        <div class="tab-pane fade {{ $level==2 ? 'active show' :'' }}"
                            id="profil-ayah" role="tabpanel" aria-labelledby="profil-ayah-tab">
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h4 class="mb-3 card-title"><i class="fas fa-{{$pegawai->jenis_kelamin == 'laki laki' ? 'female':'male'}} mr-2"></i><strong>{{$pegawai->jenis_kelamin == 'laki laki' ? 'Istri':'Suami'}}</strong>
                                        </h4>
                                        @if ($pegawai->istripegawai)
                                        <button class="btn btn-sm btn-tool" wire:click='editIstri({{$pegawai->istripegawai->id}})' data-toggle="modal" data-target="#modal-update-istri"><i class="fas fa-edit"></i></button>
                                        @else
                                        <button class="btn btn-sm btn-tool" data-toggle="modal" data-target="#modal-create-istri"><i class="fas fa-plus"></i></button>
                                            
                                        @endif
                                    </div>
                                    @if ($pegawai->istripegawai)
                                    @include('livewire.admin.pegawai.detail.pasangan')
                                    @else
                                    <div>
                                        Tidak Ada Data Yang ditemukan
                                    </div>
                                    @endif
                                    
                                </div>
                            </div>
                        </div>
                        
                        <div class="tab-pane fade {{ $level==3 ? 'active show' :'' }}"
                            id="anak" role="tabpanel" aria-labelledby="anak-tab">
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h4 class="mb-3 card-title"><i class="mr-2 fas fa-child"></i><strong>Anak</strong></h4>
                                        <button class="btn btn-sm btn-tool" data-toggle="modal" data-target="#modal-create-anak"><i class="fas fa-plus"></i></button>
                                    </div>
                                    @include('livewire.admin.pegawai.detail.anak')
                                </div>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>


    
    {{-- Modal Tambah Istri--}}
    <div class="modal fade" id="modal-create-istri" wire:ignore.self>
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data</h5>
                    <button type="button" wire:click='clearIstri' class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" wire:submit.prevent='storeIstri'>
                    <div class="modal-body">
                        @include('livewire.admin.pegawai.detail.form-cu')
                        
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="button" wire:click='clearIstri' class="btn btn-edit" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Modal Update Istri --}}
    <div class="modal fade" id="modal-update-istri" wire:ignore.self>
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Data {{ $status_pasangan ? $status_pasangan :'' }}</h5>
                    <button type="button" wire:click='clearIstri' class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" wire:submit.prevent='updateIstri'>
                    <div class="modal-body">
                        @include('livewire.admin.pegawai.detail.form-cu')
                        
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="button" wire:click='clearIstri' class="btn btn-edit" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Create Anak Pegawai --}}
    <div class="modal fade" id="modal-create-anak" wire:ignore.self>
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data</h5>
                    <button type="button" wire:click='clearAnak' class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" wire:submit.prevent='storeAnak'>
                    <div class="modal-body">
                        @include('livewire.admin.pegawai.detail.form-cu-anak')
                        
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="button" wire:click='clearAnak' class="btn btn-edit" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Modal Create Anak Pegawai --}}
    <div class="modal fade" id="modal-edit-anak" wire:ignore.self>
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Anak</h5>
                    <button type="button" wire:click='clearAnak' class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" wire:submit.prevent='updateAnak'>
                    <div class="modal-body">
                        @include('livewire.admin.pegawai.detail.form-cu-anak')
                        
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="button" wire:click='clearAnak' class="btn btn-edit" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

