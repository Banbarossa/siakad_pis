<div class="row">
    <div class="col-sm-12 col-lg-6">
        <div class="form-group">
            <label for="ayah_nama" class="text-muted font-weight-normal">Nama Ayah *</label>
            <input type="text" id="ayah_nama" wire:model="ayah_nama" class="form-control form-control-sm @error('ayah_nama') is-invalid @enderror">
            @error('ayah_nama')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="ayah_nik*" class="text-muted font-weight-normal">NIK / No Akte kematian (jika Susah Meninggal) *</label>
            <input type="text" id="ayah_nik" wire:model="ayah_nik" class="form-control form-control-sm @error('ayah_nik') is-invalid @enderror">
            @error('ayah_nik')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="ayah_tempat_lahir" class="text-muted font-weight-normal">Tempat lahir</label>
            <input type="text" id="ayah_tempat_lahir" wire:model="ayah_tempat_lahir" class="form-control form-control-sm @error('ayah_tempat_lahir') is-invalid @enderror">
            @error('ayah_tempat_lahir')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="ayah_tanggal_lahir" class="text-muted font-weight-normal">Tanggal Lahir</label>
            <input type="date" id="ayah_tanggal_lahir" wire:model="ayah_tanggal_lahir" class="form-control form-control-sm @error('ayah_tanggal_lahir') is-invalid @enderror">
            @error('ayah_tanggal_lahir')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
    </div>
    <div class="col-sm-12 col-lg-6">
        <div class="form-group">
            <label for="ayah_pendidikan" class="text-muted font-weight-normal">Pendidikan</label>
            <select wire:model='ayah_pendidikan' id="ayah_pendidikan" class="form-control form-control-sm @error('ayah_pendidikan') is-invalid @enderror">
                <option>Pilih</option>
                @foreach ($daftar_pendidikan as $item)
                <option value="{{$item}}">{{$item}}</option>
                @endforeach
                
            </select>
            @error('ibu_pendidikan')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="ayah_pekerjaan" class="text-muted font-weight-normal">Pekerjaan</label>
            <select wire:model='ayah_pekerjaan' id="ayah_pekerjaan" class="form-control form-control-sm @error('ayah_pekerjaan') is-invalid @enderror">
                <option>Pilih</option>
                @foreach ($daftar_pekerjaan as $item)
                <option value="{{$item}}">{{$item}}</option>
                @endforeach
                
            </select>
            @error('pekerjaan')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="ayah_penghasilan" class="text-muted font-weight-normal">Penghasilan</label>
            <select wire:model='ayah_penghasilan' id="ayah_penghasilan" class="form-control form-control-sm @error('ayah_penghasilan') is-invalid @enderror">
                <option>Pilih</option>
                @foreach ($daftar_penghasilan as $item)
                <option value="{{$item}}">{{$item}}</option>
                @endforeach
                
            </select>
            @error('penghasilan')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="ayah_contact" class="text-muted font-weight-normal">No Hp-Wa</label>
            <input type="text" id="ayah_contact" wire:model="ayah_contact" class="form-control form-control-sm @error('ayah_contact') is-invalid @enderror">
            @error('ayah_contact')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
    </div>
</div>