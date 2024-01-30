
<div class="modal fade" id="modal-default" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{$sekolah_id ? 'Edit Data' :'Tambah Data'}}</h4>
                <button type="button" class="close" wire:click='clear' data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            @if ($sekolah_id)
            <form action="" wire:submit='update'>
                
            @else
            <form action="" wire:submit='store'>
            @endif
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_sekolah" class="text-muted font-weight-normal">Nama Sekolah <small class="text-muted"></small></label>
                        <input type="text" id="nama_sekolah" wire:model="nama_sekolah" class="form-control form-control-sm @error('nama_sekolah') is-invalid @enderror">
                        @error('nama_sekolah')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>


                    {{-- Semester--}}
                    <div class="form-group">
                        <label for="tingkat" class="text-muted font-weight-normal">Tingkat</label>
                        <select wire:model.live='tingkat' id="tingkat" class="form-control form-control-sm @error('tingkat') is-invalid @enderror">
                            <option>Pilih tingkat</option>
                            <option value="Ibtidaiyyah">Ibtidaiyyah</option>
                            <option value="Mutawassithah">Mutawassithah</option>
                            <option value="Tsanawiyyah">Tsanawiyyah</option>
                        </select>
                        @error('tingkat')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="user_id" class="text-muted font-weight-normal">Kepala Sekolah</label>
                        <select wire:model.live='user_id' id="user_id" class="form-control form-control-sm @error('user_id') is-invalid @enderror">
                            <option>Pilih Kepala Sekolah</option>
                            @foreach ($users as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        @error('user_id')
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