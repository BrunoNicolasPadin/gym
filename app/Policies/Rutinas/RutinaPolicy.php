<?php

namespace App\Policies\Rutinas;

use App\Models\Rutinas\Rutina;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class RutinaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user, Rutina $rutina)
    {
        return $user->id === $rutina->user_id
                ? Response::allow()
                : Response::deny('Esta no es tu rutina.');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Rutinas\Rutina  $rutina
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Rutina $rutina)
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user, Rutina $rutina)
    {
        return $user->id === $rutina->user_id
                ? Response::allow()
                : Response::deny('Esta no es tu rutina.');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Rutinas\Rutina  $rutina
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Rutina $rutina)
    {
        return $user->id === $rutina->user_id
                ? Response::allow()
                : Response::deny('Esta no es tu rutina.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Rutinas\Rutina  $rutina
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Rutina $rutina)
    {
        return $user->id === $rutina->user_id
                ? Response::allow()
                : Response::deny('Esta no es tu rutina.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Rutinas\Rutina  $rutina
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Rutina $rutina)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Rutinas\Rutina  $rutina
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Rutina $rutina)
    {
        return $user->id === $rutina->user_id
                ? Response::allow()
                : Response::deny('Esta no es tu rutina.');
    }
}
