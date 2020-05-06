@extends('layout_admin');
@section('title', 'Utilizadores');

@section('content')

<table class="table table-striped">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Foto</th>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">Admin</th>
            <th scope="col">Bloqueado</th>
            <th scope="col">Ações</th>

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
                <td>
                    @if (!$user->bloqueado)
                        <button type="button" class="btn btn-danger"><svg class="bi bi-lock" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M11.5 8h-7a1 1 0 00-1 1v5a1 1 0 001 1h7a1 1 0 001-1V9a1 1 0 00-1-1zm-7-1a2 2 0 00-2 2v5a2 2 0 002 2h7a2 2 0 002-2V9a2 2 0 00-2-2h-7zm0-3a3.5 3.5 0 117 0v3h-1V4a2.5 2.5 0 00-5 0v3h-1V4z" clip-rule="evenodd"/>
                        </svg></button>
                    @else
                        <button type="button" class="btn btn-primary"><svg class="bi bi-unlock" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M9.655 8H2.333c-.264 0-.398.068-.471.121a.73.73 0 00-.224.296 1.626 1.626 0 00-.138.59V14c0 .342.076.531.14.635.064.106.151.18.256.237a1.122 1.122 0 00.436.127l.013.001h7.322c.264 0 .398-.068.471-.121a.73.73 0 00.224-.296 1.627 1.627 0 00.138-.59V9c0-.342-.076-.531-.14-.635a.658.658 0 00-.255-.237A1.122 1.122 0 009.655 8zm.012-1H2.333C.5 7 .5 9 .5 9v5c0 2 1.833 2 1.833 2h7.334c1.833 0 1.833-2 1.833-2V9c0-2-1.833-2-1.833-2zM8.5 4a3.5 3.5 0 117 0v3h-1V4a2.5 2.5 0 00-5 0v3h-1V4z" clip-rule="evenodd"/>
                        </svg></button>
                    @endif


                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@if ($users->lastPage() > 1)
    <div class="text-center">
        <a class="btn btn-primary <?php if($users->currentPage() == 1) echo 'disabled'  ?>"  href="{{ $users->url(1) }}">Primeira</a>
        <a class="btn btn-primary <?php if($users->currentPage() == 1) echo 'disabled'  ?>"  href="{{ $users->url($users->currentPage()-1) }}" >Anterior</a>

        <span> {{$users->currentPage()}}</span>

        <a class="btn btn-primary <?php if($users->currentPage() == $users->lastPage()) echo 'disabled'  ?>" href="{{ $users->url($users->currentPage()+1) }}" >Próxima</a>
        <a class="btn btn-primary <?php if($users->currentPage() == $users->lastPage()) echo 'disabled'  ?>" href="{{ $users->url($users->lastPage()) }}" >Última</a>
    </div>
@endif



@endsection
