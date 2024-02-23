
<div class="modal fade" id="modal-default" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{$sekolah_id ? 'Edit Data' :'Tambah Data'}}</h4>
                <button type="button" class="close" wire:click='clear' data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            @if ($rombel_id)
            <form action="" wire:submit='update'>
                
            @else
            <form action="" wire:submit='store'>
            @endif
                <div class="modal-body">
                    <div class="form-group">
                        <label for="absen_rombel_id" class="text-muted font-weight-normal">Nama Rombel</label>
                        <input type="text" wire:model='nama_rombel' id="nama_rombel" class="form-control form-control-sm @error('nama_rombel') is_invalid @enderror" placeholder="Nama Rombel">
                        @error('absen_rombel_id')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tingkat_kelas" class="text-muted font-weight-normal">Tingkat Kelas</label>
                        <select wire:model.live='tingkat_kelas' id="tingkat_kelas" class="form-control form-control-sm @error('tingkat_kelas') is-invalid @enderror">
                            <option>Pilih Tingkat Kelas</option>
                            @foreach ($tingkat_kelas_berdasarkan_sekolah as $item)
                            <option value="{{$item}}">{{$item}}</option>
                                
                            @endforeach
                        </select>
                        @error('tingkat_kelas')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="pegawai_id" class="text-muted font-weight-normal">Wali Kelas</label>
                        <select wire:model.live='pegawai_id' id="pegawai_id" class="form-control form-control-sm @error('pegawai_id') is-invalid @enderror">
                            <option>Pilih Wali Kelas</option>
                            @foreach ($pegawais as $item)
                            <option value="{{$item->id}}">{{$item->nama}}</option>
                                
                            @endforeach
                        </select>
                        @error('pegawai_id')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>




                    {{-- @if (!$rombel_id)
                        
                    <div class="form-group">
                        <div class="form-group">
                            <label for="nama_rombel" class="text-muted font-weight-normal">Nama Rombel <small class="text-muted"></small></label>
                            <input type="text" id="nama_rombel" wire:model="nama_rombel" class="form-control form-control-sm @error('nama_rombel') is-invalid @enderror">
                            @error('nama_rombel')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <label for="absen_rombel_id" class="text-muted font-weight-normal">Nama Rombel</label>
                        <select wire:model.live='absen_rombel_id' id="absen_rombel_id" class="form-control form-control-sm @error('absen_rombel_id') is-invalid @enderror">
                            <option>Pilih Nama Rombel</option>
                            @foreach ($rombels as $item)
                            <option value="{{$item['id']}}">{{$item['nama_rombel']}}</option>
                                
                            @endforeach
                        </select>
                        @error('absen_rombel_id')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    @endif --}}

                    
                    {{-- <div class="form-group">
                        <label for="guru_id" class="text-muted font-weight-normal">Wali Kelas</label>
                        <select wire:model.live='guru_id' id="guru_id" class="form-control form-control-sm @error('guru_id') is-invalid @enderror">
                            <option>Pilih Wali Kelas</option>
                            @foreach ($gurus as $item)
                            <option value="{{$item->id}}">{{$item->nama_lengkap}}</option>
                                
                            @endforeach
                        </select>
                        @error('guru_id')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div> --}}

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" wire:click='clear' data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="mr-3 far fa-paper-plane"></i>Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>