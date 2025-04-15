<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'nullable|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        Feedback::create([
            'user_id' => auth()->id(),
            'type' => $request->input('type'),
            'message' => $request->input('message'),
        ]);

        return redirect()->back()->with('success', 'Feedback submitted successfully.');
    }
}
