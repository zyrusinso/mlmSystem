<div>
    @include('content-header', ['headerTitle' => 'Products'])
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
                    {{ count(\App\Models\ProductSubCategory::productSubCategory()) }}
                    <div class="col-sm-12">
                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline table-responsive-sm">
                            <thead>
                                <tr>
                                    <th>Product Category</th>
                                    <th>Product Sub Category</th>
                                    <th>Product Name</th>
                                    <th>Description</th>
                                    <th>Packaging</th>
                                    <th>Price</th>
                                    <th>SRP</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @if ($data->count())
                                @foreach ($data as $item)
                                    <tr>
                                        <th>{{ \App\Models\ProductSubCategory::mainProductCategoryList()[$item->category_id] ?? ''}}</th>
                                        <td>{{ \App\Models\ProductSubCategory::subCategoryOfMainCategory($item->category_id)[$item->sub_category_id] ?? '' }}</td>
                                        <td>{{ $item->product_name }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->packaging }}</td>
                                        <td>{{ $item->raw_price }}</td>
                                        <td>{{ $item->srp }}</td>
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
        <x-jet-dialog-modal wire:model="modalFormVisible" maxWidth="lg">
            <x-slot name="title">
                {{ __('Product') }}
            </x-slot>

            <x-slot name="content">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-4">
                        <div class="mb-3">
                            <div class="form-group">
                                <label>Category</label>
                                <select wire:model="selectedCategory" class="form-control">
                                    <option>-- Select a Main Category --</option>
                                    @foreach(App\Models\ProductSubCategory::mainProductCategoryList() as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                                @error('selectedCategory') <span class="error" style="color: red"">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    @if ($subCategoryForm)
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <div class="form-group">
                                    <label>Sub-Category</label>
                                    <select wire:model="selectedSubCategory" class="form-control">
                                        <option>-- Select a Sub Category --</option>
                                        @foreach(App\Models\ProductSubCategory::subCategoryOfMainCategory($selectedCategory) as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('selectedSubCategory') <span class="error" style="color: red"">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                @if ($productForm)
                    <div class="row justify-content-center">
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <x-jet-label for="product_name" value="{{ __('Product Name') }}" />
                                <x-jet-input id="product_name" type="text" class="{{ $errors->has('product_name') ? 'is-invalid' : '' }}"
                                            wire:model.lazy="product_name" />
                                <x-jet-input-error for="product_name" />
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" rows="3" placeholder="" id="description" wire:model.lazy="description"></textarea>
                                </div>
                            </div>
                            @error('description') <span class="error" style="color: red"">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <x-jet-label for="packaging" value="{{ __('Packaging') }}" />
                                <div class="row">
                                    <div class="col-2 col-lg-2" style="padding-right: 0px;">
                                        <select wire:model="packageType" class="form-control">
                                                <option value="kg">kg</option>
                                                <option value="bottles">bottles</option>
                                                <option value="Pack">Pack</option>
                                                <option value="Box">Box</option>
                                            </select>
                                    </div>
                                    <div class="col-10 col-lg-10" style="padding-left: 0px;">
                                        <x-jet-input id="packaging" type="text" class="{{ $errors->has('packaging') ? 'is-invalid' : '' }}"
                                                wire:model.lazy="packaging" placeholder="quantity" />
                                        </div>
                                    <x-jet-input-error for="packaging" />
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <x-jet-label for="price" value="{{ __('Raw Price') }}" />
                                <x-jet-input id="price" type="text" class="{{ $errors->has('price') ? 'is-invalid' : '' }}"
                                            wire:model.lazy="price" />
                                <x-jet-input-error for="price" />
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <x-jet-label for="srp" value="{{ __('SRP') }}" />
                                <x-jet-input id="srp" type="text" class="{{ $errors->has('srp') ? 'is-invalid' : '' }}"
                                            wire:model.lazy="srp" />
                                <x-jet-input-error for="srp" />
                            </div>
                        </div>
                    </div>
                @endif
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
