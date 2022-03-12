<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            
        </x-slot>

        <div class="card-body">
            <div class="d-flex justify-content-center">
                <img src="{{ asset('img/WLC_REGFORM_LOGO.png') }}" width="350">
            </div>
            
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <x-jet-label value="{{ __('Full Name') }}" />

                    <x-jet-input class="{{ $errors->has('full_name') ? 'is-invalid' : '' }}" type="text" name="full_name"
                                 :value="old('full_name')" />
                    <x-jet-input-error for="full_name"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    <x-jet-label value="{{ __('Email') }}" />

                    <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                                 :value="old('email')" />
                    <x-jet-input-error for="email"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    <x-jet-label value="{{ __('Cellphone Number') }}" />

                    <x-jet-input class="{{ $errors->has('cp_num') ? 'is-invalid' : '' }}" type="number" name="cp_num"
                                 :value="old('cp_num')" />
                    <x-jet-input-error for="cp_num"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    <x-jet-label value="{{ __('Endorsers ID') }}" />

                    <x-jet-input class="{{ $errors->has('endorsers_id') ? 'is-invalid' : '' }}" type="text" name="endorsers_id"
                                 :value="old('endorsers_id')" />
                    <x-jet-input-error for="endorsers_id"></x-jet-input-error>
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mb-3">
                        <div class="custom-control custom-checkbox">
                            <x-jet-checkbox id="terms" name="terms" />
                            <label class="custom-control-label" for="terms">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                            </label>
                        </div>
                    </div>
                @endif

                <div class="mb-0">
                    <div class="d-flex justify-content-end align-items-baseline">
                        <a class="text-muted me-3 text-decoration-none" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <x-jet-button>
                            {{ __('Register') }}
                        </x-jet-button>
                    </div>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>