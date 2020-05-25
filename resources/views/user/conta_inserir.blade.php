@extends('layout_admin')
@section('title', 'Criar nova Conta')

@section('content')

<form action={{route('conta.store')}} method="POST">
    @method('POST')
    @include('user.partials.conta_dados',['contaNome' => $conta->nome, 'contaDescricao' => $conta->descricao, 'contaSaldoAtual' => $conta->saldo_atual])
    <a class="btn btn-secondary float-right mb-2" href="{{route('contas')}}">Cancelar</a>
    <button type="submit" class="btn btn-primary float-right mr-2 mb-2" id="btn-accept">Guardar</button>
</form>

@endsection
