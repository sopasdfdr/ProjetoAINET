<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

class Conta extends Model
{
    use SoftDeletes;
    public $timestamps = false;

    protected $fillable=['user_id', 'nome', 'descricao'];

    public function users(){
        return $this->belongsTo('App/users');
    }

    public function movimentos(){
        return $this->hasMany('App/Movimento', 'conta_id', 'id');
    }

    public function autorizacoes_contas(){
        return $this->belongsToMany('App/User', 'autorizacoes_contas', 'conta_id', 'id')->withPivot('so_leitura');
    }
}
