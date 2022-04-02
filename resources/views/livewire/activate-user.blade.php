<div>
    <x-jet-dialog-modal class="modal-dialog-centered" wire:model="ModalFormVisible">
        <x-slot name="title">
            {{ __('Activate Code') }}
        </x-slot>

        <x-slot name="content">
            <div class="mb-3">
                <x-jet-label for="code" value="{{ __('Product Code') }}" />
                <x-jet-input id="code" type="text" class="{{ $errors->has('code') ? 'is-invalid' : '' }}"
                                wire:model="code" autofocus />
                <x-jet-input-error for="code" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('ModalFormVisible')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-button class="ms-2" wire:click="create" wire:loading.attr="disabled">
                {{ __('Submit') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
