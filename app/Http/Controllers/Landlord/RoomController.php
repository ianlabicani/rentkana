<?php

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $user = $request->user();
        $rooms = $user->rooms()->paginate(10);
        $isVerifiedLandlord = $user->isVerifiedLandlord();

        return view('landlord.room.index', compact('rooms', 'isVerifiedLandlord'));
    }


    public function create(Request $request)
    {

        // Check if landlord is verified
        $user = $request->user();
        if (!$user->isVerifiedLandlord()) {
            return redirect()->route('landlord.rooms.index')->with('error', 'You must be a verified landlord to create a room.');
        }

        return view('landlord.room.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Check if landlord is verified
        $user = $request->user();
        if (!$user->isVerifiedLandlord()) {
            return redirect()->route('landlord.rooms.index')->with('error', 'You must be a verified landlord to create a room.');
        }

        // Validate the form inputs
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'location' => 'required|string|max:255',
        ];

        // Add rules for photo1 to photo4 (optional)
        for ($i = 1; $i <= 4; $i++) {
            $rules["photo$i"] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';
        }

        $request->validate($rules);

        // Create the room record without images
        $room = $user->rooms()->create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'location' => $request->input('location'),
        ]);

        // Store uploaded images
        $disk = env('FILESYSTEM_DISK', 'public');
        $roomFolder = "uploads/rooms/{$user->id}/{$room->id}";
        Storage::disk($disk)->makeDirectory($roomFolder);

        $imageUrls = [];

        for ($i = 1; $i <= 4; $i++) {
            if ($request->hasFile("photo$i")) {
                $path = $request->file("photo$i")->store($roomFolder, $disk);
                $imageUrls[] = Storage::disk($disk)->url($path);
            }
        }

        // Update room with image URLs
        if (!empty($imageUrls)) {
            $room->update([
                'picture_urls' => $imageUrls,
            ]);
        }

        return redirect()->route('landlord.rooms.index')->with('success', 'Room created successfully.');
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'location' => 'required|string|max:255',
        ]);

        $room->update($request->only('title', 'description', 'price', 'location'));

        return redirect()->route('landlord.rooms.index')->with('success', 'Room updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $room->delete();

        return redirect()->route('landlord.rooms.index')->with('success', 'Room deleted successfully.');
    }
}
