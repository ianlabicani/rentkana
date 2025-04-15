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
        $user = $request->user();
        if (!$user->isVerifiedLandlord()) {
            return redirect()->route('landlord.rooms.index')->with('error', 'You must be a verified landlord to create a room.');
        }

        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string', // now just a JSON string
            'price' => 'required|numeric|min:0',
            'location' => 'required|string|max:255',
            'status' => 'required|string|in:Available,Occupied',
        ];

        for ($i = 1; $i <= 4; $i++) {
            $rules["photo$i"] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120'; // max 5MB each
        }

        $validated = $request->validate($rules);

        // Decode description JSON string into an associative array
        $descriptionArray = [];
        if (!empty($validated['description'])) {
            $decoded = json_decode($validated['description'], true);
            $descriptionArray = is_array($decoded) ? $decoded : [];
        }

        $room = $user->rooms()->create([
            'title' => $validated['title'],
            'description' => $descriptionArray,
            'price' => $validated['price'],
            'location' => $validated['location'],
            'status' => $validated['status'],
        ]);

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

        if (!empty($imageUrls)) {
            $room->update(['picture_urls' => $imageUrls]);
        }

        return redirect()->route('landlord.rooms.index')->with('success', 'Room created successfully.');
    }





    public function edit(Room $room)
    {
        // Check if the room belongs to the authenticated landlord
        if ($room->landlord_id !== auth()->id()) {
            return redirect()->route('landlord.rooms.index')->with('error', 'You do not have permission to edit this room.');
        }

        return view('landlord.room.edit', [
            'room' => $room,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description_keys' => 'nullable|array',
            'description_keys.*' => 'nullable|string|max:255',
            'description_values' => 'nullable|array',
            'description_values.*' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'location' => 'required|string|max:255',
            'photo1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'photo2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'photo3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'photo4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        // Normalize and build description
        $description = [];
        $keys = $request->input('description_keys', []);
        $values = $request->input('description_values', []);

        foreach ($keys as $index => $key) {
            if (!empty($key)) {
                $description[$key] = $values[$index] ?? '';
            }
        }

        // Handle default sections to always be present
        $defaultDescription = [
            'The space' => 'The space...',
            'Guest access' => 'Guest access...',
            'During your stay' => 'During your stay...',
            'About this place' => 'About this place...',
        ];

        foreach ($defaultDescription as $key => $defaultVal) {
            if (!array_key_exists($key, $description)) {
                $description[$key] = $defaultVal;
            }
        }

        // Update room info
        $room->update([
            'title' => $request->input('title'),
            'description' => $description, // will be cast to JSON if using casts
            'price' => $request->input('price'),
            'location' => $request->input('location'),
        ]);

        // Handle image uploads
        $disk = env('FILESYSTEM_DISK', 'public');
        $roomFolder = "uploads/rooms/{$room->user_id}/{$room->id}";
        Storage::disk($disk)->makeDirectory($roomFolder);

        $pictureUrls = $room->picture_urls ?? [];

        for ($i = 1; $i <= 4; $i++) {
            $photoInput = 'photo' . $i;
            if ($request->hasFile($photoInput)) {
                $path = $request->file($photoInput)->store($roomFolder, $disk);
                $imageUrl = Storage::disk($disk)->url($path);
                $pictureUrls[$i - 1] = $imageUrl;
            }
        }

        $room->update([
            'picture_urls' => array_values($pictureUrls),
        ]);

        return redirect()->back()->with('success', 'Room updated successfully.');
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
