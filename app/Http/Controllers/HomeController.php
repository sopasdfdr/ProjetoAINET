<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        $users = DB::table('users')->count();
        $contas = DB::table('contas')->where('deleted_at', NULL)->count();
        $movimentos = Db::table('movimentos')->count();




        return view('home.index')
        ->withUsers($users)
        ->withContas($contas)
        ->withMovimentos($movimentos);

    }



}
