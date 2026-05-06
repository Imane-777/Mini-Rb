<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvisController extends Controller
{
    public function store(Request $request, $reservationId)
    {
        $reservation = Reservation::findOrFail($reservationId);

        if ($reservation->user_id !== Auth::id() || $reservation->status !== 'accepted') {
            return response()->json([
                'message' => 'Vous ne pouvez laisser un avis que pour vos réservations acceptées.',
            ], 403);
        }

        $validated = $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        Avis::create([
            'reservation_id' => $reservation->id,
            'user_id'        => Auth::id(),
            'rating'         => $validated['rating'],
            'comment'        => $validated['comment'],
        ]);

        return response()->json(['message' => 'Avis ajouté avec succès.'], 201);
    }

    public function destroy($id)
    {
        $avis = Avis::findOrFail($id);

        if ($avis->user_id !== Auth::id()) {
            return response()->json(['message' => 'Vous ne pouvez supprimer que vos propres avis.'], 403);
        }

        $avis->delete();

        return response()->json(['message' => 'Avis supprimé.']);
    }
}
