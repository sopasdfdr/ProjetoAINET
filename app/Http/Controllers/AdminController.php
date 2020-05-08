<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $nome = $request->nome;
        $email = $request->email;
        $blq = $request->blq;
        $adm = $request->adm;

        $query = User::query()->select('name' , 'email', 'foto', 'adm', 'bloqueado');

        if($nome)
        {
            $query->where('name', 'LIKE', '%' .$nome. '%');
        }
        if($email)
        {
            $query->where('email',$email);
        }
        $users = $query->paginate(10);
        return view('admin.index')->withUsers($users);
    }
}
