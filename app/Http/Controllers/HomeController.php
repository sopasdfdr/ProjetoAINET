<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Movimento;
use App\Conta;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::count();
        $contas = Conta::count();
        $movimentos = Movimento::count();

        return view('home.index')
        ->withUsers($users)
        ->withContas($contas)
        ->withMovimentos($movimentos);
    }

    public function authenticatedIndex()
    {
        $user = auth()->user();
        $movimentos = 0;
        $contas = 0;
        foreach($user->contas()->get() as $conta)
        {
            $movimentos += $conta->movimentos()->count();
            $contas ++;
        }
        return view('home.index_authenticated')
        ->withUser($user)
        ->withContas($contas)
        ->withMovimentos($movimentos);
    }
}
