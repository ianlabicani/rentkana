<?php

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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
            'description_keys' => 'nullable|array',
            'description_keys.*' => 'nullable|string|max:255',
            'description_values' => 'nullable|array',
            'description_values.*' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'status' => 'required|string|in:Available,Occupied',
            'lat' => 'nullable|numeric',
            'lng' => 'nullable|numeric',
        ];

        for ($i = 1; $i <= 4; $i++) {
            $rules["photo$i"] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120';
        }

        $validated = $request->validate($rules);

        $description = collect($request->input('description_keys', []))
            ->mapWithKeys(function ($key, $i) use ($request) {
                return !empty($key) ? [$key => $request->input("description_values.$i", '')] : [];
            })
            ->union([
                'The space' => 'The space...',
                'Guest access' => 'Guest access...',
                'During your stay' => 'During your stay...',
                'About this place' => 'About this place...',
            ]);

        // Call reverse geocoding if lat/lng present
        $resolvedAddress = $this->getAddressFromCoordinates($validated['lat'] ?? null, $validated['lng'] ?? null);

        // Create the room
        $room = $user->rooms()->create([
            'title' => $validated['title'],
            'description' => $description,
            'price' => $validated['price'],
            'status' => $validated['status'],
            'lat' => $validated['lat'] ?? null,
            'lng' => $validated['lng'] ?? null,
            'location' => $resolvedAddress ?? 'Unknown Location',
        ]);

        // Handle photo uploads
        $disk = env('FILESYSTEM_DISK', 'public');
        $roomFolder = "uploads/users/{$user->id}/rooms/{$room->id}";
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
            'photo1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'photo2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'photo3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'photo4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'lat' => 'nullable|numeric',
            'lng' => 'nullable|numeric',
        ]);

        $disk = env('FILESYSTEM_DISK', 'public');
        $roomFolder = "uploads/users/{$room->landlord_id}/rooms/{$room->id}";

        $description = collect($request->input('description_keys', []))
            ->mapWithKeys(function ($key, $i) use ($request) {
                return !empty($key) ? [$key => $request->input("description_values.$i", '')] : [];
            })
            ->union([
                'The space' => 'The space...',
                'Guest access' => 'Guest access...',
                'During your stay' => 'During your stay...',
                'About this place' => 'About this place...',
            ]);

        // Get updated coordinates
        $lat = $request->input('lat', null);
        $lng = $request->input('lng', null);

        // Reverse geocode again only if lat/lng is present
        $resolvedAddress = $this->getAddressFromCoordinates($lat, $lng);

        // Update base room info
        $room->update([
            'title' => $request->input('title'),
            'description' => $description,
            'price' => $request->input('price'),
            'lat' => $lat,
            'lng' => $lng,
            'location' => $resolvedAddress ?? 'Unknown Location',
        ]);

        // Existing picture URLs
        $pictureUrls = $room->picture_urls ?? [];

        // Replace only the photos that are uploaded
        for ($i = 1; $i <= 4; $i++) {
            $photoInput = "photo{$i}";
            if ($request->hasFile($photoInput)) {
                // Delete old one at this index if exists
                if (!empty($pictureUrls[$i - 1])) {
                    $oldPath = parse_url($pictureUrls[$i - 1], PHP_URL_PATH);
                    if ($oldPath) {
                        $relativePath = ltrim(str_replace('storage/', '', $oldPath), '/');
                        Storage::disk($disk)->delete($relativePath);
                    }
                }

                // Upload new image and assign to correct index
                $path = $request->file($photoInput)->store($roomFolder, $disk);
                $pictureUrls[$i - 1] = Storage::disk($disk)->url($path);
            }
        }

        // Ensure the array is re-indexed
        $room->update(['picture_urls' => array_values($pictureUrls)]);

        return redirect()->back()->with('success', 'Room updated successfully.');
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $disk = env('FILESYSTEM_DISK', 'public');

        if (!empty($room->picture_urls)) {
            $firstImageUrl = $room->picture_urls[0];
            $firstPath = parse_url($firstImageUrl, PHP_URL_PATH);

            if ($firstPath) {
                // Adjust path extraction based on disk type
                $relativePath = ltrim($firstPath, '/');

                // If using local/public disk, strip 'storage/'
                if ($disk === 'public' && str_starts_with($relativePath, 'storage/')) {
                    $relativePath = substr($relativePath, strlen('storage/'));
                }

                $directory = dirname($relativePath);
                Storage::disk($disk)->deleteDirectory($directory);
            }
        }

        $room->delete();

        return redirect()->route('landlord.rooms.index')->with('success', 'Room and its images deleted successfully.');
    }



    private function getAddressFromCoordinates($lat, $lng)
    {
        if ($lat == null || $lng == null) {
            return null;
        }

        $url = "https://nominatim.openstreetmap.org/reverse?format=json&lat={$lat}&lon={$lng}&zoom=18&addressdetails=1";

        $response = Http::withHeaders([
            'User-Agent' => 'RoomLocatorApp/1.0 (your@email.com)',
        ])->timeout(10)->get($url);

        if ($response->successful()) {
            return $response->json('display_name') ?? null;
        }

        return null;
    }

}
