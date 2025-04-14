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
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'location' => 'required|string|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Create the room record without the photo URL
        $room = $user->rooms()->create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'location' => $request->input('location'),
        ]);

        // Now, store the image in the room-specific folder
        $disk = env('FILESYSTEM_DISK', 'public');
        $roomFolder = "uploads/rooms/{$user->id}/{$room->id}";

        // Create the directory for the room if it doesn't exist
        Storage::disk($disk)->makeDirectory($roomFolder);

        // Store the photo in the room-specific folder
        $path = $request->file('photo')->store($roomFolder, $disk);
        $imageUrl = Storage::disk($disk)->url($path);

        // Update the room record with the image URL
        $room->update([
            'picture_urls' => [$imageUrl], // Store the image URL in the 'picture_urls' field
        ]);

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
