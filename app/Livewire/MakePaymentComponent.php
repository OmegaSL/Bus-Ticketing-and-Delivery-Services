<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\Flutterwave\Rave as Flutterwave;

class MakePaymentComponent extends Component
{
    public $bus_number;
    public $bus;
    public $selectedSeats = [];
    public $reference;

    public function mount($bus_number)
    {
        $this->reference = Flutterwave::generateReference();
        // get url segments
        //		 dd(request()->segments());

        // convert url second segment to array
        $this->selectedSeats = explode(',', request()?->segments()[2]);
        //		 dd(explode(',', request()?->segments()[2]));

        $this->bus_number = $bus_number;

        $this->bus = \App\Models\Bus::query()
            ->with('bus_histories', function ($query) {
                $query->latest();
            })
            ->where('bus_number', $this->bus_number)
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.make-payment-component')->extends('layouts.master');
    }

    public function initiatePayment()
    {
        // dd($this->selectedSeats);
        $this->selectedSeats = implode(',', $this->selectedSeats ?? []);
        //		dd($this->selectedSeats);

        if (empty($this->selectedSeats)) {
            toastr()->error('Please select at least one seat');
            return redirect()->route('bus-seats', $this->bus_number);
        }

        $data = [
            'amount' => $this->bus->bus_route_price,
            'email' => auth()->user()->email,
            'phone' => auth()->user()->phone_number,
            'name' => auth()->user()->name,
            'reference' => $this->reference,
            'seats' => $this->selectedSeats,
            'bus_number' => $this->bus_number,
            'departure_station' => $this->bus->bus_histories?->first()->currentStation?->id ?? 'N/A',
            'arrival_station' => $this->bus->bus_histories?->first()->lastStation?->id ?? 'N/A',
        ];

        // make flutterwave payment here
        return $this->flutterwavePayment($data);
    }

    public function flutterwavePayment($data)
    {
        // Enter the details of the payment
        $data = [
            'payment_options' => 'mobile_money',
            'amount' => $data['amount'],
            'email' => $data['email'],
            'tx_ref' => $data['reference'],
            'currency' => "GHS",
            'redirect_url' => route('callback'),
            'customer' => [
                'email' => $data['email'],
                "phone_number" => $data['phone'],
                "name" => $data['name']
            ],
            "customizations" => [
                "title" => "Bus Ticket Payment",
                "description" => "Payment for bus ticket",
                "logo" => asset('assets/img/logo.png')
            ],
            "meta" => [
                "seats" => $data['seats'],
                "bus_number" => $data['bus_number'],
                "departure_station" => $data['departure_station'],
                "arrival_station" => $data['arrival_station'],
            ],
        ];

        $payment = new Flutterwave();
        $payment = $payment->initializePayment($data);

        if ($payment['status'] !== 'success') {
            // notify something went wrong
            toastr()->error('Something went wrong, please try again');
            return redirect()->route('make-payment', $this->bus->bus_number)->with('error', 'Something went wrong. ' . $payment['message']);
        }

        return redirect($payment['data']['link']);
    }
}
