
<div class="modal fade" id="modal-default" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{$semester_id ? 'Edit Data' :'Tambah Data'}}</h4>
                <button type="button" class="close" wire:click='clear' data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            @if ($semester_id)
            <form action="" wire:submit='update'>
                
            @else
            <form action="" wire:submit='store'>
            @endif
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tahun_ajaran_id" class="text-muted font-weight-normal">Tahun Ajaran</label>
                        <div class="input-group mb-3">
                            <select wire:model.live='tahun_ajaran_id' id="tahun_ajaran_id" class="form-control form-control-sm @error('tahun_ajaran_id') is-invalid @enderror" @if($semester_id) disabled @endif>
                                <option>Tahun Ajaran</option>
                                @foreach ($model_tahun as $item)
                                    <option value="{{$item->id}}">{{$item->tahun}}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                              <span class="input-group-text" data-toggle="modal"
                              data-target="#modal-tahun"><i class="fas fa-plus"></i></span>
                            </div>
                          </div>
                    </div>

                    {{-- Semester--}}
                    <div class="form-group">
                        <label for="semester" class="text-muted font-weight-normal">Semester</label>
                        <select wire:model.live='semester' id="semester" class="form-control form-control-sm @error('semester') is-invalid @enderror">
                            <option>Pilih Semester</option>
                            <option value="Ganjil">Ganjil</option>
                            <option value="Genap">Genap</option>
                        </select>
                        @error('semester')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="start_date" class="text-muted font-weight-normal">Tanggal Mulai</label>
                        <input type="date" id="start_date" wire:model="start_date" class="form-control form-control-sm @error('start_date') is-invalid @enderror">
                        @error('start_date')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="end_date" class="text-muted font-weight-normal">Tanggal Akhir</label>
                        <input type="date" id="end_date" wire:model="end_date" class="form-control form-control-sm @error('end_date') is-invalid @enderror">
                        @error('end_date')
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