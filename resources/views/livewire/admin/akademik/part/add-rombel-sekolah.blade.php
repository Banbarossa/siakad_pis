
<div class="modal fade" id="modal-default" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{$sekolah_id ? 'Edit Data' :'Tambah Data'}}</h4>
                <button type="button" class="close" wire:click='clear' data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            @if ($rombel_id)
            <form action="" wire:submit='update'>
                
            @else
            <form action="" wire:submit='store'>
            @endif
                <div class="modal-body">
                    @if (!$rombel_id)
                        
                    <div class="form-group">
                        <label for="absen_rombel_id" class="text-muted font-weight-normal">Nama Rombel</label>
                        <select wire:model.live='absen_rombel_id' id="absen_rombel_id" class="form-control form-control-sm @error('absen_rombel_id') is-invalid @enderror">
                            <option>Pilih Nama Rombel</option>
                            @foreach ($rombels as $item)
                            <option value="{{$item['id']}}">{{$item['nama_rombel']}}</option>
                                
                            @endforeach
                        </select>
                        @error('absen_rombel_id')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    @endif

                    
                    <div class="form-group">
                        <label for="guru_id" class="text-muted font-weight-normal">Wali Kelas</label>
                        <select wire:model.live='guru_id' id="guru_id" class="form-control form-control-sm @error('guru_id') is-invalid @enderror">
                            <option>Pilih Wali Kelas</option>
                            @foreach ($gurus as $item)
                            <option value="{{$item->id}}">{{$item->nama_lengkap}}</option>
                                
                            @endforeach
                        </select>
                        @error('guru_id')
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