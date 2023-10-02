@section('title', 'My Tickets')

<div>
    
    <div class="my-ticket padding-bt">
        <div class="osahan-header-nav shadow-sm p-3 d-flex align-items-center bg-danger">
            <h5 class="font-weight-normal mb-0 text-white">
                <a wire:navigate class="text-danger mr-3" href="{{ route('home') }}"><i class="icofont-rounded-left"></i></a>
                Your Tickets
            </h5>
{{--            <div class="ml-auto d-flex align-items-center">--}}
{{--                <a class="toggle osahan-toggle h4 m-0 text-white ml-auto" href="#"><i class="icofont-navigation-menu"></i></a>--}}
{{--            </div>--}}
        </div>
        
        <div class="your-ticket border-top row m-0 p-3">
            
            @foreach($bookings as $booking)
                <div class="bg-white rounded-1 shadow-sm p-3 mb-3 w-100">
                    <a wire:navigate href="{{ route('view-ticket', $booking->payment->payment_id) }}">
                        <div class="d-flex align-items-center mb-2">
                            <small class="text-muted">{{ $booking->bus?->bus_type }}</small>
                            <small class="text-success ml-auto f-10">
                                {{ strtoupper($booking->booking_status) }}
                            </small>
                        </div>
                        <h6 class="mb-3 l-hght-18 font-weight-bold text-dark">
                            {{ auth()->user()->name }} Travellers ISO 9002 - {{ date('Y') }} Certified
                        </h6>
                    </a>
                    <div class="row mx-0 mb-3">
                        <div class="col-6 p-0">
                            <small class="text-muted mb-1 f-10 pr-1">GOING FROM</small>
                            <p class="small mb-0 l-hght-14"> {{ $booking->booking_from }}</p>
                        </div>
                        <div class="col-6 p-0">
                            <small class="text-muted mb-1 f-10 pr-1">TO</small>
                            <p class="small mb-0 l-hght-14"> {{ $booking->booking_to }}</p>
                        </div>
                    </div>
                    <div class="row mx-0">
                        <div class="col-6 p-0">
                            <small class="text-muted mb-1 f-10 pr-1">DATE OF JOURNEY</small>
                            <p class="small mb-0 l-hght-14"> {{ date('d M, Y', strtotime($booking->departure_date_time)) }}</p>
                        </div>
                        <div class="col-6 p-0">
                            <small class="text-muted mb-1 f-10 pr-1">YOU RATED</small>
                            <p class="small mb-0 l-hght-14"> <a class="text-success font-weight-bold" href="#!">RATE NOW</a></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
</div>
