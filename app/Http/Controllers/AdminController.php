<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Annonce;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->user() || !$request->user()->isAdmin()) {
            return response()->json(['message' => 'Accès refusé.'], 403);
        }

        $users = User::latest()->get()->map(fn ($u) => [
            'id'         => $u->id,
            'name'       => $u->name,
            'email'      => $u->email,
            'role'       => $u->role,
            'created_at' => $u->created_at,
        ]);

        $annonces = Annonce::with('user')->latest()->get()->map(fn ($a) => [
            'id'            => $a->id,
            'titre'         => $a->titre,
            'ville'         => $a->ville,
            'prix_par_nuit' => $a->prix_par_nuit,
            'host_name'     => $a->user->name,
        ]);

        $reservations = Reservation::with(['user', 'annonce'])->latest()->get()->map(fn ($r) => [
            'id'            => $r->id,
            'start_date'    => $r->start_date,
            'end_date'      => $r->end_date,
            'total_price'   => $r->total_price,
            'status'        => $r->status,
            'annonce_titre' => $r->annonce->titre,
            'traveler_name' => $r->user->name,
        ]);

        return response()->json([
            'users'        => $users,
            'annonces'     => $annonces,
            'reservations' => $reservations,
        ]);
    }

    public function deleteUser(Request $request, $id)
    {
        if (!$request->user()->isAdmin()) {
            return response()->json(['message' => 'Accès refusé.'], 403);
        }

        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'Utilisateur supprimé.']);
    }

    public function deleteAnnonce(Request $request, $id)
    {
        if (!$request->user()->isAdmin()) {
            return response()->json(['message' => 'Accès refusé.'], 403);
        }

        $annonce = Annonce::findOrFail($id);
        $annonce->delete();

        return response()->json(['message' => 'Annonce supprimée.']);
    }
}
