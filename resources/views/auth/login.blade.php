<x-guest-layout>



	<div class="d-flex justify-content-center mt-5">
		<div class="login-box">
	
			<div class="card">

                <div class="card-header">
                    <h4 class="title">Login</h4>
                </div>
                <div class="card-body">
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                
                        <div>
                            <x-text-input id="email" class="" type="email" name="email" label="Email" :value="old('email')" required autofocus autocomplete="username" placeholder="Email" :messages="$errors->get('email')"/>
                        </div>
                        <div>
                            <x-text-input id="password"
                                class=""
                                type="password"
                                name="password"
                                label="Password"
                                placeholder="password"
                                :messages="$errors->get('password')"/>
                        </div>

                        <!-- Remember Me -->
                        <div class="block mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>
                        </div>
                
                        <div class="d-flex align-items-center justify-content-between mt-4">
                            @if (Route::has('password.request'))
                            <a class="text-muted" href="{{ route('password.request') }}">
                                {{ __('Lupa Password?') }}
                            </a>
                            @endif
                
                            <x-primary-button class="ms-3 btn-success">
                                {{ __('Log in') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
                
			</div>
		</div>

	</div>



</x-guest-layout>
