<div class="content">
    @slot('title')
        <h1 class="font-weight-bold">Kalender Akademik</h1>
    @endslot

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Calender Disini</h3>

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
            <iframe src="{{asset('test.pdf')}}" width="100%" height="500"></iframe>
        </div>
    </div>
</div>
