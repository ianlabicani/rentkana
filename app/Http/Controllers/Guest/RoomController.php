<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $defaultLocation = null;

        if ($user) {
            $user->load('defaultLocations');
            $defaultLocation = $user->defaultLocations->first();
        }


        $rooms = Room::all();

        return view('guest.room.index', [
            'rooms' => $rooms,
            'defaultLocation' => $defaultLocation,
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        return view('guest.room.show', [
            'room' => $room,
        ]);
    }


}
