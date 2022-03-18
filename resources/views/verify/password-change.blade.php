<div>
<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
        </x-slot>

        <div class="card-body">
            <div class="mb-3 small text-muted">
                {{ __('Thanks for signing up! Before we continue take the last step, by making your unique Password!') }}
            </div>

            <x-jet-validation-errors class="mb-3" />



            <form method="POST" action="{{ route('user.pass.update')}}">
                @csrf

                <div class="mb-3">
                    <x-jet-label value="{{ __('Password') }}" />

                    <x-jet-input class="{{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                                 name="password" required autocomplete="new-password" />
                    <x-jet-input-error for="password"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    <x-jet-label value="{{ __('Confirm Password') }}" />

                    <x-jet-input class="{{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" type="password"
                                 name="password_confirmation" required autocomplete="new-password" />
                    <x-jet-input-error for="password_confirmation"></x-jet-input-error>
                </div>

                <div>
                    <x-jet-button type="submit">
                        {{ __('Submit') }}
                    </x-jet-button>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
</div>
