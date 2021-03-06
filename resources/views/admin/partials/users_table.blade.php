<table class="table table-striped mt-3">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Foto</th>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            @can('view_update_adm', 'App\User')
            <th scope="col">Admin</th>
            <th scope="col">Bloqueado</th>
            <th scope="col">Ações</th>
            @endcan
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr class="{{$user->adm ? 'table-info' : '' }}">
            <td><img src="{{$user->foto ? asset('storage/fotos/' . $user->foto) : asset('img/default_img.png') }}" alt="Foto User" width="50px" height="50px"></td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                @can('view_update_adm', 'App\User')
                <td>{{$user->adm ? 'Sim' : ''}}</td>
                <td>{{$user->bloqueado ? 'Sim' : ''}}</td>
                <td>
                    @if (!$user->bloqueado && $user->id != auth()->user()->id)
                        <form action="{{route('admin.blq', ['user' => $user]) }}" method="POST" class="inline">
                            @csrf
                            @method('PUT')
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target='#modalBlq{{$user->id}}'>
                                <svg class="bi bi-lock" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M11.5 8h-7a1 1 0 00-1 1v5a1 1 0 001 1h7a1 1 0 001-1V9a1 1 0 00-1-1zm-7-1a2 2 0 00-2 2v5a2 2 0 002 2h7a2 2 0 002-2V9a2 2 0 00-2-2h-7zm0-3a3.5 3.5 0 117 0v3h-1V4a2.5 2.5 0 00-5 0v3h-1V4z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                            @include('partials.modal-messages', ['paramId' => 'modalBlq'.$user->id, 'title' => 'Bloquear Utilizador', 'text' => 'Tem a certeza que pretende bloquear o utilizador "'. $user->name .'" ?'])
                        </form>
                    @elseif ($user->bloqueado && $user->id != auth()->user()->id)
                        <form action="{{route('admin.unblq', ['user' => $user]) }}" method="POST" class="inline">
                            @csrf
                            @method('PUT')
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalUnlq{{$user->id}}">
                                <svg class="bi bi-unlock" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M9.655 8H2.333c-.264 0-.398.068-.471.121a.73.73 0 00-.224.296 1.626 1.626 0 00-.138.59V14c0 .342.076.531.14.635.064.106.151.18.256.237a1.122 1.122 0 00.436.127l.013.001h7.322c.264 0 .398-.068.471-.121a.73.73 0 00.224-.296 1.627 1.627 0 00.138-.59V9c0-.342-.076-.531-.14-.635a.658.658 0 00-.255-.237A1.122 1.122 0 009.655 8zm.012-1H2.333C.5 7 .5 9 .5 9v5c0 2 1.833 2 1.833 2h7.334c1.833 0 1.833-2 1.833-2V9c0-2-1.833-2-1.833-2zM8.5 4a3.5 3.5 0 117 0v3h-1V4a2.5 2.5 0 00-5 0v3h-1V4z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                            @include('partials.modal-messages', ['paramId' => 'modalUnlq'.$user->id, 'title' => 'Desbloquear Utilizador', 'text' => 'Quer desbloquear o utilizador "'. $user->name .'" ?'])
                        </form>
                    @endif

                    @if (!$user->adm && $user->id != auth()->user()->id)
                        <form action="{{route('admin.promote', ['user' => $user]) }}" method="POST" class="inline">
                            @csrf
                            @method('PUT')
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalAdm{{$user->id}}">
                                <svg class="bi bi-person-check" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M11 14s1 0 1-1-1-4-6-4-6 3-6 4 1 1 1 1h10zm-9.995-.944v-.002.002zM1.022 13h9.956a.274.274 0 00.014-.002l.008-.002c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664a1.05 1.05 0 00.022.004zm9.974.056v-.002.002zM6 7a2 2 0 100-4 2 2 0 000 4zm3-2a3 3 0 11-6 0 3 3 0 016 0zm6.854.146a.5.5 0 010 .708l-3 3a.5.5 0 01-.708 0l-1.5-1.5a.5.5 0 01.708-.708L12.5 7.793l2.646-2.647a.5.5 0 01.708 0z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                            @include('partials.modal-messages', ['paramId' => 'modalAdm'.$user->id, 'title' => 'Privilégios Admin', 'text' => 'Dar privilégios de admin a "'. $user->name .'" ?'])
                        </form>
                    @elseif ($user->adm && $user->id != auth()->user()->id)
                        <form action="{{route('admin.demote', ['user' => $user]) }}" method="POST" class="inline">
                            @csrf
                            @method('PUT')
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalRemove{{$user->id}}">
                                <svg class="bi bi-person-dash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M11 14s1 0 1-1-1-4-6-4-6 3-6 4 1 1 1 1h10zm-9.995-.944v-.002.002zM1.022 13h9.956a.274.274 0 00.014-.002l.008-.002c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664a1.05 1.05 0 00.022.004zm9.974.056v-.002.002zM6 7a2 2 0 100-4 2 2 0 000 4zm3-2a3 3 0 11-6 0 3 3 0 016 0zm2 2.5a.5.5 0 01.5-.5h4a.5.5 0 010 1h-4a.5.5 0 01-.5-.5z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                            @include('partials.modal-messages', ['paramId' => 'modalRemove'.$user->id, 'title' => 'Privilégios Admin', 'text' => 'Revogar privilégios de admin a "'. $user->name .'" ?'])
                        </form>
                    @endif
                </td>
                @endcan
            </tr>

        @endforeach
    </tbody>
</table>

{{ $users->withQueryString()->links() }}
