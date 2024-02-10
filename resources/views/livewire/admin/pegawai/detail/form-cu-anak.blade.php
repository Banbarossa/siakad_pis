<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label for="nama_anak" class="text-muted font-weight-normal">Nama*</label>
            <input type="text" id="nama_anak" wire:model="nama_anak" class="form-control form-control-sm @error('nama_anak') is-invalid @enderror">
            @error('nama_anak')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="anak_ke*" class="text-muted font-weight-normal">Anak Ke*</label>
            <input type="number" id="anak_ke" wire:model="anak_ke" class="form-control form-control-sm @error('anak_ke') is-invalid @enderror">
            @error('anak_ke')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="nik_anak*" class="text-muted font-weight-normal">NIK</label>
            <input type="text" id="nik_anak" wire:model="nik_anak" class="form-control form-control-sm @error('nik_anak') is-invalid @enderror">
            @error('nik_anak')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="row">
            <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                    <label for="tempat_lahir_anak" class="text-muted font-weight-normal">Tempat lahir</label>
                    <input type="text" id="tempat_lahir_anak" wire:model="tempat_lahir_anak" class="form-control form-control-sm @error('tempat_lahir_anak') is-invalid @enderror">
                    @error('tempat_lahir_anak')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                    <label for="tanggal_lahir_anak" class="text-muted font-weight-normal">Tanggal Lahir</label>
                    <input type="date" id="tanggal_lahir_anak" wire:model="tanggal_lahir_anak" class="form-control form-control-sm @error('tanggal_lahir_anak') is-invalid @enderror">
                    @error('tanggal_lahir_anak')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="jenis_kelamin_anak" class="text-muted font-weight-normal">Jenis Kelamin</label>
            <select wire:model='jenis_kelamin_anak' id="jenis_kelamin_anak" class="form-control form-control-sm @error('jenis_kelamin_anak') is-invalid @enderror">
                <option>Pilih jenis Kelamin</option>
                <option value="laki laki">Laki Laki</option>
                <option value="laki laki">Perempuan</option>
                
            </select>
            @error('jenis_kelamin_anak')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        
        
        <div class="form-group">
            <label for="pendidikan_anak" class="text-muted font-weight-normal">Pendidikan</label>
            <select wire:model='pendidikan_anak' id="pendidikan_anak" class="form-control form-control-sm @error('pendidikan_anak') is-invalid @enderror">
                <option>Pilih</option>
                @foreach ($pendidikan as $item)
                <option value="{{$item}}">{{$item}}</option>
                @endforeach
                
            </select>
            @error('pendidikan_anak')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        
       
        
    </div>
</div>