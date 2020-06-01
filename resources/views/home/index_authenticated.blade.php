@extends('layout_admin')
@section('title', 'Home Page - Finanças Pessoais')

@section('content')

<h5>Bem Vindo(a): {{auth()->user()->name}}!</h5>

<br>
<p>Contas Pessoais: {{$contas}}</p>
<p>Movimentos Pessoais realizados: {{$movimentos}}</p>



@endsection
