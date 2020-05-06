<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'NIF', 'telefone', 'foto', 'adm', 'bloqueado',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function autorizacoes_contas(){
        return $this->belongsToMany('App/Conta', 'autorizacoes_contas', 'user_id', 'id')->withPivot('so_leitura');

    }

    public function contas(){
        return $this->hasMany('App/Conta', 'user_id', 'id');
    }
}
