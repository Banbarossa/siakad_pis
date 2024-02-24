<div class="modal-body">
    <div class="form-group">
        <label for="nama_kafil_indo" class="text-muted font-weight-normal">Nama kafil (Bahasa Indonesia) *</label>
        <input type="text" id="nama_kafil_indo" wire:model="nama_kafil_indo" class="form-control form-control-sm @error('nama_kafil_indo') is-invalid @enderror">
        @error('nama_kafil_indo')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="nama_kafil_arab" class="text-muted font-weight-normal">Nama kafil (Bahasa Arab) *</label>
        <input type="text" id="nama_kafil_arab" wire:model="nama_kafil_arab" class="form-control form-control-sm @error('nama_kafil_arab') is-invalid @enderror">
        @error('nama_kafil_arab')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror
    </div>
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="form-group">
                <label for="nomor_yatim" class="text-muted font-weight-normal">Nomor Kafil *</label>
                <input type="text" id="nomor_yatim" wire:model="nomor_yatim" class="form-control form-control-sm @error('nomor_yatim') is-invalid @enderror">
                @error('nomor_yatim')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="form-group">
                <label for="nomor_kafil" class="text-muted font-weight-normal">Nomor Kafil *</label>
                <input type="text" id="nomor_kafil" wire:model="nomor_kafil" class="form-control form-control-sm @error('nomor_kafil') is-invalid @enderror">
                @error('nomor_kafil')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>
    </div>
    
</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal" wire:click='clear'>Close</button>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>