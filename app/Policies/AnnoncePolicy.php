<?php

namespace App\Policies;

use App\Models\Annonce;
use App\Models\User;

class AnnoncePolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, Annonce $annonce): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true; // Any verified user can create
    }

    public function update(User $user, Annonce $annonce): bool
    {
        return $user->id === $annonce->user_id || $user->isAdmin();
    }

    public function delete(User $user, Annonce $annonce): bool
    {
        return $user->id === $annonce->user_id || $user->isAdmin();
    }

    public function restore(User $user, Annonce $annonce): bool
    {
        return $user->isAdmin();
    }

    public function forceDelete(User $user, Annonce $annonce): bool
    {
        return $user->isAdmin();
    }
}