<div class="content">
    @slot('title')
        <h1 class="font-weight-bold">Dashboard</h1>
    @endslot

    @include('livewire.admin.part-admin-dashboard.first-line-widget')
    <div class="row">
        <div class="col-sm-12 col-lg-5">
            <div class="card card-widget widget-user-2">
                <div class="widget-user-header bg-warning">
                    <div class="widget-user-image">
                        <img class="img-circle elevation-2" src="{{asset('images/favicon.ico')}}" alt="User Avatar">
                    </div>
                    <h3 class="widget-user-username">Pesantren Imam Syafi'i</h3>
                    <h5 class="widget-user-desc">Jumlah Siswa</h5>
                </div>
                <div class="card-footer p-0">
                    <ul class="nav flex-column">
                        @foreach ($sekolahs as $item)
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                {{$item->nama_sekolah}} <span class="float-right badge bg-primary">{{$item->jumlahSiswa}}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-7">
            <div class="card" style="position: relative; left: 0px; top: 0px;">
                <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">
                    <h3 class="card-title">
                        <i class="fas fa-user-alt mr-1"></i>
                        Data Siswa Rombel
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="canvas">
                        {!!$chart->container()!!}
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                </div>
            </div>
        </div>
    </div>


    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}

</div>
