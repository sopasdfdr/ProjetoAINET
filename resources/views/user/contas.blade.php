@extends('layout_admin')
@section('title', 'Contas')

@section('content')

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
                <td style="text-align:right">{{$conta->saldo_atual}}</td>
                <td style="text-align:right">{{$conta->data_ultimo_movimento}}</td>
                <td style="text-align:right">
                    <a class="btn btn-info" href="{{route('conta.dados', ['conta' => $conta]) }}">
                        <svg class="bi bi-clipboard-data" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4 1.5H3a2 2 0 00-2 2V14a2 2 0 002 2h10a2 2 0 002-2V3.5a2 2 0 00-2-2h-1v1h1a1 1 0 011 1V14a1 1 0 01-1 1H3a1 1 0 01-1-1V3.5a1 1 0 011-1h1v-1z" clip-rule="evenodd"/>
                            <path fill-rule="evenodd" d="M9.5 1h-3a.5.5 0 00-.5.5v1a.5.5 0 00.5.5h3a.5.5 0 00.5-.5v-1a.5.5 0 00-.5-.5zm-3-1A1.5 1.5 0 005 1.5v1A1.5 1.5 0 006.5 4h3A1.5 1.5 0 0011 2.5v-1A1.5 1.5 0 009.5 0h-3z" clip-rule="evenodd"/>
                            <path d="M4 11a1 1 0 112 0v1a1 1 0 11-2 0v-1zm6-4a1 1 0 112 0v5a1 1 0 11-2 0V7zM7 9a1 1 0 012 0v3a1 1 0 11-2 0V9z"/>
                        </svg>
                    </a>

                    <button type="button" title="Apagar Conta" class="btn btn-danger">
                        <svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.5 5.5A.5.5 0 016 6v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm2.5 0a.5.5 0 01.5.5v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm3 .5a.5.5 0 00-1 0v6a.5.5 0 001 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 01-1 1H13v9a2 2 0 01-2 2H5a2 2 0 01-2-2V4h-.5a1 1 0 01-1-1V2a1 1 0 011-1H6a1 1 0 011-1h2a1 1 0 011 1h3.5a1 1 0 011 1v1zM4.118 4L4 4.059V13a1 1 0 001 1h6a1 1 0 001-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $contas->withQueryString()->links() }}

@endsection
