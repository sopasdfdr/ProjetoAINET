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
        $user->name = $validated_data['name'];
        $user->email = $validated_data['email'];
        $user->NIF = $validated_data['NIF'];
        $user->telefone = $validated_data['telefone'];
        if ($request->hasFile('foto')) {
            Storage::delete('storage/app/public/fotos/' . $user->foto);
            $path = $request->foto->store('storage/app/public/fotos');
            $user->foto = basename($path);
        }
        $user->save();
        return redirect()->route('user.edit')
            ->with('alert-msg', 'Dados de conta alterados com sucesso!')
            ->with('alert-type', 'success');
    }
}
