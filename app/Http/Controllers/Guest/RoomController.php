<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

    private function getAddressFromCoordinates($lat, $lng)
    {
        $url = "https://nominatim.openstreetmap.org/reverse?format=json&lat={$lat}&lon={$lng}&zoom=18&addressdetails=1";

        $response = Http::withHeaders([
            'User-Agent' => 'RoomLocatorApp/1.0 (your@email.com)', // Replace with your contact info for Nominatim compliance
        ])->timeout(10)->get($url);

        if ($response->successful()) {
            return $response->json('display_name') ?? null;
        }

        return null;
    }

}
