<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use DB;

class BookingController extends Controller
{
    public function index(){

       
        return response()->json(Booking::orderBy('id', 'DESC')->get());
        
       

    }


    public function show(Booking $booking){
        return response()->json($booking);
    }

    public function store(Request $request){
        $request->validate([
            'point_of_origin' => 'string|required',
            'destination' => 'string|required',
            'passenger_name' => 'string|required',
            'age' => 'string|required',
            'contact_no' => 'string|required',
        ]);

        $booking = Booking::create($request->only( 'point_of_origin', 'destination', 'passenger_name', 'age', 'contact_no'));

        return response()->json($booking);

    }


    public function edit(Booking $booking)
    {
        //
    }
    


    public function update(Request $request, Booking $booking){
        $booking->update($request->only('point_of_origin', 'destination','passenger_name', 'age', 'contact_no'));

        return response()->json($booking);

    }

    public function destroy(Booking $booking){


        $passenger_name = $booking->bus_name;

        $booking->delete();

        return response()->json([
            'deleted' => true,
            'message' =>"Booking has been deleted."
        ]);
    }
}
