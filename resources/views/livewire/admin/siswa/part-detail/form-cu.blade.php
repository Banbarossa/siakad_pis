<div class="row">
    <div class="col-sm-12 col-lg-6">
        <div class="form-group">
            <label for="nama" class="text-muted font-weight-normal">Nama *</label>
            <input type="text" id="nama" wire:model="nama" class="form-control form-control-sm @error('nama') is-invalid @enderror">
            @error('nama')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="nik*" class="text-muted font-weight-normal">NIK / No Akte kematian (jika Susah Meninggal) *</label>
            <input type="text" id="nik" wire:model="nik" class="form-control form-control-sm @error('nik') is-invalid @enderror">
            @error('nik')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="tempat_lahir" class="text-muted font-weight-normal">Tempat lahir</label>
            <input type="text" id="tempat_lahir" wire:model="tempat_lahir" class="form-control form-control-sm @error('tempat_lahir') is-invalid @enderror">
            @error('tempat_lahir')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="tanggal_lahir" class="text-muted font-weight-normal">Tanggal Lahir</label>
            <input type="date" id="tanggal_lahir" wire:model="tanggal_lahir" class="form-control form-control-sm @error('tanggal_lahir') is-invalid @enderror">
            @error('tanggal_lahir')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="pendidikan" class="text-muted font-weight-normal">Pendidikan</label>
            <select wire:model='pendidikan' id="pendidikan" class="form-control form-control-sm @error('pendidikan') is-invalid @enderror">
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
            <label for="pekerjaan" class="text-muted font-weight-normal">Pekerjaan</label>
            <select wire:model='pekerjaan' id="pekerjaan" class="form-control form-control-sm @error('pekerjaan') is-invalid @enderror">
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
            <label for="penghasilan" class="text-muted font-weight-normal">Penghasilan</label>
            <select wire:model='penghasilan' id="penghasilan" class="form-control form-control-sm @error('penghasilan') is-invalid @enderror">
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
        
    </div>
    <div class="col-sm-12 col-lg-6">
        <div class="form-group">
            <label for="contact" class="text-muted font-weight-normal">No Hp-Wa</label>
            <input type="text" id="contact" wire:model="contact" class="form-control form-control-sm @error('contact') is-invalid @enderror">
            @error('contact')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
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

        {{-- kabupaten --}}
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
        {{-- Kecamatan --}}
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
        {{-- Desa --}}
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
        </div>

    </div>
</div>