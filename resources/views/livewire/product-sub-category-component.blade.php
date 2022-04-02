<div>
    @include('content-header', ['headerTitle' => 'Product Sub Category'])
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
                                    <th>Main Category</th>
                                    <th>Sub Category Name</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @if ($data->count())
                                @foreach ($data as $item)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ \App\Models\ProductSubCategory::mainProductCategoryList()[$item->category_id] ?? '' }}</td>
                                        <td>{{ $item->sub_cat_name ?? '' }}</td>
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
                {{ __('Product Sub Category') }}
            </x-slot>

            <x-slot name="content">
                <div class="form-group">
                    <label>Select Main Category</label>
                    <select wire:model="main_category" class="form-control">
                        @if (count(App\Models\ProductSubCategory::mainProductCategoryList()) > 1)
                            <option>-- Select a Main Category --</option>
                            @foreach(App\Models\ProductSubCategory::mainProductCategoryList() as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        @else
                            <option>-- You Need to Create Main Category First --</option>
                        @endif
                    </select>
                    @error('main_category') <span class="error" style="color: red"">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <x-jet-label for="sub_cat_name" value="{{ __('Sub Category Name') }}" />
                    <x-jet-input id="sub_cat_name" type="text" class="{{ $errors->has('sub_cat_name') ? 'is-invalid' : '' }}"
                                 wire:model.lazy="sub_cat_name" autofocus />
                    <x-jet-input-error for="sub_cat_name" />
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
                        {{ __('Save') }}
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
