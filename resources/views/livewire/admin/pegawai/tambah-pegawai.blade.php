<div class="content">
    @slot('title')
        <h1 class="font-weight-bold">{{ $title }}</h1>
    @endslot


    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline card-tabs p-3">
                <div class="card-header p-0 pt-1 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link {{$level==1 ? 'active':''}}" id="profil-pegawai-tab" data-toggle="pill" href="#profil-pegawai"
                                role="tab" aria-controls="profil-pegawai" aria-selected="false">Profil Pegawai</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link {{$level==2 ? 'active':''}}" wire:click='FirstLevelValidation()' id="profil-ayah-tab" data-toggle="pill" href="#profil-ayah" role="tab"
                                aria-controls="profil-ayah" aria-selected="false">Ayah</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{$level==3 ? 'active':''}}" wire:click='validasiAyah()' id="profil-ibu-tab" data-toggle="pill" href="#profil-ibu" role="tab"
                                aria-controls="profil-ibu" aria-selected="false">Ibu</a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link {{$level==2 ? 'active':''}}" wire:click='validasiProfile()' id="alamat-tab" data-toggle="pill" href="#alamat" role="tab"
                                aria-controls="alamat" aria-selected="false">Alamat Asal</a>
                        </li>
                        @if (Request::routeIs('admin.pegawai.index.create'))
                        <li class="nav-item">
                            <a class="nav-link {{$level==3 ? 'active':''}}" wire:click='validasiAlamat()' id="akun-tab" data-toggle="pill" href="#akun" role="tab"
                                aria-controls="akun" aria-selected="false">Akun</a>
                        </li>
                        @endif
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-three-tabContent">
                        <div class="tab-pane fade {{$level==1 ? 'active show' :''}}" id="profil-pegawai" role="tabpanel"
                            aria-labelledby="profil-pegawai-tab">
                            @include('livewire.admin.pegawai.part.profile')
                            <div class="d-flex justify-content-end">
                                <button wire:click='validasiProfile()' class="btn btn-primary px-5">Lanjutkan</button>
                            </div>
                        </div>
                        <div class="tab-pane fade {{$level==2 ? 'active show' :''}}" id="alamat" role="tabpanel" aria-labelledby="alamat-tab">
                            @include('livewire.admin.pegawai.part.alamat')
                            <div class="d-flex justify-content-end">
                                @if (Request::routeIs('admin.pegawai.index.create'))
                                    <button wire:click='validasiAlamat()' class="btn btn-primary px-5">Lanjutkan</button>
                                @else
                                    <button wire:click='storeData' class="btn btn-primary px-5">Kirim Data</button>
                                
                                @endif
                            </div>
                        </div>
                        @if (Request::routeIs('admin.pegawai.index.create'))
                        <div class="tab-pane fade {{$level==3 ? 'active show' :''}}" id="akun" role="tabpanel" aria-labelledby="akun-tab">
                            @include('livewire.admin.pegawai.part.akun')
                            <div class="d-flex justify-content-end">
                                <button wire:click='storeData' class="btn btn-primary px-5">Kirim Data</button>
                            </div>
                        </div>
                            
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
