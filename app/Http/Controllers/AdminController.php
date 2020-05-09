<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $nome = $request->nome ?? NULL;
        $email = $request->email ?? NULL;
        $adm = $request->adm ?? 3;
        $blq = $request->blq ?? 3;

        $query = User::query()->select('name' , 'email', 'foto', 'adm', 'bloqueado');

        if($nome!= NULL)
        {
            $query->where('name', 'LIKE', '%' .$nome. '%');
        }
        if($email != NULL)
        {
            $query->where('email', 'LIKE', '%' .$email. '%');
        }
        if($adm != 3){
            $query->where('adm', $adm);
        }
        if($blq != 3)
        {
            $query->where('bloqueado', $blq);
        }

        $users = $query->paginate(10);
        return view('admin.index')->withUsers($users)->withNome($nome)->withEmail($email)->withAdm($adm)->withBlq($blq);
    }
}
