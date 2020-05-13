@extends('layout_admin')
@section('title', 'Home Page - Finanças Pessoais')

@section('content')

<h5>Informações</h5>

<h5>Esta aplicação tem como funcionalidade manter os recordes das Finanças Pessoais </h5>

<p>{{$users}} Utilizadores existentes</p>
<p>{{$contas}} Contas Existentes</p>
<p>{{$movimentos}} Movimentos realizados</p>



@endsection
