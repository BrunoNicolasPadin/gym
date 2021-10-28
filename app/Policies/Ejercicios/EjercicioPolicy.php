<?php

namespace App\Policies\Ejercicios;

use App\Models\Ejercicios\Ejercicio;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class EjercicioPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ejercicios\Ejercicio  $ejercicio
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Ejercicio $ejercicio)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ejercicios\Ejercicio  $ejercicio
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Ejercicio $ejercicio)
    {
        return $user->id === $ejercicio->user_id
                ? Response::allow()
                : Response::deny('Este no es tu ejercicio.');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ejercicios\Ejercicio  $ejercicio
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Ejercicio $ejercicio)
    {
        return $user->id === $ejercicio->user_id
                ? Response::allow()
                : Response::deny('Este no es tu ejercicio.');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ejercicios\Ejercicio  $ejercicio
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Ejercicio $ejercicio)
    {
        return $user->id === $ejercicio->user_id
                ? Response::allow()
                : Response::deny('Este no es tu ejercicio.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ejercicios\Ejercicio  $ejercicio
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Ejercicio $ejercicio)
    {
        return $user->id === $ejercicio->user_id
                ? Response::allow()
                : Response::deny('Este no es tu ejercicio.');
    }
}
