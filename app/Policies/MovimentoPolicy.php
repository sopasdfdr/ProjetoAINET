<?php

namespace App\Policies;

use App\Movimento;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MovimentoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Movimento  $movimento
     * @return mixed
     */
    public function view(User $user, Movimento $movimento)
    {
        if($movimento->conta->user_id == $user->id){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Movimento  $movimento
     * @return mixed
     */
    public function update(User $user, Movimento $movimento)
    {
        if($movimento->conta->user_id == $user->id){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Movimento  $movimento
     * @return mixed
     */
    public function delete(User $user, Movimento $movimento)
    {
        if($movimento->conta->user_id == $user->id){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Movimento  $movimento
     * @return mixed
     */
    public function restore(User $user, Movimento $movimento)
    {
        if($movimento->conta->user_id == $user->id){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Movimento  $movimento
     * @return mixed
     */
    public function forceDelete(User $user, Movimento $movimento)
    {
        if($movimento->conta->user_id == $user->id){
            return true;
        }
        return false;
    }
}
