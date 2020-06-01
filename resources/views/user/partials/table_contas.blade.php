<table class="table table-striped">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Nome</th>
            <th scope="col" style="text-align:left">Descrição</th>
            <th scope="col" style="text-align:right">Saldo Atual</th>
            <th scope="col" style="text-align:right">Ultimo movimento</th>
            <th scope="col" style="text-align:right">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($contas as $conta)
            <tr>
                <td>{{$conta->nome}}</td>
                <td style="text-align:left">{{$conta->descricao}}</td>
                <td style="text-align:right">{{$conta->saldo_atual}} €</td>
                <td style="text-align:right">{{$conta->data_ultimo_movimento}}</td>
                <td style="text-align:right">
                    @if ($conta->deleted_at == NULL)
                        <a class="btn btn-info" href="{{route('conta.dados', ['conta' => $conta]) }}">
                            <svg class="bi bi-clipboard-data" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4 1.5H3a2 2 0 00-2 2V14a2 2 0 002 2h10a2 2 0 002-2V3.5a2 2 0 00-2-2h-1v1h1a1 1 0 011 1V14a1 1 0 01-1 1H3a1 1 0 01-1-1V3.5a1 1 0 011-1h1v-1z" clip-rule="evenodd"/>
                                <path fill-rule="evenodd" d="M9.5 1h-3a.5.5 0 00-.5.5v1a.5.5 0 00.5.5h3a.5.5 0 00.5-.5v-1a.5.5 0 00-.5-.5zm-3-1A1.5 1.5 0 005 1.5v1A1.5 1.5 0 006.5 4h3A1.5 1.5 0 0011 2.5v-1A1.5 1.5 0 009.5 0h-3z" clip-rule="evenodd"/>
                                <path d="M4 11a1 1 0 112 0v1a1 1 0 11-2 0v-1zm6-4a1 1 0 112 0v5a1 1 0 11-2 0V7zM7 9a1 1 0 012 0v3a1 1 0 11-2 0V9z"/>
                            </svg>
                        </a>

                        <form action="{{route('conta.delete', ['conta' => $conta])}}" method="POST" role="form">
                            @csrf
                            @method('delete')
                            <button type="button" title="Apagar Conta" class="btn btn-danger" data-toggle="modal" data-target="#modalContaRemove{{$conta->id}}">
                                <svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.5 5.5A.5.5 0 016 6v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm2.5 0a.5.5 0 01.5.5v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm3 .5a.5.5 0 00-1 0v6a.5.5 0 001 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 01-1 1H13v9a2 2 0 01-2 2H5a2 2 0 01-2-2V4h-.5a1 1 0 01-1-1V2a1 1 0 011-1H6a1 1 0 011-1h2a1 1 0 011 1h3.5a1 1 0 011 1v1zM4.118 4L4 4.059V13a1 1 0 001 1h6a1 1 0 001-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                            @include('partials.modal-messages', ['paramId' => 'modalContaRemove'.$conta->id, 'title' => 'Remover Conta', 'text' => 'Tem a certeza que quer eliminar a conta: "'. $conta->nome .'" ?'])
                        </form>
                    @else
                        <a class="btn btn-success" href="{{route('conta.restore', ['id' => $conta->id]) }}">
                            <svg class="bi bi-bootstrap-reboot" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M1.161 8a6.84 6.84 0 1 0 6.842-6.84.58.58 0 0 1 0-1.16 8 8 0 1 1-6.556 3.412l-.663-.577a.58.58 0 0 1 .227-.997l2.52-.69a.58.58 0 0 1 .728.633l-.332 2.592a.58.58 0 0 1-.956.364l-.643-.56A6.812 6.812 0 0 0 1.16 8zm5.48-.079V5.277h1.57c.881 0 1.416.499 1.416 1.32 0 .84-.504 1.324-1.386 1.324h-1.6zm0 3.75V8.843h1.57l1.498 2.828h1.314L9.377 8.665c.897-.3 1.427-1.106 1.427-2.1 0-1.37-.943-2.246-2.456-2.246H5.5v7.352h1.141z"/>
                            </svg>
                        </a>
                        <form action="{{route('conta.permadel', ['id' => $conta->id])}}" method="POST" role="form">
                            @csrf
                            @method('delete')
                            <button type="button" title="Destruir Conta" class="btn btn-danger" data-toggle="modal" data-target="#modalContaDestroy{{$conta->id}}">
                                <svg class="bi bi-exclamation-octagon" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1L1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                                    <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                                </svg>
                            </button>
                            @include('partials.modal-messages', ['paramId' => 'modalContaDestroy'.$conta->id, 'title' => 'Apagar Conta', 'text' => 'Tem a certeza que quer eliminar PERMANENTEMENTE a conta: "'. $conta->nome .'" ?'])
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $contas->withQueryString()->links() }}
