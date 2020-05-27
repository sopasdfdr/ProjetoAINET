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

        $query = User::query()->select('id','name' , 'email', 'foto', 'adm', 'bloqueado');

        if($nome!= NULL)
        {
            $query->where('name', 'LIKE', '%' .$nome. '%');
        }
        if($email != NULL)
        {
            $query->where('email', 'LIKE', '%' .$email. '%');
        }
        if(auth()->user()->can('view_update_adm')){


            if($adm != 3){
                $query->where('adm', $adm);
            }
            if($blq != 3)
            {
                $query->where('bloqueado', $blq);
            }
        }

        $users = $query->paginate(7);
        return view('admin.index')->withUsers($users)->withNome($nome)->withEmail($email)->withAdm($adm)->withBlq($blq);
    }

    //bloquear e desbloquear users
    public function block(User $user)
    {
        User::where('id', $user->id)
            ->update(['bloqueado' => 1]);

        return redirect()
            ->route('admin.index')
            ->with('success', 'Utilizador bloqueado com sucesso');
    }

    public function unblock(User $user)
    {
        User::where('id', $user->id)
            ->update(['bloqueado' => 0]);


        return redirect()
            ->route('admin.index')
            ->with('success', 'Utilizador desbloqueado com sucesso');
    }

    //promover e desprover de admin
    public function promote(User $user)
    {
        User::where('id', $user->id)
            ->update(['adm' => 1]);

        return redirect()
            ->route('admin.index')
            ->with('success', 'Utilizador promovido a admin');
    }

    public function demote(User $user)
    {
        User::where('id', $user->id)
            ->update(['adm' => 0]);

        return redirect()
            ->route('admin.index')
            ->with('success', 'Utilizador despromovido de admin');
    }
}
