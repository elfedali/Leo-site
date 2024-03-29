<?php

namespace App\Policies;

use App\Models\MenuCategory;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MenuCategoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, MenuCategory $menuCategory): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(?User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, MenuCategory $menuCategory): bool
    {
        return $user->id === $menuCategory->owner_id
            ? true
            : Response::deny('You do not own this menu category.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, MenuCategory $menuCategory): bool
    {
        return $user->id === $menuCategory->owner_id
            ? true
            : Response::deny('You do not own this menu category.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, MenuCategory $menuCategory): bool
    {
        return $user->id === $menuCategory->owner_id
            ? true
            : Response::deny('You do not own this menu category.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, MenuCategory $menuCategory): bool
    {
        return $user->id === $menuCategory->owner_id
            ? true
            : Response::deny('You do not own this menu category.');
    }
}
