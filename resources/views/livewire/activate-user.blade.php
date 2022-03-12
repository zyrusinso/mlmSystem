<div>
    <x-jet-dialog-modal class="modal-dialog-centered" wire:model="modalFormVisible">
        <x-slot name="title">
            {{ __('Activate Code') }}
        </x-slot>

        <x-slot name="content">
            <div class="mb-3">
                <x-jet-label for="product_code" value="{{ __('Product Code') }}" />
                <x-jet-input id="product_code" type="text" class="{{ $errors->has('product_code') ? 'is-invalid' : '' }}"
                                wire:model="product_code" autofocus />
                <x-jet-input-error for="product_code" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-button class="ms-2" wire:click="create" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
