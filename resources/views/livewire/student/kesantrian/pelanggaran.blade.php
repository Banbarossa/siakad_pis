<div class="content">
    @slot('title')
        <h1 class="font-weight-bold">Profile</h1>
    @endslot


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Santri</h3>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-pills nav-sidebar flex-column">
                                @foreach ($siswa as $item)
                                <li class="nav-item">
                                     <a href="javascript:void(0)" class="nav-link {{$item->id == $Idstudent ? 'active' :''}}" wire:click='changeStudent({{$item->id}})'>{{$item->nama}}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <h5 class="title font-weight-bold">Pelanggaran</h5>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">

                                
                                <div class="tab-pane active" id="timeline">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-md-12">
                                                   
                                                    <div class="timeline">
                                                        @forelse ($pelanggaran as $item)
                                                        <div>
                                                            @if ($item->level_pelanggaran == 'Berat')
                                                                <i class="fas fa-circle bg-red"></i>
                                                            @elseif ($item->level_pelanggaran == 'Sedang')
                                                                <i class="fas fa-circle bg-yellow"></i>
                                                            @else
                                                                <i class="fas fa-circle bg-gray"></i>
                                                            @endif
                                                            
                                                            <div class="timeline-item">
                                                                <span class="time"><i class="fas fa-clock"></i> {{$item->jam}}</span>
                                                                <h3 class="timeline-header"><a href="#">{{$item->tanggal}}</a> {{$item->level_pelanggaran}}</h3>
                                                                <div class="timeline-body">
                                                                    {{$item->deskripsi}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @empty
                                                            <div>
                                                                Alhamdulillah, Beluam Ada pelanggaran yang tercatat
                                                            </div>
                                                        @endforelse
                                                     
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
