<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function stats()
    {
        return response()->json([
            'events' => Event::count(),
            'categories' => Category::count(),
            'attendees' => User::where('role', 'attendee')->count(),
            'registrations' => Registration::count(),
        ]);
    }

    public function admin()
    {
        $events = Event::with('category')->orderBy('start_at')->get();
        $registrations = Registration::with(['user', 'event'])->latest()->take(100)->get();
        $categories = Category::orderBy('name')->get();

        return view('admin', [
            'events' => $events,
            'registrations' => $registrations,
            'categories' => $categories,
        ]);
    }

    public function home()
    {
        $events = Event::with('category')->orderBy('start_at')->get();
        $categories = Category::orderBy('name')->get();
        $user = Auth::user();

        return view('home', compact('events', 'categories', 'user'));
    }
}
