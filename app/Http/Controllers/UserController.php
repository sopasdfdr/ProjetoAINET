<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Conta;
use App\Movimento;

class UserController extends Controller
{
    public function contas()
    {
        $contas = Conta::select('user_id','nome','descricao','saldo_atual','data_ultimo_movimento')->paginate(10);
        return view('user.contas')->withContas($contas);
    }

    public function dados()
    {
        $movimentos = Movimento::select('data', 'valor', 'saldo_inicial', 'saldo_final', 'categoria_id', 'tipo')->paginate(10);
        return view('user.dados')->withMovimentos($movimentos);
    }
}
