<div class="content">
    @slot('title')
        <h1 class="font-weight-bold">{{ $title }}</h1>
    @endslot


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body row">
                    <div class="col-5 text-center d-flex align-items-center justify-content-center">
                        <div class="">

                            <img src="{{asset('images/logo.png')}}" width="60px" alt="logo">
                            <h2><strong>{{strToUpper($name)}}</strong></h2>
                            <p><strong>{{ucFirst($level)}}</strong></p>
                        </div>
                    </div>
                    <div class="col-7">
                        <form action="" wire:submit.prevent='updateProfile'>
                            <div class="form-group">
                                <label for="inputName">Name</label>
                                <input type="text" id="inputName" wire:model='name' class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="inputEmail">E-Mail</label>
                                <input type="email" id="inputEmail" wire:model='email' class="form-control @error('email') is-invalid @enderror" readonly>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" wire:model='password' class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Konfirmasi Password</label>
                                <input type="password" id="password_confirmation" wire:model='password_confirmation' class="form-control @error('password_confirmation') is-invalid @enderror">
                                @error('password_confirmation')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Update Profile">
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>




    </div>


</div>
