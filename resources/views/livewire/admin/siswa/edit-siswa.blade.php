<div class="content">
    @slot('title')
        <h1 class="font-weight-bold">{{$title}}</h1>
    @endslot


    <div class="row">
        <div class="col-12">
            <div class="p-3 card card-primary card-outline card-tabs">
                <div class="card-header">
                
                </div>
                <div class="card-body">
                    @include('livewire.admin.siswa.part.profil-siswa-edit')

                    <div></div>
                </div>
            </div>
        </div>
    </div>

</div>
