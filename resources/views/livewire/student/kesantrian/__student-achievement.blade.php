<div class="content">
    @slot('title')
        <h1 class="font-weight-bold">Prestasi</h1>
    @endslot


    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                @if ($achievements)
                <div class="timeline">
                    @foreach ($achievements as $item)
                    <div>
                        <i class="fas fa-trophy bg-green"></i>
                        
                        <div class="timeline-item">
                            <span class="time"><i class="fas fa-trophy"></i> {{$item->peringkat}}</span>
                            <h3 class="timeline-header"><a href="#">{{$item->tanggal}}</a> {{$item->tingkat}}</h3>
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
