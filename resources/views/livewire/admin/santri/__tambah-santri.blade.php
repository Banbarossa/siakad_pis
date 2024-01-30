<div class="content">
    @slot('title')
        <h1 class="font-weight-bold">Tambah Data Santri</h1>
    @endslot


    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline card-tabs p-3">
                <div class="card-header p-0 pt-1 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link {{$level==1 ? 'active':''}}" id="profil-santri-tab" data-toggle="pill" href="#profil-santri"
                                role="tab" aria-controls="profil-santri" aria-selected="false">Profil Siswa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{$level==2 ? 'active':''}}" wire:click='FirstLevelValidation()' id="profil-ayah-tab" data-toggle="pill" href="#profil-ayah" role="tab"
                                aria-controls="profil-ayah" aria-selected="false">Data Orang Tua</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{$level==3 ? 'active':''}}" wire:click='SecondLevelValidation()' id="alamat-tab" data-toggle="pill" href="#alamat" role="tab"
                                aria-controls="alamat" aria-selected="false">Alamat Asal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{$level==4 ? 'active':''}}" wire:click='thirdLevelValidation()' id="akun-tab" data-toggle="pill" href="#akun" role="tab"
                                aria-controls="akun" aria-selected="false">Akun</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-three-tabContent">
                        <div class="tab-pane fade {{$level==1 ? 'active show' :''}}" id="profil-santri" role="tabpanel"
                            aria-labelledby="profil-santri-tab">
                            @include('livewire.admin.santri.part.profil-siswa')
                        </div>
                        <div class="tab-pane fade {{$level==2 ? 'active show' :''}}" id="profil-ayah" role="tabpanel" aria-labelledby="profil-ayah-tab">
                            @include('livewire.admin.santri.part.orangtua')
                        </div>
                        <div class="tab-pane fade {{$level==3 ? 'active show' :''}}" id="alamat" role="tabpanel" aria-labelledby="alamat-tab">
                            @include('livewire.admin.santri.part.alamat')
                        </div>
                        <div class="tab-pane fade {{$level==4 ? 'active show' :''}}" id="akun" role="tabpanel" aria-labelledby="akun-tab">
                            @include('livewire.admin.santri.part.akun')
                        </div>

                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>

</div>
