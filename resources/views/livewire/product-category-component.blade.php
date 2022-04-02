<div>
    @include('content-header', ['headerTitle' => 'Product Category'])
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="d-flex justify-content-end mb-2">
                        <button class="btn btn-dark mr-3" wire:click="createShowModal">Create</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline table-responsive-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category Name</th>
                                    <th>Initial Name</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @if ($data->count())
                                @foreach ($data as $item)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $item->category_name }}</td>
                                        <td>{{ $item->category_initial }}</td>
                                        <td class="text-center text-sm">
                                            <button class="btn btn-dark btn-sm" wire:click="updateShowModal({{ $item->id }})">
                                                Update
                                            </button>
                                            <button class="btn btn-danger text-white btn-sm" wire:click="deleteShowModal({{ $item->id }})">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="10">No Results Found</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="d-flex justify-content-center">
        {{ $data->links('vendor.livewire.bootstrap') }}
        </div>

        <!-- Create & Update Modal -->
        <x-jet-dialog-modal wire:model="modalFormVisible">
            <x-slot name="title">
                {{ __('Product Category') }}
            </x-slot>

            <x-slot name="content">
                <div class="mb-3">
                    <x-jet-label for="category_name" value="{{ __('Name') }}" />
                    <x-jet-input id="category_name" type="text" class="{{ $errors->has('category_name') ? 'is-invalid' : '' }}"
                                 wire:model.lazy="category_name" autofocus />
                    <x-jet-input-error for="category_name" />
                </div>
                <div class="mb-3">
                    <x-jet-label for="category_initial" value="{{ __('Initial Name') }}" /><span style="font-size: 11px !important;">(first 3 initial letters of category)</span>
                    <x-jet-input id="category_initial" type="text" class="{{ $errors->has('category_initial') ? 'is-invalid' : '' }}"
                                 wire:model.lazy="category_initial" autofocus maxlength="3" oninput="this.value = this.value.toUpperCase()"/>
                    <x-jet-input-error for="category_initial" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                @if ($modelId)
                    <x-jet-button class="ms-2" wire:click="update" wire:loading.attr="disabled">
                        {{ __('Update') }}
                    </x-jet-button>
                @else
                    <x-jet-button class="ms-2" wire:click="create" wire:loading.attr="disabled">
                        {{ __('Create') }}
                    </x-jet-button>
                @endif
            </x-slot>
        </x-jet-dialog-modal>

        <!-- Delete User Confirmation Modal -->
        <x-jet-dialog-modal wire:model="modalConfirmDeleteVisible">
            <x-slot name="title">
                {{ __('Delete Title') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you want to delete this transanction? Once the transaction is deleted, all of its resources and data will be permanently deleted.') }}
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('modalConfirmDeleteVisible')"
                                        wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                <x-jet-danger-button wire:click="delete" wire:loading.attr="disabled">
                    <div wire:loading wire:target="delete" class="spinner-border spinner-border-sm" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>

                    {{ __('Delete Account') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>
    </div>
</div>
