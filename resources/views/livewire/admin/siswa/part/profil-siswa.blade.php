<div class="row">
    <div class="col-12 col-lg-6">
        @foreach ($primaryProfil as $item)
        <div class="form-group">
            <label for="{{$item['id']}}" class="text-muted font-weight-normal">{{$item['label']}}{{$item['require'] ?'*':''}}</label>
            <input type="{{$item['type']}}" id="{{$item['id']}}" wire:model="{{$item['name']}}" class="form-control form-control-sm @error($item['name']) is-invalid @enderror">
            @error($item['name'])
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        @endforeach
    </div>

    {{-- Rogh Col --}}
    <div class="col-12 col-lg-6">
        {{-- ttl --}}
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label for="tempat_lahir" class="text-muted font-weight-normal">Tempat Lahir*</label>
                    <input type="text" id="tempat_lahir" wire:model="tempat_lahir" class="form-control form-control-sm @error('tempat_lahir') is-invalid @enderror">
                    @error('tempat_lahir')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label for="tanggal_lahir" class="text-muted font-weight-normal">tanggal Lahir*</label>
                    <input type="date" id="tanggal_lahir" wire:model="tanggal_lahir" class="form-control form-control-sm @error('tanggal_lahir') is-invalid @enderror">
                    @error('tanggal_lahir')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
        {{-- Jenis Kelamin --}}
        <div class="form-group">
            <label for="jenis_kelamin" class="text-muted font-weight-normal">Jenis Kelamin*</label>
            <select wire:model='jenis_kelamin' id="jenis_kelamin" class="form-control form-control-sm @error('jenis_kelamin') is-invalid @enderror">
                <option value="laki laki">Laki Laki</option>
                <option value="perempuan">Perempuan</option>
            </select>
            @error('jenis_kelamin')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="nik" class="text-muted font-weight-normal">NIK*</label>
            <input type="number" id="nik" wire:model="nik" class="form-control form-control-sm @error('nik') is-invalid @enderror">
            @error('nik')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        {{-- Status sosial --}}
        <div class="form-group">
            <label for="status_sosial" class="text-muted font-weight-normal">Status*</label>
            <select wire:model='status_sosial' id="status_sosial" class="form-control form-control-sm @error('status_sosial') is-invalid @enderror">
                <option>Pilih</option>
                <option value="non yatim">Non yatim</option>
                <option value="yatim">Yatim</option>
                <option value="Piatu">Piatu</option>
            </select>
            @error('status_sosial')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        {{-- Status rumah --}}
        <div class="form-group">
            <label for="status_rumah" class="text-muted font-weight-normal">Status Rumah*</label>
            <select wire:model='status_rumah' id="status_rumah" class="form-control form-control-sm @error('status_rumah') is-invalid @enderror">
                <option>Pilih</option>
                <option value="Rumah Sendiri">Rumah Sendiri</option>
                <option value="Rumah Orang Tua">Rumah Orang Tua</option>
                <option value="Rumah Dinas">Rumah Dinas</option>
                <option value="Rumah Sewa">Rumah Sewa</option>
            </select>
            @error('status_rumah')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        {{-- Status Tinggal --}}
        <div class="form-group">
            <label for="is_asrama" class="text-muted font-weight-normal">Tinggal Di Asrama*</label>
            <select wire:model='is_asrama' id="is_asrama" class="form-control form-control-sm @error('is_asrama') is-invalid @enderror">
                <option value="1">Ya</option>
                <option value="0">Tidak</option>
            </select>
            @error('is_asrama')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        {{-- Hubungan Keluarga --}}
        <div class="form-group">
            <label for="hubungan_keluarga" class="text-muted font-weight-normal">Hubungan Keluarga*</label>
            <select wire:model='hubungan_keluarga' id="hubungan_keluarga" class="form-control form-control-sm @error('hubungan_keluarga') is-invalid @enderror">
                <option>Pilih</option>
                <option value="anak kandung">Anak Kandung</option>
                <option value="anak tiri">Anak Tiri</option>
                <option value="anak angkat">Anak Angkat</option>
            </select>
            @error('hubungan_keluarga')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        {{-- Anak Ke --}}
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label for="anak_ke" class="text-muted font-weight-normal">Anak Ke*</label>
                    <input type="number" id="anak_ke" wire:model="anak_ke" class="form-control form-control-sm @error('anak_ke') is-invalid @enderror">
                    @error('anak_ke')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label for="dari_jumlah_saudara" class="text-muted font-weight-normal">Dari Jumlah Saudara</label>
                    <input type="number" id="dari_jumlah_saudara" wire:model="dari_jumlah_saudara" class="form-control form-control-sm @error('dari_jumlah_saudara') is-invalid @enderror">
                    @error('dari_jumlah_saudara')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
        {{-- Jumlah Saudara berdasarkan jenis kelamin--}}
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label for="jumlah_saudara_laki_laki" class="text-muted font-weight-normal">Jumlah Saudara Laki laki</label>
                    <input type="number" id="jumlah_saudara_laki_laki" wire:model="jumlah_saudara_laki_laki" class="form-control form-control-sm @error('jumlah_saudara_laki_laki') is-invalid @enderror">
                    @error('jumlah_saudara_laki_laki')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label for="jumlah_saudara_perempuan" class="text-muted font-weight-normal">Jumlah Saudara Perempuan*</label>
                    <input type="number" id="jumlah_saudara_perempuan" wire:model="jumlah_saudara_perempuan" class="form-control form-control-sm @error('jumlah_saudara_perempuan') is-invalid @enderror">
                    @error('jumlah_saudara_perempuan')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
        {{-- Hubungan Keluarga --}}
        <div class="form-group">
            <label for="golongan_darah" class="text-muted font-weight-normal">Golongan Darah</label>
            <select wire:model='golongan_darah' id="golongan_darah" class="form-control form-control-sm @error('golongan_darah') is-invalid @enderror">
                <option>Pilih</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="AB">AB</option>
                <option value="O">O</option>
            </select>
            @error('golongan_darah')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>


        <div class="d-flex justify-content-end">
            <button wire:click='FirstLevelValidation()' class="px-5 btn btn-primary">Lanjutkan</button>
        </div>

    </div>



</div>