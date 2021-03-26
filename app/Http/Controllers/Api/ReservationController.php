<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Resources\ReservationResource;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function store(StoreReservationRequest $request)
    {
        $reservation = Reservation::create($request->all());
        return new ReservationResource($reservation);
    }

    public function index()
    {
        $allReservations = Reservation::with(['client', 'room'])->get();
        return ReservationResource::collection($allReservations);
    }

    public function show(Reservation $reservation)
    {
        return new ReservationResource($reservation);
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
