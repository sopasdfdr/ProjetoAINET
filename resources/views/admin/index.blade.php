@extends('layout_admin');
@section('title', 'Utilizadores');

@section('content')

<table class="table table-striped">
    <thead class="thead-dark">
        <tr>
            <th scope="col" >Foto</th>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">Admin</th>
            <th scope="col">Bloqueado</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{$user->foto}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->adm ? 'Sim' : ''}}</td>
                <td>{{$user->bloqueado ? 'Sim' : ''}}</td>
            </tr>
        @endforeach
    </tbody>
</table>



<p style="text-align: center">
    <button type="button" class="btn btn-primary">Primeiro</button>
    <button type="button" class="btn btn-primary">Anterior</button>
    <input type="text" size="4">
    <button type="button" class="btn btn-primary">Próxima</button>
    <button type="button" class="btn btn-primary">Última</button>
</p>





@endsection
