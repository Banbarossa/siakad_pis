<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-text-input id="email" class="" type="email" name="email" label="Email" :value="old('email', $request->email)" required autofocus autocomplete="username" placeholder="Email" :messages="$errors->get('email')"/>

            {{-- <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" /> --}}
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-text-input id="password"
                                class=""
                                type="password"
                                name="password"
                                label="Password"
                                placeholder="password"
                                required autocomplete="new-password"
                                :messages="$errors->get('password')"/>

            {{-- <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" /> --}}
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-text-input id="password"
                                class=""
                                type="password"
                                name="password_confirmation"
                                label="Password Konfirmasi"
                                placeholder="password"
                                required autocomplete="new-password"
                                :messages="$errors->get('password_confirmation')"/>
            {{-- <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" /> --}}
        </div>

        <div class="d-flex align-items-center justify-content-end mt-4">
            <button type="submit" class="btn btn-primary">{{ __('Reset Password') }}</button>
        </div>
    </form>
</x-guest-layout>
