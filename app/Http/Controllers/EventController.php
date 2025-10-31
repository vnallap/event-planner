<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::with('category')
            ->when($request->get('category_id'), fn($q, $v) => $q->where('category_id', $v))
            ->when($request->get('q'), function ($q, $v) {
                $q->where(function ($qq) use ($v) {
                    $qq->where('title', 'like', "%$v%")
                       ->orWhere('location', 'like', "%$v%");
                });
            })
            ->orderBy('start_at');

        $events = $query->paginate(20);

        return response()->json($events);
    }

    public function show(Event $event)
    {
        $event->load(['category']);
        return response()->json($event);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Event::class);

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'category_id' => ['required', 'exists:categories,_id'],
            'location' => ['required', 'string', 'max:255'],
            'start_at' => ['required', 'date'],
            'end_at' => ['required', 'date', 'after_or_equal:start_at'],
            'banner_path' => ['nullable', 'url']
        ]);

        $event = Event::create([
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'category_id' => $data['category_id'],
            'location' => $data['location'],
            'start_at' => $data['start_at'],
            'end_at' => $data['end_at'],
            'banner_path' => $data['banner_path'] ?? null,
            'created_by' => Auth::id(),
        ]);

        if ($request->wantsJson()) {
            return response()->json($event, 201);
        }
        return redirect()->route('admin.options');
    }

    public function update(Request $request, Event $event)
    {
        $this->authorize('update', $event);

        $data = $request->validate([
            'title' => ['sometimes', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'category_id' => ['sometimes', 'exists:categories,_id'],
            'location' => ['sometimes', 'string', 'max:255'],
            'start_at' => ['sometimes', 'date'],
            'end_at' => ['sometimes', 'date', 'after_or_equal:start_at'],
            'banner_path' => ['nullable', 'url']
        ]);

        $event->fill($data)->save();

        if ($request->wantsJson()) {
            return response()->json($event);
        }
        return redirect()->route('admin.options');
    }

    public function destroy(Request $request, Event $event)
    {
        $this->authorize('delete', $event);

        if ($event->banner_path && !preg_match('/^https?:\/\//', $event->banner_path)) {
            Storage::disk('public')->delete($event->banner_path);
        }

        $event->delete();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Deleted successfully']);
        }
        return redirect()->route('admin.options');
    }

    public function register(Request $request, Event $event)
    {
        try {
            // Check if user is authenticated
            if (!auth()->check()) {
                if ($request->wantsJson()) {
                    return response()->json(['message' => 'Unauthenticated. Please log in to register.'], 401);
                }
                return redirect()->route('login');
            }

            $user = auth()->user();

            if ($user->role !== 'attendee') {
                if ($request->wantsJson()) {
                    return response()->json(['message' => 'Only attendees can register for events'], 403);
                }
                return back()->with('error', 'Only attendees can register for events');
            }

            $exists = Registration::where('user_id', $user->id)
                ->where('event_id', $event->_id)
                ->exists();

            if ($exists) {
                if ($request->wantsJson()) {
                    return response()->json(['message' => 'Already registered'], 409);
                }
                return back()->with('warning', 'You are already registered for this event');
            }

            $registration = Registration::create([
                'user_id' => $user->id,
                'event_id' => $event->_id,
                'status' => 'registered',
                'user_name' => $user->name,
                'user_email' => $user->email,
                'event_title' => $event->title,
            ]);

            if ($request->wantsJson()) {
                return response()->json([
                    'message' => 'Successfully registered',
                    'registration' => $registration
                ], 201);
            }
            return back()->with('success', 'Successfully registered for this event');
        } catch (\Exception $e) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Registration failed: ' . $e->getMessage()], 500);
            }
            return back()->with('error', 'Registration failed: ' . $e->getMessage());
        }
    }
    
    public function checkRegistration(Request $request, Event $event)
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return response()->json(['registered' => false, 'message' => 'Not logged in'], 200);
        }
        
        $user = auth()->user();
        
        $exists = Registration::where('user_id', $user->id)
            ->where('event_id', $event->_id)
            ->exists();
            
        return response()->json(['registered' => $exists]);
    }
}
