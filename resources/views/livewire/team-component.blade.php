<div>
    @include('content-header', ['headerTitle' => 'Team'])

    <div class="row mt-3">
        <div class="col-md-3 col-sm-6 col-6">
            <div class="info-box bg-primary" style="border-radius: 30px !important;">
                <div class="info-box-icon" style="width: 45px;">
                    <span class="info-box-icon" ><i class="fas fa-user-plus"></i></span>
                </div>
                <div class="info-box-content text-center">
                    <span class="info-box-number" style="font-size: 25px">Penny <i class="fas fa-eye" style="font-size: 15px"></i></span>
                    <div class="progress">
                        <hr/>
                    </div>
                    <span class="progress-description">
                        Newest Member
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-6">
            <div class="info-box bg-orange" style="color: white !important;border-radius: 30px !important;">
                <div class="info-box-icon" style="width: 45px;">
                    <span class="info-box-icon" ><i class="fas fa-user-tie"></i></span>
                </div>
                <div class="info-box-content text-center">
                    <span class="info-box-number" style="font-size: 25px">Peter <i class="fas fa-eye" style="font-size: 15px"></i></span>
                    <div class="progress">
                        <hr/>
                    </div>
                    <span class="progress-description">
                        Top Team Endorser
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-6">
            <div class="info-box bg-info" style="border-radius: 30px !important; background-color: #4B0082 !important;">
                <div class="info-box-icon" style="width: 45px;">
                    <span class="info-box-icon" ><i class="fas fa-crown"></i></span>
                </div>
                <div class="info-box-content text-center">
                    <span class="info-box-number" style="font-size: 25px">Thanos <i class="fas fa-eye" style="font-size: 15px"></i></span>
                    <div class="progress">
                        <hr/>
                    </div>
                    <span class="progress-description">
                        Top Team Earner
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-6">
            <div class="info-box bg-success" style="border-radius: 30px !important;">
                <div class="info-box-icon" style="width: 45px;">
                    <span class="info-box-icon" ><i class="fas fa-user-friends"></i></span>
                </div>
                <div class="info-box-content text-center">
                    <span class="info-box-number" style="font-size: 30px">150</span>
                    <div class="progress">
                        <hr/>
                    </div>
                    <span class="progress-description">
                        Team Members
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-3 col-sm-6 col-12 text-center">
            <div class="info-box bg-gradient-success">
                <div class="info-box-content">
                    <span class="info-box-text" style="font-size: 13px">Product Users</span>
                    <span class="info-box-number" style="font-size: 25px; ">100</span>
                    <div class="progress">
                        <hr/>
                    </div>
                    <span class="progress-description">
                        <a href="#" class="small-box-footer text-white" style="text-decoration: none !important">
                        <i class="fas fa-users"></i> View List <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12 text-center">
            <div class="info-box bg-gradient-info">
                <div class="info-box-content">
                    <span class="info-box-text" style="font-size: 13px">Product Endorsers</span>
                    <span class="info-box-number" style="font-size: 25px; ">10</span>
                    <div class="progress">
                        <hr/>
                    </div>
                    <span class="progress-description">
                        <a href="#" class="small-box-footer text-white" style="text-decoration: none !important">
                        <i class="fas fa-users"></i> View List <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12 text-center">
            <div class="info-box bg-gradient-success">
                <div class="info-box-content">
                    <span class="info-box-text" style="font-size: 13px">Business Endorsers</span>
                    <span class="info-box-number" style="font-size: 25px; ">40</span>
                    <div class="progress">
                        <hr/>
                    </div>
                    <span class="progress-description">
                        <a href="#" class="small-box-footer text-white" style="text-decoration: none !important">
                        <i class="fas fa-users"></i> View List <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-gradient-info">
                <div class="info-box-content text-center">
                    <span class="info-box-text">Current Rank</span>
                    <span class="info-box-number" style="font-size: 35px">GOLD</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="d-flex justify-content-end mb-2">
                        <!-- <button class="btn btn-dark mr-3" wire:click="createShowModal">Create</button> -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table id="example1" class="table table-bordered table-hover dataTable dtr-inline table-responsive-sm">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Membership</th>
                                    <th>CP</th>
                                    <th>PE</th>
                                    <th>BE</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @if ($data->count())
                                @foreach ($data as $item)
                                    <tr class="cursor-pointer" wire:click="TeamView({{ $item->id }})">
                                        <td>{{ $item->endorsers_id }}</th>
                                        <td>{{ $item->full_name }}</th>
                                        <td></td>
                                        <td>{{ $item->cp_num }}</td>
                                        <td>{{ count($this->PEdata($item->endorsers_id)) }}</td>
                                        <td>{{ count($this->BEdata($item->endorsers_id)) }}</td>
                                        <td>

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
                {{ __('Title') }}
            </x-slot>

            <x-slot name="content">
                <!-- <div class="mb-3">
                    <x-jet-label for="" value="{{ __('Example') }}" />
                    <x-jet-input id="" type="text" class="{{ $errors->has('') ? 'is-invalid' : '' }}"
                                 wire:model="" autofocus />
                    <x-jet-input-error for="" />
                </div> -->
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
