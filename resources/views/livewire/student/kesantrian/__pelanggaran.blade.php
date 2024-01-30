<div class="content">
    @slot('title')
        <h1 class="font-weight-bold">Pelanggaran</h1>
    @endslot


    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                @if ($pelanggaran)
                <div class="timeline">
                    @foreach ($pelanggaran as $item)
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
                        
                    @endforeach
                 
                </div>
                @else
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Informasi</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <strong>Alhamdulillah,</strong> Belum ada pelanggaran yang direcord.
                        </div>
                    </div>
                @endif
                
            </div>
        </div>
    </div>

</div>
