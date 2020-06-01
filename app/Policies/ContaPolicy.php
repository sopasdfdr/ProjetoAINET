<?php

namespace App\Policies;

use App\Conta;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContaPolicy
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
     * @param  \App\Conta  $conta
     * @return mixed
     */
    public function view(User $user, Conta $conta)
    {
       if($user->id == $conta->user_id){
            return true;
       }
       if($conta->autorizacoes_contas()->where('id',$user->id)->count()){
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
     * @param  \App\Conta  $conta
     * @return mixed
     */
    public function update(User $user, Conta $conta)
    {
        if($conta->autorizacoes_contas()->where('id',$user->id)->count() && $conta->autorizacoes_contas()->find($user->id)->pivot->so_leitura == 0){
            return true;
        }
        if($user->id == $conta->user_id){
            return true;
        }

       return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Conta  $conta
     * @return mixed
     */
    public function delete(User $user, Conta $conta)
    {
        if($user->id == $conta->user_id){
            return true;
       }
       return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Conta  $conta
     * @return mixed
     */
    public function restore(User $user, $id)
    {
        $conta = Conta::onlyTrashed()->find($id);
        if($user->id == $conta->user_id){
            return true;
       }
       return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Conta  $conta
     * @return mixed
     */
    public function forceDelete(User $user, $id)
    {
        $conta = Conta::onlyTrashed()->find($id);
        if($user->id == $conta->user_id){
            return true;
       }
       return false;
    }
}
