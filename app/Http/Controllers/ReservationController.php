<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Annonce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    // Store a new reservation with availability check
    public function store(Request $request, $annonceId)
    {
        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        $annonce = Annonce::findOrFail($annonceId);

        $overlap = Reservation::where('annonce_id', $annonce->id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                      ->orWhereBetween('end_date', [$request->start_date, $request->end_date])
                      ->orWhere(function ($q) use ($request) {
                          $q->where('start_date', '<=', $request->start_date)
                            ->where('end_date', '>=', $request->end_date);
                      });
            })
            ->whereNotIn('status', ['cancelled', 'refused'])
            ->exists();

        if ($overlap) {
            return back()->withErrors(['dates' => 'Ces dates sont déjà réservées pour cette annonce.']);
        }

        $total = Reservation::calculateTotalPrice($request->start_date, $request->end_date, $annonce->prix_par_nuit);

        Reservation::create([
            'annonce_id' => $annonce->id,
            'user_id' => Auth::id(),
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_price' => $total,
            'status' => 'pending',
        ]);

        return redirect()->route('annonces.show', $annonce)->with('success', 'Réservation demandée !');
    }

    // Accept a reservation (host only)
    public function accept($id)
    {
        $reservation = Reservation::findOrFail($id);
        if (Auth::id() !== $reservation->annonce->user_id) {
            return back()->with('error', 'Seul l\'hôte peut accepter la réservation.');
        }
        $reservation->status = 'accepted';
        $reservation->save();
        return back()->with('success', 'Réservation acceptée.');
    }

    // Refuse a reservation (host only)
    public function refuse($id)
    {
        $reservation = Reservation::findOrFail($id);
        if (Auth::id() !== $reservation->annonce->user_id) {
            return back()->with('error', 'Seul l\'hôte peut refuser la réservation.');
        }
        $reservation->status = 'refused';
        $reservation->save();
        return back()->with('success', 'Réservation refusée.');
    }

    // Cancel a reservation (traveler only)
    public function cancel($id)
    {
        $reservation = Reservation::findOrFail($id);
        if (Auth::id() !== $reservation->user_id) {
            return back()->with('error', 'Seul le voyageur peut annuler sa réservation.');
        }
        $reservation->status = 'cancelled';
        $reservation->save();
        return back()->with('success', 'Réservation annulée.');
    }
}