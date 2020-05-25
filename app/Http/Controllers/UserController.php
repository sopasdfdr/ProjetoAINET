<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UserPost;

class UserController extends Controller
{
    public function update(UserPost $request, User $user)
    {
        $validated_data = $request->validated();
        $aluno->user->email = $validated_data['email'];
        $aluno->user->name = $validated_data['name'];
        $aluno->user->genero = $validated_data['genero'];
        if ($request->hasFile('foto')) {
            Storage::delete('public/fotos/' . $aluno->user->url_foto);
            $path = $request->foto->store('public/fotos');
            $aluno->user->url_foto = basename($path);
        }
        $aluno->user->save();
        $aluno->curso = $validated_data['curso'];
        $aluno->numero = $validated_data['numero'];
        $aluno->save();
        return redirect()->route('admin.alunos')
            ->with('alert-msg', 'Aluno "' . $aluno->user->name . '" foi alterado com sucesso!')
            ->with('alert-type', 'success');
    }
}
