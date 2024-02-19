<div>
    
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fas fa-key"></i>
                        Akun Santri
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <tbody>
                    
                                <tr>
                                    <td>Nama Akun</td>
                                    <td>:</td>
                                    <td>{{ $akun? $akun->name :'' }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td>{{ $akun ? $akun->email :''}}</td>
                                </tr>
                                <tr>
                                    <td>Username/NISN</td>
                                    <td>:</td>
                                    <td>{{ $akun ?$akun->username :''}}</td>
                                </tr>
                                
                            </tbody>
                        </table>
        
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fas fa-key"></i>
                        Update Akun
                    </div>
                </div>
                <div class="card-body">
                    <form action="" wire:submit.prevent='updateAkun' wire:ignore.self>

                        <div class="form-group">
                            <label for="akun_name" class="text-muted font-weight-normal">Nama Akun</label>
                            <input type="text" id="akun_name" wire:model="akun_name" class="form-control form-control-sm @error('akun_name') is-invalid @enderror">
                            @error('akun_name')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="akun_email" class="text-muted font-weight-normal">Email</label>
                            <input type="text" id="akun_email" wire:model="akun_email" class="form-control form-control-sm @error('akun_email') is-invalid @enderror">
                            @error('akun_email')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="akun_username" class="text-muted font-weight-normal">Username/Email</label>
                            <input type="text" id="akun_username" wire:model="akun_username" class="form-control form-control-sm @error('akun_username') is-invalid @enderror">
                            @error('akun_username')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div>
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </form>


                </div>
    
                
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fas fa-key"></i>
                        Change Password
                    </div>
                </div>
                <div class="card-body">
                    <form action="" wire:submit.prevent='updatePassword' wire:ignore.self>

                        <div class="form-group">
                            <label for="new_password" class="text-muted font-weight-normal">Username/NISN</label>
                            <input type="text" id="new_password" wire:model="new_password" class="form-control form-control-sm @error('new_password') is-invalid @enderror">
                            @error('new_password')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        <div>
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </form>


                </div>
    
                
            </div>
        </div>
        {{-- @endif --}}
    </div>
</div>