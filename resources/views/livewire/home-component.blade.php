<div>
    @include('content-header', ['headerTitle' => "Dashboard"])

    <div class="row mt-3">
        <div class="col-md-3 col-sm-6 col-6">
            <div class="info-box bg-primary" style="border-radius: 30px !important;">
                <div class="info-box-icon" style="width: 45px;">
                    <span class="info-box-icon" ><i class="fas fa-user-friends"></i></span>
                </div>
                <div class="info-box-content text-center">
                    <span class="info-box-number" style="font-size: 30px">{{ count($this->networkListData(auth()->user()->endorsers_id))-1 ?? '0'}}</span>
                    <div class="progress">
                        <hr/>
                    </div>
                    <span class="progress-description">
                        Team Members
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-6">
            <div class="info-box bg-orange" style="color: white !important;border-radius: 30px !important;">
                <div class="info-box-icon" style="width: 45px;">
                    <span class="info-box-icon" ><i class="fas fa-money-bill-alt"></i></span>
                </div>
                <div class="info-box-content text-center">
                    <span class="info-box-number" style="font-size: 30px">100,000</span>
                    <div class="progress">
                        <hr/>
                    </div>
                    <span class="progress-description">
                        Total Cash Bonus
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
                    <span class="info-box-number" style="">COMING <br/>SOON</span>
                    <div class="progress">
                        <hr/>
                    </div>
                    <span class="progress-description">
                        Available Reward Points
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-6">
            <div class="info-box bg-success" style="border-radius: 30px !important;">
                <div class="info-box-icon" style="width: 45px;">
                    <span class="info-box-icon" ><i class="fas fa-piggy-bank"></i></span>
                </div>
                <div class="info-box-content text-center">
                    <span class="info-box-number" style="font-size: 30px">10,000</span>
                    <div class="progress">
                        <hr/>
                    </div>
                    <span class="progress-description">
                        Available Cash Balance
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
                    <span class="info-box-number" style="font-size: 25px; ">{{ count($this->PUdata(auth()->user()->endorsers_id)) ?? '0' }}</span>
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
                    <span class="info-box-number" style="font-size: 25px; ">{{ count($this->PEdata(auth()->user()->endorsers_id)) ?? '0' }}</span>
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
                    <span class="info-box-number" style="font-size: 25px; ">{{ count($this->BEdata(auth()->user()->endorsers_id)) ?? '0' }}</span>
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
                    <span class="info-box-number" style="font-size: 25px">COMING SOON</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-12">
            <table class="table table-bordered table-responsive-sm" border="1">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Membership</th>
                        <th scope="col">Contact Number</th>
                        <th scope="col">PU</th>
                        <th scope="col">PE</th>
                        <th scope="col">BE</th>
                    </tr>
                </thead>
                <tbody id="tableList">
                    @foreach ($data as $item)
                        <tr>
                            <th scope="row">{{ $item->endorsers_id }}</th>
                            <td>{{ $item->full_name }}</td>
                            <td>{{ \App\Models\User::userRoleList()[$item->role] }}</td>
                            <td>{{ $item->cp_num }}</td>
                            <td>{{ count($this->PUdata($item->endorsers_id)) ?? '0' }}</td>
                            <td>{{ count($this->PEdata($item->endorsers_id)) ?? '0' }}</td>
                            <td>{{ count($this->BEdata($item->endorsers_id)) ?? '0'}}</td>
                        </tr>
                    @endforeach
                        <tr>
                            <td colspan="7">{{ $data->links('vendor.livewire.simple-bootstrap') }}</td>
                        </tr>   
                </tbody>
            </table>
        </div>
    </div>
</div>