<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserPost;
use App\Http\Requests\PasswordPost;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function edit()
    {
        $user = User::find(auth()->user()->id);
        return view('user.dados.user_dados')->withUser($user);
    }

    public function update(UserPost $request)
    {
        $user = User::find(auth()->user()->id);
        $validated_data = $request->validated();
        $user->name = $validated_data['name'];
        if($user->email != $validated_data['email'])
        {
            $user->validated_at = null;
            $user->sendEmailNotificationVerification();
        }
        $user->email = $validated_data['email'];
        $user->NIF = $validated_data['NIF'];
        $user->telefone = $validated_data['telefone'];
        if ($request->hasFile('foto')) {
            Storage::delete('public/fotos/' . $user->foto);
            $path = $request->foto->store('public/fotos');
            $user->foto = basename($path);
        }
        $user->save();
        return redirect()->route('user.edit')
            ->with('alert-msg', 'Dados de conta alterados com sucesso!')
            ->with('alert-type', 'success');
    }

    public function fotoRemove()
    {
        $user = User::find(auth()->user()->id);
        Storage::delete('public/fotos/' . $user->foto);
        $user->foto = '';
        $user->save();
        return redirect()->route('user.edit')
            ->with('alert-msg', 'Imagem removida com sucesso!')
            ->with('alert-type', 'success');
    }

    public function delete()
    {
        $user = auth()->user();
        foreach($user->contas()->withTrashed()->get() as $conta)
        {
            $conta->movimentos()->withTrashed()->forceDelete();
            $conta->forceDelete();
        }
        $user->delete();
        return redirect()->route('home')
            ->with('alert-msg', 'User removido com sucesso!')
            ->with('alert-type', 'success');
    }

    public function passwordEdit()
    {
        return view('user.password_edit');
    }

    public function passwordUpdate(PasswordPost $request)
    {
        $data = $request->validated();
        $user = User::find(auth()->user()->id);
        if(Hash::check($data['oldPassword'], $user->password))
        {
            $user->password = Hash::make($data['password']);
            $user->save();
            return redirect()
            ->route('home')
            ->with('alert-msg', 'Password alterada com sucesso!')
            ->with('alert-type', 'success');
        }
        else
        {
            return redirect()->route('user.pass.edit')
            ->withErrors(['oldPassword' => 'Password atual não corresponde!']);
        }


    }
}
