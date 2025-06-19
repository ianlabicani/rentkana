<?php

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class DashboardController extends Controller
{
    public function index()
    {
        return view('landlord.dashboard.index');
    }

    public function roomsData()
    {
        $user = Auth::user();
        $rooms = Room::where('landlord_id', $user->id)->get();
        $count = $rooms->count();
        $locationCounts = $rooms->groupBy('location')->map(function ($group) {
            return count($group);
        });
        return Response::json([
            'count' => $count,
            'locations' => [
                'labels' => array_values($locationCounts->keys()->toArray()),
                'counts' => array_values($locationCounts->values()->toArray()),
            ],
            0
        ]);
    }
}
