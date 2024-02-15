<div class="modal-body">
    <div class="form-group">
        <label for="nama_mapel" class="text-muted font-weight-normal">Nama Mata Pelajaran</label>
        <input type="text" id="nama_mapel" wire:model="nama_mapel" class="form-control form-control-sm @error('nama_mapel') is-invalid @enderror">
        @error('nama_mapel')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="ringkasan_mapel" class="text-muted font-weight-normal">Ringkasan Nama / Kode Mapel</label>
        <input type="text" id="ringkasan_mapel" wire:model="ringkasan_mapel" class="form-control form-control-sm @error('ringkasan_mapel') is-invalid @enderror">
        @error('ringkasan_mapel')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror
    </div>
  

</div>