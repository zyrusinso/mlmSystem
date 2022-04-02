<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
        </x-slot>

        <div class="card-body">
            <div class="row">
                <div class="col-xl-6 d-none d-none d-lg-block">
                    <img src="{{ asset('img/WLC_LOGINFORM.png') }}" width="350">
                </div>
                <div class="col-xl-6 my-auto">
                    <h1 class="d-flex justify-content-center">LOGIN</h1>
                    <x-jet-validation-errors class="mb-3 rounded-0" />
                    
                    @if (session('status'))
                        <div class="alert alert-success mb-3 rounded-0" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <x-jet-label value="{{ __('Email or ID') }}" />

                            <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="text"
                                        name="email" :value="old('email')" />
                        </div>

                        <div class="mb-3">
                            <x-jet-label value="{{ __('Password') }}" />

                            <x-jet-input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password"
                                        name="password" autocomplete="current-password" />
                        </div>

                        <div class="mb-3">
                            <div class="custom-control custom-checkbox">
                                <x-jet-checkbox id="remember_me" name="remember" />
                                <label class="custom-control-label" for="remember_me">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>

                        <div class="mb-0">
                            <div class="d-flex justify-content-end align-items-baseline">
                                @if (Route::has('password.request'))
                                    <!-- <a class="text-muted me-3" href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a> -->
                                @endif
                                <a class="text-muted me-3 text-decoration-none d-flex justify-content-center mt-5" href="{{ route('register') }}">
                                    {{ __('Not have an Account?') }}
                                </a>

                                <x-jet-button>
                                    {{ __('Log in') }}
                                </x-jet-button>
                            </div>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>