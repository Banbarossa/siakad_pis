<div class="row">
    <div class="col-sm-12 col-lg-6">
        <div class="form-group">
            <label for="ibu_nama" class="text-muted font-weight-normal">Nama Ibu *</label>
            <input type="text" id="ibu_nama" wire:model="ibu_nama" class="form-control form-control-sm @error('ibu_nama') is-invalid @enderror">
            @error('ibu_nama')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="ibu_nik*" class="text-muted font-weight-normal">NIK / No Akte kematian (jika Susah Meninggal) *</label>
            <input type="text" id="ibu_nik" wire:model="ibu_nik" class="form-control form-control-sm @error('ibu_nik') is-invalid @enderror">
            @error('ibu_nik')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="ibu_tempat_lahir" class="text-muted font-weight-normal">Tempat lahir</label>
            <input type="text" id="ibu_tempat_lahir" wire:model="ibu_tempat_lahir" class="form-control form-control-sm @error('ibu_tempat_lahir') is-invalid @enderror">
            @error('ibu_tempat_lahir')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="ibu_tanggal_lahir" class="text-muted font-weight-normal">Tanggal Lahir</label>
            <input type="date" id="ibu_tanggal_lahir" wire:model="ibu_tanggal_lahir" class="form-control form-control-sm @error('ibu_tanggal_lahir') is-invalid @enderror">
            @error('ibu_tanggal_lahir')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        
        
    </div>
    <div class="col-sm-12 col-lg-6">
        <div class="form-group">
            <label for="ibu_pendidikan" class="text-muted font-weight-normal">Pendidikan</label>
            <select wire:model='ibu_pendidikan' id="ibu_pendidikan" class="form-control form-control-sm @error('ibu_pendidikan') is-invalid @enderror">
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
            <label for="ibu_pekerjaan" class="text-muted font-weight-normal">Pekerjaan</label>
            <select wire:model='ibu_pekerjaan' id="ibu_pekerjaan" class="form-control form-control-sm @error('ibu_pekerjaan') is-invalid @enderror">
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
            <label for="ibu_penghasilan" class="text-muted font-weight-normal">Penghasilan</label>
            <select wire:model='ibu_penghasilan' id="ibu_penghasilan" class="form-control form-control-sm @error('ibu_penghasilan') is-invalid @enderror">
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
            <label for="ibu_contact" class="text-muted font-weight-normal">No Hp-Wa</label>
            <input type="text" id="ibu_contact" wire:model="ibu_contact" class="form-control form-control-sm @error('ibu_contact') is-invalid @enderror">
            @error('ibu_contact')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        {{-- <div class="form-group">
            <label for="province_id" class="text-muted font-weight-normal">Provinsi</label>
            <select wire:model.live='province_id' id="province_id" class="form-control form-control-sm @error('province_id') is-invalid @enderror">
                <option>Pilih</option>
                @foreach ($provincies as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
                
            </select>
            @error('province_id')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="regency_id" class="text-muted font-weight-normal">Kabupaten</label>
            <select wire:model.live='regency_id' id="regency_id" class="form-control form-control-sm @error('regency_id') is-invalid @enderror">
                <option>Pilih</option>
                @foreach ($regencies as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
                
            </select>
            @error('regency_id')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="district_id" class="text-muted font-weight-normal">Kecamatan</label>
            <select wire:model.live='district_id' id="district_id" class="form-control form-control-sm @error('district_id') is-invalid @enderror">
                <option>Pilih</option>
                @foreach ($districts as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
                
            </select>
            @error('district_id')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="village_id" class="text-muted font-weight-normal">Desa</label>
            <select wire:model.live='village_id' id="village_id" class="form-control form-control-sm @error('village_id') is-invalid @enderror">
                <option>Pilih</option>
                @foreach ($villages as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
                
            </select>
            @error('village_id')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="alamat" class="text-muted font-weight-normal">Alamat</label>
            <textarea wire:model="alamat" class="form-control" id="alamat"  rows="2"></textarea>
            @error('alamat')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="kode_pos" class="text-muted font-weight-normal">Kode Pos</label>
            <input type="number" id="kode_pos" wire:model="kode_pos" class="form-control form-control-sm @error('kode_pos') is-invalid @enderror">
            @error('kode_pos')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div> --}}

    </div>
</div>