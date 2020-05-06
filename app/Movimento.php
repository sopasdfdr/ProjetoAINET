<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

class Movimento extends Model
{
    use SoftDeletes;
    public $timestamps = false;
    protected $fillable=['conta_id','valor', 'tipo', 'categoria_id', 'descricao', 'imagem_doc'];

    public function categoria(){
        return $this->belongsTo('App/Categoria');
    }

    public function contas(){
        return $this->belongsTo('App/Conta');
    }
}
