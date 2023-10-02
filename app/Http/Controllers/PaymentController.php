<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Flutterwave\Rave as Flutterwave;

class PaymentController extends Controller
{
	protected $flutterwave;

	public function __construct()
	{
		$this->flutterwave = new Flutterwave();
	}

    public function payment_success($payment_id)
    {
        // get transaction details
        $payment = \App\Models\Payment::query()
            ->where('payment_id', $payment_id)
            ->first();
//		dd('Your Payment was successfull', $payment);

        return redirect()->route('view-ticket', $payment->payment_id)->with('success', 'Your Payment was successfull');
    }

    public function callback()
    {
        $status = request()->status;

        //if payment is successful
        if ($status ==  'successful') {

	        $transactionID = $this->flutterwave->getTransactionIDFromCallback();
	        $data = $this->flutterwave->verifyTransaction($transactionID);
	        $bus = \App\Models\Bus::query()->where('bus_number', $data['data']['meta']['bus_number'])->first();
			$getSeat = explode(',', $data['data']['meta']['seats']);
	        $seat = \App\Models\Seat::query()->where('bus_id', $bus->id)->whereIn('seat_number', $getSeat)->get();

			$booking = new \App\Models\Booking();
			$booking->user_id = auth()->user()->id;
			$booking->bus_id = $bus->id;
			$booking->departure_station_id = $data['data']['meta']['departure_station'];
			$booking->arrival_station_id = $data['data']['meta']['arrival_station'];
			$booking->booking_from = $bus->bus_route_from;
			$booking->booking_to = $bus->bus_route_to;
			$booking->booking_amount = $data['data']['amount'];
			$booking->booking_type = 'online';
			$booking->booking_status = 'paid';
			$booking->departure_date_time = $bus->bus_histories->first()->departure_date_time;
			$booking->save();

			$payment = new \App\Models\Payment();
			$payment->booking_id = $booking->id;
			$payment->payment_method = 'flutterwave';
			$payment->payment_status = 'successful';
			$payment->payment_amount = $data['data']['amount'];
			$payment->payment_currency = $data['data']['currency'];
			$payment->payment_id = $data['data']['id'];
			$payment->save();

	        foreach ($seat as $seat) {
				$seat_allocation = new \App\Models\SeatAllocation();
				$seat_allocation->booking_id = $booking->id;
				$seat_allocation->seat_id = $seat->id;
				$seat_allocation->driver_id = $bus->bus_histories->first()?->bus_driver_id ?? 1;
				$seat_allocation->seat_type = 'lower';
				$seat_allocation->save();

				// update bus seat
//				$seat = \App\Models\Seat::query()->where('bus_id', $bus->id)->get();
//				$seat->each(function ($seat) {
					$seat->update([
						'seat_status' => 'Booked',
					]);
//				});
			}

            return redirect()->route('completed-payment', $payment->payment_id)->with('success', 'Transaction successful');
        } elseif ($status == 'cancelled') {
            //Put desired action/code after transaction has been cancelled here
            return redirect()->back()->with('error', 'Transaction cancelled');
        } else {
            //Put desired action/code after transaction has failed here
            return redirect()->back()->with('error', 'Transaction failed');
        }
        // Get the transaction from your DB using the transaction reference (txref)
        // Check if you have previously given value for the transaction. If you have, redirect to your successpage else, continue
        // to Confirm that the currency on your db transaction is equal to the returned currency
        // Confirm that the db transaction amount is equal to the returned amount
        // Update the db transaction record (including parameters that didn't exist before the transaction is completed. for audit purpose)
        // Give value for the transaction
        // Update the transaction to note that you have given value for the transaction
        // You can also redirect to your success page from here

    }
}
