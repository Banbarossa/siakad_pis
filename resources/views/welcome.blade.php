<x-login-layout>

    <x-auth-session-status class="mb-4 alert-danger" :status="session('status')" />

    <x-guest-card>
        <div class="grid grid-cols-1 md:grid-cols-3 ">
            <div class="px-8 py-20">
                <div class="flex justify-center mb-5">
                    <img src="{{ asset('images/favicon.ico') }}" class="w-20" alt="">
                </div>
                @if (session()->has('error'))
                    <x-login-error :messages="session()->get('error')"></x-login-error>
                @endif
                <div class="mb-4">
                    <h1 class="text-2xl font-semibold text-red-950 dark:text-white">Login</h1>
                </div>
                <form method="POST" action="{{ route('login.store') }}">
                    @csrf
                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email / NISN')" />
                        <x-tail-text-input name="email" id="email" class="block w-full mt-1" type="text" autofocus autocomplete="email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
            
                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />
            
                        <x-tail-text-input name="password" id="password" class="block w-full mt-1"
                                        type="password"
                                         autocomplete="current-password" />
            
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    
                    <div class="mt-4">
                        <x-input-label for="semester" :value="__('Semester')" />
                        <x-select-input id="semester" name="semester">
                            <option value="" disabled="">-- Pilih Tahun Pelajaran -- </option>
                            @foreach ($semester as $item)
                            <option value="{{$item->id}}" {{$item->id == $semesterAktif->id ? 'selected':''}}>{{$item->tahunAjaran->tahun.' '.$item->semester}}</option>
                            @endforeach

                        </x-select-input>
                        <x-input-error :messages="$errors->get('semester')" class="mt-2" />
                    </div>
            
                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember" class="inline-flex items-center">
                            <input name="remember" id="remember" type="checkbox" class="text-indigo-600 border-gray-300 rounded shadow-sm dark:bg-gray-900 dark:border-gray-700 focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800">
                            <span class="text-sm text-gray-600 ms-2 dark:text-white">{{ __('Remember me') }}</span>
                        </label>
                    </div>
            
                    <div class="my-4 ">
                        
                        <x-tail-primary-button type='submit' class="flex justify-center w-full">
                            {{ __('Log in') }}
                        </x-tail-primary-button>
                    </div>
                    @if (Route::has('password.request'))
                            <a class="text-sm text-gray-600 rounded-md dark:text-white hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                    @endif
                    
                    
                </form>
            </div>
            <div class=" hidden md:block relative col-span-2 bg-no-repeat bg-cover bg-[url('https://images.unsplash.com/photo-1618005198919-d3d4b5a92ead?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')] bg-gray-100 dark:bg-gray-700 bg-blend-multiply">
                <div class="absolute w-full p-10 text-center -translate-x-1/2 -translate-y-1/2 bg-white bg-opacity-25 top-1/2 left-1/2 dark:bg-gray-700 backdrop-filter backdrop-blur-md">
                    <h4 class="text-lg dark:text-white">Selamat Datang</h4>
                    <h3 class="text-2xl dark:text-white">di sistem informasi Akademik</h3>
                    <h1 class="mt-4 font-extrabold text-transparent text-7xl bg-clip-text bg-gradient-to-r from-pink-500 to-violet-500">PESANTREN IMAM SYAFI'I</h1>
                </div>
            </div>
    
        </div>
    </x-guest-card>


</x-login-layout>
