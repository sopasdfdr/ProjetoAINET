@extends('layout_admin')
@section('title', 'Dados Utilizador')

@section('content')

<form method="POST" action="{{route('user.update')}}" enctype="multipart/form-data">
    @method('PUT')
    <input type="hidden" name="id" value={{$user->id}}>
    @include('user.partials.user_dados_partial',['userNome' => $user->name, 'userEmail' => $user->email,
    'userNif' => $user->NIF, 'userTelefone' => $user->telefone])

    @if($user->foto != null)
        <div>
            <img src='/storage/fotos/{{$user->foto}}' style="max-width: 200px" alt="Imagem do User">
            <button class="btn btn-secondary mt-4 mb-2" form="removeFotoForm">Remover Foto</button>
        </div>
    @endif

    <button type="submit" class="btn btn-primary mt-4 ml-3 mr-2 mb-2" id="btn-accept">Guardar</button>
    <a class="btn btn-secondary mt-4 mb-2" href="{{route('user.edit')}}">Cancelar</a>
    <a class="btn btn-info mt-4 mb-2 ml-4" href="{{route('user.pass.edit')}}">Mudar Password</a>
    <div style="text-align: center">
        <button class="btn btn-danger mt-4 mb-2 center" style="justify-content: center" form="eliminarPerfil">Eliminar Perfil</button>
    </div>
</form>

<form method="POST" action="{{route('user.foto.remove')}}" id="removeFotoForm">
    @csrf
    @method('PUT')
</form>
<form method="POST" action="{{route('user.delete')}}" id="eliminarPerfil">
    @csrf
    @method('delete')
</form>

@endsection
