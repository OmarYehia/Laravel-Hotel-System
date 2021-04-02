<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session;
use Stripe;

class StripeController extends Controller
{
    /**
     * payment view
     */
    public function handleGet(Request $request)
    {
        return view('client-views.stripeForm', ['request' => $request]);
    }
  
    /**
     * handling payment with POST
     */
    public function handlePost(Request $request)
    {
        $details = $request->all();
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create([
            "amount" => $details['paid_price'] * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Making test payment.",
        ]);

        $details['reservation_date'] = Carbon::now()->toDateTimeString();

        $validated = $request->validate([
            [
                'client_id' => 'required|exists:clients',
                'room_id' => 'required|exists:rooms',
                'paid_price' => 'required|integer',
                'accompany_number' => 'required|integer',
            ],
        ]);
      
        $reservation = new Reservation;
        $reservation->client_id = $details['client_id'];
        $reservation->room_id = $details['room_id'];
        $reservation->paid_price = $details['paid_price'] * 100;
        $reservation->accompany_number = $details['accompany_number'];
        $reservation->reservation_date = Carbon::now()->toDateString();
        $reservation->save();

        $room = Room::where('id', $details['room_id'])->firstOrFail();
        $room->is_reserved = 1;
        $room->save();
  
        Session::flash('success', 'Payment has been successfully processed.');
          
        return redirect()->route('index');
    }
}
