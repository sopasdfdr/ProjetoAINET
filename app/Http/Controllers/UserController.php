<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UserPost;

class UserController extends Controller
{
    public function edit()
    {
        $user = User::find(auth()->user()->id);
        return view('user.dados.user_dados')->withUser($user);
    }

    public function update(UserPost $request, User $user)
    {
        $validated_data = $request->validated();
        if ($request->hasFile('foto')) {
            Storage::delete('public/fotos/' . $aluno->user->url_foto);
            $path = $request->foto->store('public/fotos');
            $aluno->user->url_foto = basename($path);
        }
        return redirect()->route('user.edit')
            ->with('alert-msg', 'Dados de conta alterados com sucesso!')
            ->with('alert-type', 'success');
    }
}
