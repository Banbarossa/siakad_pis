<x-login-layout>

    <x-auth-session-status class="mb-4 alert-danger" :status="session('status')" />

    <x-guest-card>
        <div class="grid grid-cols-1 md:grid-cols-3 ">
            <div class="py-20 px-8">
                <div class="flex justify-center mb-5">
                    <img src="{{ asset('images/favicon.ico') }}" class="w-20" alt="">
                </div>
                @if (session()->has('error'))
                    <x-login-error :messages="session()->get('error')"></x-login-error>
                @endif
                <div class="mb-4">
                    <h1 class="text-2xl font-semibold text-red-950 dark:text-white">Login</h1>
                </div>
                <form method="POST" action="/login">
                    @csrf
                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email / NISN')" />
                        <x-tail-text-input name="email" id="email" class="block mt-1 w-full" type="text" autofocus autocomplete="email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
            
                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />
            
                        <x-tail-text-input name="password" id="password" class="block mt-1 w-full"
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
                            <input name="remember" id="remember" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800">
                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                        </label>
                    </div>
            
                    <div class=" my-4">
                        
                        <x-tail-primary-button class="w-full flex justify-center">
                            {{ __('Log in') }}
                        </x-tail-primary-button>
                    </div>
                    @if (Route::has('password.request'))
                            <a class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                    @endif
                    
                    
                </form>
            </div>
            <div class=" hidden md:block relative col-span-2 bg-no-repeat bg-cover bg-[url('https://images.unsplash.com/photo-1618005198919-d3d4b5a92ead?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')] bg-gray-100 dark:bg-gray-700 bg-blend-multiply">
                <div class="absolute w-full top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-white dark:bg-gray-700 bg-opacity-25 p-10 backdrop-filter backdrop-blur-md text-center">
                    <h4 class="text-lg dark:text-white">Selamat Datang</h4>
                    <h3 class="text-2xl dark:text-white">di sistem informasi Akademik</h3>
                    <h1 class="text-7xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-pink-500 to-violet-500 mt-4">PESANTREN IMAM SYAFI'I</h1>
                </div>
            </div>
    
        </div>
    </x-guest-card>


</x-login-layout>
