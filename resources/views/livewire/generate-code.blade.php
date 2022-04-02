<div>
    @include('content-header', ['headerTitle' => 'Codes'])
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="d-flex justify-content-between mb-2">
                        <div class="form-group d-flex ">
                            <div class="form-check mr-2">
                                <input class="form-check-input" wire:click="availableCodes" type="checkbox" checked="">
                                <label class="form-check-label">Available Codes</label>
                            </div>
                            <div class="form-check mr-2">
                                <input class="form-check-input" wire:click="usedCodes" type="checkbox" checked="" >
                                <label class="form-check-label">Used Codes</label>
                            </div>
                        </div>
                        <button class="btn btn-dark mr-3" wire:click="createShowModal">Generate more Codes</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline table-responsive-sm table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Status</th>
                                    <th>Generated Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @if ($data->count())
                                @foreach ($data as $item)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $item->product_name }}</td>
                                        <td>{{ ($item->status == 'Not Used')? 'Not Used' : \Carbon\Carbon::parse($item->date_used)->format("F j, Y, g:i a")}}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format("F j, Y, g:i a") }}</td>
                                        <td class="text-center text-sm">
                                            <button class="btn btn-info btn-sm" wire:click="sendShowModal({{ $item->id }})">
                                                Send to Buyer
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
                {{ __('Generate Code') }}
            </x-slot>

            <x-slot name="content">
                <div class="mb-3">
                    <div class="form-group">
                        <label>Select Product Code Type</label>
                        <select wire:model="productCodeType" class="form-control">
                            <option value="">-- Select a Product Type --</option>
                            <option value="solo">Single Product</option>
                            <option value="bundle">Bundle Product</option>
                        </select>
                        @error('productCodeType') <span class="error" style="color: red"">{{ $message }}</span> @enderror
                    </div>
                    @if ($productCodeType != '')
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
                        @if ($selectedCategory)
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
                        @endif
                        @if ($selectedSubCategory)
                            <div class="mb-3">
                                <div class="form-group">
                                    <label>Product</label>
                                    <select wire:model="selectedProduct" class="form-control">
                                        <option>-- Select a Sub Category --</option>
                                        @foreach(App\Models\Product::productListOfSubCategory($selectedCategory, $selectedSubCategory) as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('selectedProduct') <span class="error" style="color: red"">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
                <!-- if -->
                    <!-- <div class="mb-3">
                        <x-jet-label for="" value="{{ __('Name') }}" />
                        <x-jet-input id="" type="text" class="{{ $errors->has('') ? 'is-invalid' : '' }}"
                                    wire:model="" autofocus />
                        <x-jet-input-error for="" />
                    </div> -->
                @if ($selectedProduct && $productCodeType == 'bundle')
                    <!-- <div class="mb-3">
                        <x-jet-label for="bundle_name" value="{{ __('Bundle Name') }}" />
                        <x-jet-input id="bundle_name" type="text" class="{{ $errors->has('bundle_name') ? 'is-invalid' : '' }}"
                                    wire:model="bundle_name" autofocus />
                        <x-jet-input-error for="bundle_name" />
                    </div> -->
                    <div class="mb-3">
                        <x-jet-label for="code_quantity" value="{{ __('How Many Codes To Generate?') }}" />
                        <x-jet-input id="code_quantity" type="text" class="{{ $errors->has('code_quantity') ? 'is-invalid' : '' }}"
                                    wire:model="code_quantity" autofocus />
                        <x-jet-input-error for="code_quantity" />
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
                        {{ __('Generate') }}
                    </x-jet-button>
                @endif
            </x-slot>
        </x-jet-dialog-modal>

        <x-jet-dialog-modal wire:model="modalBuyerFormVisible" maxWidth="lg">
            <x-slot name="title">
                {{ __('Buyers Information') }}
            </x-slot>

            <x-slot name="content">
                <div class="row">
                    <div class="col-8 col-lg-4 offset-2 offset-lg-4">
                        <div class="mb-3">
                            <div class="form-group">
                                <label>Select Buyers Type</label>
                                <select wire:model="buyerType" class="form-control">
                                    <option value="">-- Select a buyer type --</option>
                                    <option value="members">Members</option>
                                    <option value="non-members">Non-Members</option>
                                </select>
                                @error('buyerType') <span class="error" style="color: red"">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @if ($buyerType == 'members')
                        <div class="col-8 col-lg-4 offset-2 offset-lg-4">
                            <div class="mb-3" style="width: 100%">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" wire:model="endorsers_id" placeholder="Search for members ID">
                                    <div class="input-group-append" wire:click="searchMember">
                                        <div class="btn btn-primary">
                                            <i class="fas fa-search"></i>
                                        </div>
                                    </div>
                                </div>
                                @error('endorsers_id') <span class="error" style="color: red"">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    @endif
                </div>
                <div class="row justify-content-center">
                    @if ($buyersForm == true)
                        <div class="col-12 col-xl-4">
                            <div class="mb-3">
                                <x-jet-label for="buyerFName" value="{{ __('First Name') }}" />
                                <x-jet-input id="buyerFName" type="text" class="{{ $errors->has('buyerFName') ? 'is-invalid' : '' }}"
                                            wire:model="buyerFName" autofocus />
                                <x-jet-input-error for="buyerFName" />
                            </div>
                        </div>
                        <div class="col-12 col-xl-4">
                            <div class="mb-3">
                                <x-jet-label for="buyerMName" value="{{ __('Middle Name') }}" />
                                <x-jet-input id="buyerMName" type="text" class="{{ $errors->has('buyerMName') ? 'is-invalid' : '' }}"
                                            wire:model="buyerMName" autofocus />
                                <x-jet-input-error for="buyerMName" />
                            </div>
                        </div>
                        <div class="col-12 col-xl-4">
                            <div class="mb-3">
                                <x-jet-label for="buyerLName" value="{{ __('Last Name') }}" />
                                <x-jet-input id="buyerLName" type="text" class="{{ $errors->has('buyerLName') ? 'is-invalid' : '' }}"
                                            wire:model="buyerLName" autofocus />
                                <x-jet-input-error for="buyerLName" />
                            </div>
                        </div>
                        <div class="col-12 col-xl-6">
                            <div class="mb-3">
                                <x-jet-label for="buyerAddress" value="{{ __('Address') }}" />
                                <x-jet-input id="buyerAddress" type="text" class="{{ $errors->has('buyerAddress') ? 'is-invalid' : '' }}"
                                            wire:model="buyerAddress" autofocus />
                                <x-jet-input-error for="buyerAddress" />
                            </div>
                        </div>
                        <div class="col-12 col-xl-6">
                            <div class="mb-3">
                                <x-jet-label for="buyerCP" value="{{ __('CP Number') }}" />
                                <x-jet-input id="buyerCP" type="text" class="{{ $errors->has('buyerCP') ? 'is-invalid' : '' }}"
                                            wire:model="buyerCP" autofocus />
                                <x-jet-input-error for="buyerCP" />
                            </div>
                        </div>
                        <div class="col-12 col-xl-6">
                            <div class="mb-3">
                                <x-jet-label for="buyerEmail" value="{{ __('Email Address') }}" />
                                <x-jet-input id="buyerEmail" type="text" class="{{ $errors->has('buyerEmail') ? 'is-invalid' : '' }}"
                                            wire:model="buyerEmail" autofocus />
                                <x-jet-input-error for="buyerEmail" />
                            </div>
                        </div>
                    @endif
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('modalBuyerFormVisible')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>

                <x-jet-button class="ms-2" wire:click="submitBuyerInfo" wire:loading.attr="disabled">
                    {{ __('Submit') }}
                </x-jet-button>
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
