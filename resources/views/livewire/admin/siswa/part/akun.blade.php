<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label for="inputEmail" class="text-muted font-weight-normal">E-Mail*</label>
            <input type="email" id="inputEmail" wire:model='email'
                class="form-control @error('email') is-invalid @enderror" >
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="password" class="text-muted font-weight-normal">Password*</label>
            <input type="text" id="password" wire:model='password'
                class="form-control @error('password') is-invalid @enderror">
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="password_confirmation" class="text-muted font-weight-normal">Konfirmasi Password*</label>
            <input type="text" id="password_confirmation" wire:model='password_confirmation'
                class="form-control @error('password_confirmation') is-invalid @enderror">
            @error('password_confirmation')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="d-flex justify-content-end">
            <button wire:click='storeData' class="px-5 btn btn-primary">Kirim Data</button>
        </div>

    </div>




</div>
