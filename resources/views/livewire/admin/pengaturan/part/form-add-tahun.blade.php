
<div class="modal fade" id="modal-tahun" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{$semester_id ? 'Edit Data' :'Tambah Data'}}</h4>
                <button type="button" class="close" wire:click='clear' data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            @if ($semester_id)
            <form action="" wire:submit='updateTahun'>
                
            @else
            <form action="" wire:submit='tambahTahun'>
            @endif


                <div class="modal-body">

                    <div class="form-group">
                        <label for="tahun" class="text-muted font-weight-normal">Tahun Ajaran</label>
                        <input type="year" id="tahun" wire:model="tahun" class="form-control form-control-sm @error('tahun') is-invalid @enderror">
                        @error('tahun')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="start_date" class="text-muted font-weight-normal">Tanggal Mulai</label>
                        <input type="date" id="start_date" wire:model="tahun_start_date" class="form-control form-control-sm @error('tahun_start_date') is-invalid @enderror">
                        @error('tahun_start_date')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="end_date" class="text-muted font-weight-normal">Tanggal Akhir</label>
                        <input type="date" id="end_date" wire:model="tahun_end_date" class="form-control form-control-sm @error('tahun_end_date') is-invalid @enderror">
                        @error('tahun_end_date')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
                
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" wire:click='clear' data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="far fa-paper-plane mr-3"></i>Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>