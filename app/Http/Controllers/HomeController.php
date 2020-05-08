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
        $contas = Conta::where('deleted_at', NULL)->count();
        $movimentos = Movimento::count();

        return view('home.index')
        ->withUsers($users)
        ->withContas($contas)
        ->withMovimentos($movimentos);
    }
}
