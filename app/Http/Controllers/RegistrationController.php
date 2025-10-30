<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    // List all registrations (Admin only)
    public function index()
    {
        $this->authorize('viewAny', Registration::class);

        $items = Registration::with(['user', 'event'])
            ->latest()
            ->paginate(50);

        return response()->json($items);
    }

    // Register a user (attendee) for an event
    public function store(Request $request, Event $event)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        if ($user->role !== 'attendee') {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        // Prevent duplicate registrations
        $exists = Registration::where('user_id', $user->id)
            ->where('event_id', $event->id)
            ->exists();

        if ($exists) {
            return response()->json(['message' => 'Already registered'], 409);
        }

        $registration = Registration::create([
            'user_id' => $user->id,
            'event_id' => $event->id,
            'status' => 'registered',
        ]);

        return response()->json($registration, 201);
    }

    // Update a registration
    public function update(Request $request, Registration $registration)
    {
        $this->authorize('update', $registration);

        $data = $request->validate([
            'status' => ['sometimes', 'string', 'in:pending,registered,cancelled'],
        ]);

        $registration->fill($data)->save();

        return response()->json($registration);
    }

    // Delete a registration
    public function destroy(Registration $registration)
    {
        $this->authorize('delete', $registration);

        $registration->delete();

        return response()->json(['message' => 'Deleted']);
    }

    // Check if user is registered for an event
    public function checkRegistration(Request $request, Event $event)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['registered' => false]);
        }

        $registered = Registration::where('user_id', $user->id)
            ->where('event_id', $event->id)
            ->exists();

        return response()->json(['registered' => $registered]);
    }
}
