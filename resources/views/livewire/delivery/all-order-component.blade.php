@section('title', 'All Order')

<div>
    
    <div class="my-ticket padding-bt">
        <div class="osahan-header-nav shadow-sm p-3 d-flex align-items-center bg-danger">
            <h5 class="font-weight-normal mb-0 text-white">
                <a wire:navigate class="text-danger mr-3" href="{{ route('home') }}"><i class="icofont-rounded-left"></i></a>
                Your Delivery Orders
            </h5>
            {{--            <div class="ml-auto d-flex align-items-center">--}}
            {{--                <a class="toggle osahan-toggle h4 m-0 text-white ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>--}}
            {{--            </div>--}}
        </div>
        
        <div class="your-ticket border-top row m-0 p-3">
            <div class="bg-white rounded-1 shadow-sm p-3 mb-3 w-100">
                <a wire:navigate class="btn btn-danger btn-block" href="{{ route('delivery-package') }}">
                    <i class="icofont-fast-delivery"></i> Deliver Package
                </a>
            </div>
            @foreach($packages as $package)
                <div class="bg-white rounded-1 shadow-sm p-3 mb-3 w-100">
{{--                    <a wire:navigate href="{{ route('view-ticket', $booking->payment->payment_id) }}">--}}
{{--                    <a href="#!">--}}
                        <div class="d-flex align-items-center mb-2">
                            <small class="text-muted">{{ $package->package_type }}</small>
                            <small class="text-success ml-auto f-10">
                                Package Size: {{ strtoupper($package->package_size) }}
                            </small>
                        </div>
                        <h6 class="mb-3 l-hght-18 font-weight-bold text-dark">
                            FROM {{ $package->package_sender_name . ' ('. $package->package_sender_phone . ')' }} TO {{ $package->package_receiver_name . ' ('. $package->package_receiver_phone . ')' }}
                        </h6>
{{--                    </a>--}}
                    <div class="row mx-0 mb-3">
                        <div class="col-6 p-0">
                            <small class="text-muted mb-1 f-10 pr-1">PACKAGE FROM</small>
                            <p class="small mb-0 l-hght-14"> {{ $package->package_from }}</p>
                        </div>
                        <div class="col-6 p-0">
                            <small class="text-muted mb-1 f-10 pr-1">TO</small>
                            <p class="small mb-0 l-hght-14"> {{ $package->package_to }}</p>
                        </div>
                    </div>
                    <div class="row mx-0">
                        <div class="col-6 p-0">
                            <small class="text-muted mb-1 f-10 pr-1">DATE OF SUBMISSION</small>
                            <p class="small mb-0 l-hght-14"> {{ date('d M, Y', strtotime($package->created_at)) }}</p>
                        </div>
                        <div class="col-6 p-0">
                            <small class="text-muted mb-1 f-10 pr-1">Track</small>
                            <p class="small mb-0 l-hght-14">
                                <a wire:navigate class="text-success font-weight-bold" href="{{ route('track-package', $package->id) }}">Track Package</a>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
</div>
