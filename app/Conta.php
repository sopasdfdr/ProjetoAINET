<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

class Conta extends Model
{
    use SoftDeletes;
    public $timestamps = false;

    protected $fillable=['user_id', 'nome', 'descricao', 'saldo_atual'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function movimentos(){
        return $this->hasMany('App\Movimento', 'conta_id', 'id');
    }

    public function autorizacoes_contas(){
        return $this->belongsToMany('App\User', 'autorizacoes_contas', 'conta_id', 'user_id')->withPivot('so_leitura');
    }
}
