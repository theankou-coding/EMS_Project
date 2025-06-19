<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;  // Correct model import for Event
use App\Models\User;

class AllResourcesController extends Controller
{
    // ---------- EVENTS ----------
    public function indexEvents()
    {
        return response()->json(Event::all());
    }

    public function storeEvent(Request $request)
    {
        $validated = $request->validate([
            'event_name' => 'required|string|max:45',
            'category' => 'required|string|max:45',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location' => 'required|string|max:45',
        ]);

        return response()->json(Event::create($validated), 201);
    }

    public function showEvent($id)
    {
        return response()->json(Event::findOrFail($id));
    }

    public function updateEvent(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $validated = $request->validate([
            'event_name' => 'required|string|max:45',
            'category' => 'required|string|max:45',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location' => 'required|string|max:45',
        ]);

        $event->update($validated);
        return response()->json($event);
    }

    public function destroyEvent($id)
    {
        Event::findOrFail($id)->delete();
        return response()->json(null, 204);
    }

    // ---------- USERS ----------
    public function indexUsers()
    {
        return response()->json(User::all());
    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:45',
            'gender' => 'required|string|max:45',
            'date_of_birth' => 'required|date',
            'location' => 'required|string|max:45',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
            'phone_number' => 'required|string|max:45',
            'registration_date' => 'required|date',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        return response()->json(User::create($validated), 201);
    }

    public function showUser($id)
    {
        return response()->json(User::findOrFail($id));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validated = $request->validate([
            'username' => 'required|string|max:45',
            'gender' => 'required|string|max:45',
            'date_of_birth' => 'required|date',
            'location' => 'required|string|max:45',
            'email' => 'required|email|unique:users,email,' . $id . ',user_id',
            'password' => 'nullable|string',
            'phone_number' => 'required|string|max:45',
            'registration_date' => 'required|date',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);
        return response()->json($user);
    }

    public function destroyUser($id)
    {
        User::findOrFail($id)->delete();
        return response()->json(null, 204);
    }

    // ---------- GENERIC (you may want to remove or adjust these) ----------
    public function indexGeneric()
    {
        return response()->json(Event::all());
    }

    public function storeGeneric(Request $request)
    {
        $validated = $request->validate([
            'field1' => 'required|string|max:45',
            'field2' => 'required|string|max:45',
        ]);

        return response()->json(Event::create($validated), 201);
    }

    public function showGeneric($id)
    {
        return response()->json(Event::findOrFail($id));
    }

    public function updateGeneric(Request $request, $id)
    {
        $record = Event::findOrFail($id);
        $validated = $request->validate([
            'field1' => 'required|string|max:45',
            'field2' => 'required|string|max:45',
        ]);

        $record->update($validated);
        return response()->json($record);
    }

    public function destroyGeneric($id)
    {
        Event::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}