<div class="row">
    <div class="col-12 col-lg-6">
        <div class="form-group">
            <label for="nama" class="text-muted font-weight-normal">Nama*</label>
            <input type="text" id="nama" wire:model="nama" class="form-control form-control-sm @error('nama') is-invalid @enderror">
            @error('nama')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="tmt" class="text-muted font-weight-normal">TMT*</label>
            <input type="date" id="tmt" wire:model.live="tmt" class="form-control form-control-sm @error('tmt') is-invalid @enderror">
            @error('tmt')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="nupl" class="text-muted font-weight-normal">NUPL*</label>
            <input type="text" id="nupl" wire:model="nupl" class="form-control form-control-sm @error('nupl') is-invalid @enderror">
            @error('nupl')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="row">
            <div class="col-sm-12 col-lg-6">
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
            <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                    <label for="tanggal_lahir" class="text-muted font-weight-normal">Tanggal Lahir*</label>
                    <input type="date" id="tanggal_lahir" wire:model="tanggal_lahir" class="form-control form-control-sm @error('tanggal_lahir') is-invalid @enderror">
                    @error('tanggal_lahir')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                    <label for="no_kk" class="text-muted font-weight-normal">NKK</label>
                    <input type="number" id="no_kk" wire:model="no_kk" class="form-control form-control-sm @error('no_kk') is-invalid @enderror" disabled>
                    @error('no_kk')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                    <label for="no_nik" class="text-muted font-weight-normal">NIK</label>
                    <input type="number" id="no_nik" wire:model="no_nik" class="form-control form-control-sm @error('no_nik') is-invalid @enderror" disabled>
                    @error('no_nik')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
        
        
    </div>

    {{-- Right Col --}}
    <div class="col-12 col-lg-6">
    
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
            <label for="pendidikan_terakhir" class="text-muted font-weight-normal">Pendidikan Terakhir</label>
            <select wire:model='pendidikan_terakhir' id="pendidikan_terakhir" class="form-control form-control-sm @error('pendidikan_terakhir') is-invalid @enderror">
                <option>Pilih Jenjang Pendidikan</option>
                @foreach ($pendidikan as $item)
                <option value="{{$item}}">{{$item}}</option>
                @endforeach
            </select>
            @error('pendidikan_terakhir')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="lulusan" class="text-muted font-weight-normal">Lembaga Pendidikan terakhir*</label>
            <input type="text" id="lulusan" wire:model="lulusan" class="form-control form-control-sm @error('lulusan') is-invalid @enderror">
            @error('lulusan')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="status_nikah" class="text-muted font-weight-normal">Status Nikah*</label>
            <select wire:model='status_nikah' id="status_nikah" class="form-control form-control-sm @error('status_nikah') is-invalid @enderror">
                <option>Pilih</option>
                <option value="1">Belum Menikah</option>
                <option value="2">Menikah</option>
                <option value="3">Duda</option>
                <option value="4">Janda</option>
            </select>
            @error('status_nikah')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="typepegawai_id" class="text-muted font-weight-normal">Kepegawaian*</label>
            <select wire:model='typepegawai_id' id="typepegawai_id" class="form-control form-control-sm @error('typepegawai_id') is-invalid @enderror">
                <option>Pilih Jenis Kepegawaian</option>
                @foreach ($type_pegawai as $item)
                <option value="{{ $item->id }}">{{ $item->detail_type }}</option>
                @endforeach
            </select>
            @error('typepegawai_id')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>


    </div>



</div>