<div>
    <div>
        @include('content-header', ['headerTitle' => $TitleHeader."'s".' Team'])
        <div class="card">
            @if (session()->has('showLimit'))
                <div>
                    <div class="alert alert-danger text-center">
                        {{ __('You cant view more') }}
                    </div>
                </div>
            @endif

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
                                            <td></th>
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
        </div>
    </div>
</div>
