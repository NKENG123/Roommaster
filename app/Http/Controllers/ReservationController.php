<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Affiche la liste des salles et l'état des réservations.
     */
    public function index()
    {
        $rooms = Room::with('reservations')->get();
        return view('dashboard', compact('rooms'));
    }

    /**
     * Enregistre une nouvelle réservation avec vérification de conflit.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'room_id'    => 'required|exists:rooms,id',
            'start_time' => 'required|date|after:now',
            'end_time'   => 'required|date|after:start_time',
        ]);

        // ALGORITHME DE DÉTECTION DE CONFLIT (Overlap)
        // Une collision existe si : (Nouveau_Début < Fin_Existante) ET (Nouvelle_Fin > Début_Existant)
        $conflict = Reservation::where('room_id', $data['room_id'])
            ->where(function ($query) use ($data) {
                $query->where('start_time', '<', $data['end_time'])
                      ->where('end_time', '>', $data['start_time']);
            })->exists();

        if ($conflict) {
            return back()->withErrors(['error' => 'Cette salle est déjà réservée pour ce créneau horaire.']);
        }

        Reservation::create([
            'room_id'    => $data['room_id'],
            'user_id'    => Auth::id(),
            'start_time' => $data['start_time'],
            'end_time'   => $data['end_time'],
        ]);

        return redirect()->route('dashboard')->with('success', 'La réservation a été enregistrée avec succès.');
    }

    /**
     * Historique des réservations de l'utilisateur connecté.
     */
    public function history()
    {
        $reservations = Auth::user()->reservations()->with('room')->latest()->get();
        return view('reservations.history', compact('reservations'));
    }
}
