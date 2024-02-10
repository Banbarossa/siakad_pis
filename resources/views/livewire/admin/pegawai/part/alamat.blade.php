<div class="row">
    <div class="col-sm-12 col-lg-6">
        <div class="form-group">
            <label for="province_id" class="text-muted font-weight-normal">Provinsi*</label>
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
            <label for="regency_id" class="text-muted font-weight-normal">Kabupaten*</label>
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
            <label for="district_id" class="text-muted font-weight-normal">Kecamatan*</label>
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
    </div>
    <div class="col-sm-12 col-lg-6">
        <div class="form-group">
            <label for="village_id" class="text-muted font-weight-normal">Desa*</label>
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