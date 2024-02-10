<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label for="nama_istri" class="text-muted font-weight-normal">Nama *</label>
            <input type="text" id="nama_istri" wire:model="nama_istri" class="form-control form-control-sm @error('nama_istri') is-invalid @enderror">
            @error('nama_istri')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="nik_istri*" class="text-muted font-weight-normal">NIK / No Akte kematian (jika Susah Meninggal) *</label>
            <input type="text" id="nik_istri" wire:model="nik_istri" class="form-control form-control-sm @error('nik_istri') is-invalid @enderror">
            @error('nik_istri')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="tempat_lahir_istri" class="text-muted font-weight-normal">Tempat lahir</label>
            <input type="text" id="tempat_lahir_istri" wire:model="tempat_lahir_istri" class="form-control form-control-sm @error('tempat_lahir_istri') is-invalid @enderror">
            @error('tempat_lahir_istri')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="tanggal_lahir_istri" class="text-muted font-weight-normal">Tanggal Lahir</label>
            <input type="date" id="tanggal_lahir_istri" wire:model="tanggal_lahir_istri" class="form-control form-control-sm @error('tanggal_lahir_istri') is-invalid @enderror">
            @error('tanggal_lahir_istri')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="pendidikan_istri" class="text-muted font-weight-normal">Pendidikan</label>
            <select wire:model='pendidikan_istri' id="pendidikan_istri" class="form-control form-control-sm @error('pendidikan_istri') is-invalid @enderror">
                <option>Pilih</option>
                @foreach ($pendidikan as $item)
                <option value="{{$item}}">{{$item}}</option>
                @endforeach
                
            </select>
            @error('pendidikan_istri')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="pekerjaan_istri" class="text-muted font-weight-normal">Pekerjaan</label>
            <select wire:model='pekerjaan_istri' id="pekerjaan_istri" class="form-control form-control-sm @error('pekerjaan_istri') is-invalid @enderror">
                <option>Pilih</option>
                @foreach ($daftar_pekerjaan as $item)
                <option value="{{$item}}">{{$item}}</option>
                @endforeach
                
            </select>
            @error('pekerjaan_istri')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
       
        
    </div>
</div>