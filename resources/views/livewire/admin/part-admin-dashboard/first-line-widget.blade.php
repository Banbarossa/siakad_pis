<div class="row my-4">
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box py-3">
            <span class="info-box-icon bg-info"><i class="fas fa-male"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Santri</span>
                <span class="info-box-number">{{ $siswa->where('status_siswa','aktif')->count() }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box py-3">
            <span class="info-box-icon bg-success"><i class="fas fa-user-graduate"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Lulusan</span>
                <span class="info-box-number">{{$siswa->where('status_siswa','lulus')->count()}}</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box py-3">
            <span class="info-box-icon bg-warning"><i class="fas fa-users"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Rombongan Belajar</span>
                <span class="info-box-number">{{$rombels->count()}}</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box py-3">
            <span class="info-box-icon bg-danger"><i class="fas fa-school"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Sekolah</span>
                <span class="info-box-number">{{$sekolahs->count()}}</span>
            </div>
        </div>
    </div>
</div>