@extends('layout_admin')
@section('title', 'Dados Utilizador')

@section('content')

<form method="POST" action="{{route('user.update')}}">
    @method('PUT')
    <input type="hidden" name="id" value={{$user->id}}>
    @include('user.partials.user_dados_partial',['userNome' => $user->name, 'userEmail' => $user->email,
    'userNif' => $user->NIF, 'userTelefone' => $user->telefone, 'userFoto' => $user->foto])
    <button type="submit" class="btn btn-primary ml-3 mr-2 mb-2" id="btn-accept">Guardar</button>
    <a class="btn btn-secondary mb-2" href="{{route('user.edit')}}">Cancelar</a>
</form>

@endsection
