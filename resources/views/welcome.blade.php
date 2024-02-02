<x-guest-layout>

    <x-auth-session-status class="mb-4 alert-danger" :status="session('status')" />


    <section id="content" class="mt-5">
        <div class="row">
            <div class="col-sm-12 d-lg-none">
                <div class="card card-welcome">
                    <div class="card-header">
                        <h6 class="font-weight-bold">Login Area</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="div">
                                    <img src="{{ asset('images/lock.png') }}" alt="Lock">
                                </div>
                            </div>

                            <div class="col-9">
                                <form action="{{ route('login') }}" method="post">
                                    @csrf

                                    <div class="form-group">
                                        <input
                                            class="form-control form-control-solid placeholder-no-fix @error('email') is-invalid @enderror"
                                            type="email" required autofocus autocomplete="username" placeholder="Email"
                                            name="email">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <input
                                            class="form-control form-control-solid placeholder-no-fix @error('password') is-invalid @enderror"
                                            type="password" autocomplete="off" placeholder="Password" name="password">
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control @error('semester') is-invalid @enderror" name="semester" >
                                            <option value="" disabled="">-- Pilih Tahun Pelajaran -- </option>
                                            @foreach ($semester as $item)
                                            <option value="{{$item->id}}" {{$item->id == $semesterAktif->id ? 'selected':''}}>{{$item->tahunAjaran->tahun.' '.$item->semester}}</option>
                                            @endforeach
                                        </select>
                                    </div>




                                    <!-- Remember Me -->
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="remember_me"
                                            name="remember">
                                        <label class="form-check-label font-weight-light"
                                            for="remember_me">{{ __('Remember me') }}</label>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-between">
                                        @if(Route::has('password.request'))
                                            <a class="text-muted"
                                                href="{{ route('password.request') }}">
                                                {{ __('Lupa Password?') }}
                                            </a>
                                        @endif
                                        <button type="submit" class="btn btn-success uppercase">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <div class="card card-welcome shadow-md">
                    <div class="card-header">
                        <h6 class="font-weight-bold">What</h6>
                    </div>
                    <div class="card-body">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis modi assumenda asperiores
                        voluptatum neque tempora doloribus quis sint rerum optio!
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio maiores sint ducimus ullam
                        consectetur quo, tempore similique officiis nobis sit nulla cupiditate temporibus accusamus, ad
                        laudantium officia eos nam. Ut adipisci quibusdam aspernatur voluptate quam possimus pariatur
                        fuga, perferendis dolores ex odio odit id, veniam est amet ipsam quod eligendi asperiores ab,
                        velit vel doloribus. Explicabo sequi accusantium voluptas natus.
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card card-welcome">
                    <div class="card-header">
                        <h6 class="font-weight-bold">Informasi</h6>

                    </div>
                    <div class="card-body">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore sint ab quis earum voluptate
                        voluptatibus id at iure temporibus quod.
                    </div>
                </div>
            </div>
            <div class="d-none d-lg-block col-lg-4">
                <div class="card card-welcome">
                    <div class="card-header">
                        <h6 class="font-weight-bold">Login Area</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="div">
                                    <img src="{{ asset('images/lock.png') }}" alt="Lock">
                                </div>
                            </div>

                            <div class="col-9">
                                <form action="{{ route('login') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <input
                                            class="form-control form-control-solid placeholder-no-fix @error('email') is-invalid @enderror"
                                            type="email" required autofocus autocomplete="username" placeholder="Email"
                                            name="email">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <input
                                            class="form-control form-control-solid placeholder-no-fix @error('password') is-invalid @enderror"
                                            type="password" autocomplete="off" placeholder="Password" name="password">
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <select class="form-control @error('semester') is-invalid @enderror" name="semester" >
                                            <option value="" disabled="">-- Pilih Tahun Pelajaran -- </option>
                                            @foreach ($semester as $item)
                                            <option value="{{$item->id}}" {{$item->id == $semesterAktif->id ? 'selected':''}}>{{$item->tahunAjaran->tahun.' '.$item->semester}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- Remember Me -->
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="remember_me"
                                            name="remember">
                                        <label class="form-check-label font-weight-light"
                                            for="remember_me">{{ __('Remember me') }}</label>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-between">
                                        @if(Route::has('password.request'))
                                            <a class="text-muted"
                                                href="{{ route('password.request') }}">
                                                {{ __('Lupa Password?') }}
                                            </a>
                                        @endif
                                        <button type="submit" class="btn btn-success uppercase">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

</x-guest-layout>
