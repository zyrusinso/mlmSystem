<div class="container">
    <div class="row justify-content-center my-5">
        @if (request()->is('register') || request()->is('login'))
            @if (request()->is('register'))
                <div class="col-sm-12 col-md-8 col-lg-5 my-4">
                    <div>
                        {{ $logo }}
                    </div>

                    <div class="card shadow-sm px-1 mx-4 my-5">
                        {{ $slot }}
                    </div>
                </div>
            @endif
            @if (request()->is('login'))
                <div class="col-sm-12 col-md-8 col-lg-8 my-4">
                    <div>
                        {{ $logo }}
                    </div>
                    
                    <div class="card shadow-lg px-1 mx-4 my-5 ">
                        {{ $slot }}
                    </div>
                </div>
            @endif
        @else
            <div class="col-sm-12 col-md-8 col-lg-8 my-4">
                <div>
                    {{ $logo }}
                </div>
                
                <div class="card shadow-lg px-1 mx-4 my-5 ">
                    {{ $slot }}
                </div>
            </div>
        @endif
    </div>
</div>