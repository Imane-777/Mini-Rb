<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvisController extends Controller
{
    // Store a new review
    public function store(Request $request, $reservationId)
    {
        $reservation = Reservation::findOrFail($reservationId);
        if ($reservation->user_id !== Auth::id() || $reservation->status !== 'accepted') {
            return back()->with('error', 'Vous ne pouvez laisser un avis que pour vos réservations acceptées.');
        }
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);
        Avis::create([
            'reservation_id' => $reservation->id,
            'user_id' => Auth::id(),
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);
        return back()->with('success', 'Avis ajouté avec succès.');
    }

    // Delete a review
    public function destroy($id)
    {
        $avis = Avis::findOrFail($id);
        if ($avis->user_id !== Auth::id()) {
            return back()->with('error', 'Vous ne pouvez supprimer que vos propres avis.');
        }
        $avis->delete();
        return back()->with('success', 'Avis supprimé.');
    }
}
