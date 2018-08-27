<?php

namespace App\Policies;

use App\Attributes\RoleAttributes;
use App\Models\User;
use App\models\Orphan;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrphanPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the orphan.
     *
     * @param  \App\Models\User  $user
     * @param  \App\models\Orphan  $orphan
     * @return mixed
     */
    public function view(User $user, Orphan $orphan)
    {
        //
    }

    /**
     * Determine whether the user can create orphans.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the orphan.
     *
     * @param  \App\Models\User  $user
     * @param  \App\models\Orphan  $orphan
     * @return mixed
     */
    public function update(User $user, Orphan $orphan)
    {
        if ($user->role === RoleAttributes::ROOT) {
            return true;
        }

        return $user->id === $orphan->user_id;
    }

    /**
     * Determine whether the user can delete the orphan.
     *
     * @param  \App\Models\User  $user
     * @param  \App\models\Orphan  $orphan
     * @return mixed
     */
    public function delete(User $user, Orphan $orphan)
    {
        if ($user->role === RoleAttributes::ROOT) {
            return true;
        }

        return $user->id === $orphan->user_id;
    }

    /**
     * Determine whether the user can restore the orphan.
     *
     * @param  \App\Models\User  $user
     * @param  \App\models\Orphan  $orphan
     * @return mixed
     */
    public function restore(User $user, Orphan $orphan)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the orphan.
     *
     * @param  \App\Models\User  $user
     * @param  \App\models\Orphan  $orphan
     * @return mixed
     */
    public function forceDelete(User $user, Orphan $orphan)
    {
        //
    }
}
