<?php

namespace App\Policies\Entrenamientos;

use App\Models\Entrenamientos\Entrenamiento;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class EntrenamientoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user, Entrenamiento $entrenamiento)
    {
        return $user->id === $entrenamiento->user_id
                ? Response::allow()
                : Response::deny('Este no es tu entrenamiento.');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Entrenamientos\Entrenamiento  $entrenamiento
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Entrenamiento $entrenamiento)
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user, Entrenamiento $entrenamiento)
    {
        return $user->id === $entrenamiento->user_id
                ? Response::allow()
                : Response::deny('Este no es tu entrenamiento.');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Entrenamientos\Entrenamiento  $entrenamiento
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Entrenamiento $entrenamiento)
    {
        return $user->id === $entrenamiento->user_id
                ? Response::allow()
                : Response::deny('Este no es tu entrenamiento.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Entrenamientos\Entrenamiento  $entrenamiento
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Entrenamiento $entrenamiento)
    {
        return $user->id === $entrenamiento->user_id
                ? Response::allow()
                : Response::deny('Este no es tu entrenamiento.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Entrenamientos\Entrenamiento  $entrenamiento
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Entrenamiento $entrenamiento)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Entrenamientos\Entrenamiento  $entrenamiento
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Entrenamiento $entrenamiento)
    {
        return $user->id === $entrenamiento->user_id
                ? Response::allow()
                : Response::deny('Este no es tu entrenamiento.');
    }
}
