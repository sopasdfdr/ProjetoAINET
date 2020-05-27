@extends('layout_admin')
@section('title', 'Dados Conta')

@section('content')
<form action={{route('conta.update', ['conta' => $conta])}} method="POST">
    @method('PUT')
    <input type="hidden" name="id" value={{$conta->id}}>
    @include('user.partials.conta_dados',['contaNome' => old('nome',$conta->nome), 'contaDescricao' => old('descricao',$conta->descricao), 'contaSaldoAtual' => old('saldo_atual',$conta->saldo_atual)])
    <a class="btn btn-secondary" href="{{route('conta.dados', ['conta' => $conta]) }}">Cancelar</a>
    <button type="submit" class="btn btn-primary mr-2" id="btn-accept">Guardar</button>
</form>


<!-- filtragem -->
<form class="user-search mt-4" action="#" method="GET">
    <div class="row align-items-center">
        <label for="dataSearch" class="ml-4">Data:</label>
        <div class="col-auto">
            <input name="data" id="dataSearch" type="date" max=<?php echo date('Y-m-d');?> class="form-control" placeholder="Data do Movimento" value={{$data}}>
        </div>
        <label class="mr-3 ml-2">Tipo:</label>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="searchTipo" name="tipo" class="custom-control-input" value='D' {{$tipo == 'D' ? 'checked' : ''}}>
                <label class="custom-control-label" for="searchTipo">Despesa</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="searchTipo1" name="tipo" class="custom-control-input" value='R' {{$tipo == 'R' ? 'checked' : ''}}>
                <label class="custom-control-label" for="searchTipo1">Receita</label>
            </div>
        <div class="col-auto">
            <select name="categoria" class="form-control" id="sel1">
                @if ($tipo=='R')
                    @for ($i = 13; $i < 44; $i++)
                        <option value={{$i}}>{{$i}}</option>
                    @endfor
                @else
                @if($tipo=='D')
                    @for ($i = 1; $i < 13; $i++)
                        <option value={{$i}}>{{$i}}</option>
                    @endfor
                @endif
                @endif
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary" id="btn-filter">Filtrar</button>
        </div>
        <div class="col-auto">
            <a class="btn btn-primary" href="#">Clean</a>
        </div>
    </div>
</form>


<a type="button" class="btn btn-primary float-right mb-3 ml-2" style="color: white"  data-toggle="modal" data-target='#id_modalAtribuirConta'>Atribuir conta</a>
@include('partials.modal-atribuirConta')
<a type="button" class="btn btn-success float-right mb-2" href="{{route('movement.create',$conta)}}">Registar Movimento</a>
@error('email')
    <div class="text-danger">{{$message}}</div>
@enderror
<table class="table table-striped">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Data</th>
            <th scope="col" style="text-align:left">Valor</th>
            <th scope="col" style="text-align:right">Saldo Inicial</th>
            <th scope="col" style="text-align:right">Saldo Final</th>
            <th scope="col" style="text-align:right">Categoria</th>
            <th scope="col" style="text-align:right">Tipo</th>
            <th scope="col" style="text-align:right">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($movimentos as $movimento)
            <tr>
                <td>{{$movimento->data}}</td>
                <td style="text-align:left">{{$movimento->valor}}</td>
                <td style="text-align:right">{{$movimento->saldo_inicial}} €</td>
                <td style="text-align:right">{{$movimento->saldo_final}} €</td>
                <td style="text-align:right">{{$movimento->categoria_id ? $movimento->categoria->nome : ''}}</td>
                <td style="text-align:right">{{$movimento->tipo}}</td>
                <td style="text-align:right">
                <a class="btn btn-info" href="{{route('movement.edit', ['movimento' => $movimento])}}">
                        <svg class="bi bi-clipboard-data" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4 1.5H3a2 2 0 00-2 2V14a2 2 0 002 2h10a2 2 0 002-2V3.5a2 2 0 00-2-2h-1v1h1a1 1 0 011 1V14a1 1 0 01-1 1H3a1 1 0 01-1-1V3.5a1 1 0 011-1h1v-1z" clip-rule="evenodd"/>
                            <path fill-rule="evenodd" d="M9.5 1h-3a.5.5 0 00-.5.5v1a.5.5 0 00.5.5h3a.5.5 0 00.5-.5v-1a.5.5 0 00-.5-.5zm-3-1A1.5 1.5 0 005 1.5v1A1.5 1.5 0 006.5 4h3A1.5 1.5 0 0011 2.5v-1A1.5 1.5 0 009.5 0h-3z" clip-rule="evenodd"/>
                            <path d="M4 11a1 1 0 112 0v1a1 1 0 11-2 0v-1zm6-4a1 1 0 112 0v5a1 1 0 11-2 0V7zM7 9a1 1 0 012 0v3a1 1 0 11-2 0V9z"/>
                        </svg>
                    </a>

                    <form action="{{route('movement.delete', ['movimento' => $movimento])}}" method="POST" role="form" class="inline">
                        @csrf
                        @method('delete')
                        <button type="button" title="Apagar Movimento" class="btn btn-danger" data-toggle="modal" data-target="#modalMovimentoRemove{{$movimento->id}}">
                            <svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.5 5.5A.5.5 0 016 6v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm2.5 0a.5.5 0 01.5.5v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm3 .5a.5.5 0 00-1 0v6a.5.5 0 001 0V6z"/>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 01-1 1H13v9a2 2 0 01-2 2H5a2 2 0 01-2-2V4h-.5a1 1 0 01-1-1V2a1 1 0 011-1H6a1 1 0 011-1h2a1 1 0 011 1h3.5a1 1 0 011 1v1zM4.118 4L4 4.059V13a1 1 0 001 1h6a1 1 0 001-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                        @include('partials.modal-messages', ['paramId' => 'modalMovimentoRemove'.$movimento->id, 'title' => 'Remover Movimento', 'text' => 'Tem a certeza que quer eliminar este movimento?'])
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $movimentos->withQueryString()->links() }}

@endsection
