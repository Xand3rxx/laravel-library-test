<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Requests\ReservationRequest;


class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('/authors/')->with(['reservations' => Reservation::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ReservationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReservationRequest $request)
    {
        // Retrieve the validated input data and create reservation record.
        return ($reservation = Reservation::create($request->validated()))
        ? redirect($reservation->path())
        : back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Http\Requests\ReservationRequest  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(ReservationRequest $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ReservationRequest  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(ReservationRequest $request, Reservation $reservation)
    {
        // Retrieve the validated input data and update reservation record.
        return ($reservation->update($request->validated()))
            ? redirect($reservation->path())
            : back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
