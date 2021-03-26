<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReservationRequest;

class ReservationController extends Controller
{
    public function store(StoreReservationRequest $request)
    {
        $reservation = Reservation::create($request->all());
        return $reservation;
    }

    public function index()
    {
        $allReservations = Reservation::with(['client', 'room'])->get();
        return $allReservations;
    }

    public function show(Reservation $reservation)
    {
        return $reservation;
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return response()->json(['message' => 'Deleted successfully!']);
    }

    public function update(StoreReservationRequest $request, Reservation $reservation)
    {
        $reservation->update($request->all());
        return response()->json(['message' => 'Updated successfully!']);
    }
}
