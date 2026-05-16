<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    public function create()
    {
        return view('rooms.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'capacity'    => 'required|integer|min:1',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Upload de l'image si elle existe
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('rooms', 'public');
        }

        Room::create($data);

        return redirect()->route('dashboard')->with('success', 'La salle a été créée.');
    }

    public function edit(Room $room)
    {
        return view('rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'capacity'    => 'required|integer|min:1',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Remplace l'ancienne image si une nouvelle est uploadée
        if ($request->hasFile('image')) {
            // Supprime l'ancienne image du stockage
            if ($room->image) {
                Storage::disk('public')->delete($room->image);
            }
            $data['image'] = $request->file('image')->store('rooms', 'public');
        } else {
            unset($data['image']); // Garde l'ancienne image
        }

        $room->update($data);

        return redirect()->route('dashboard')->with('success', 'La salle a été mise à jour.');
    }

    public function destroy(Room $room)
    {
        // Supprime l'image du stockage
        if ($room->image) {
            Storage::disk('public')->delete($room->image);
        }

        $room->reservations()->delete();
        $room->delete();

        return redirect()->route('dashboard')->with('success', 'La salle a été définitivement supprimée.');
    }
}