@extends('layout_admin');
@section('title', 'Utilizadores');

@section('content')

<form class="user-search" action="#" method="GET">
    <div class="row align-items-center">
        <div class="col-3">
            <label for="userSearch">Nome:</label>
        </div>
        <div class="col-4">
            <label for="mailSearch">Email:</label>
        </div>
        <div class="col-2">
            <label for="searchAdmin">Tipo:</label>
        </div>
        <div class="col-2">
            <label for="searchBlq">Bloqueado:</label>
        </div>
    </div>
    <div class="row align-items-center">
        <div class="col-3">
            <input type="text" class="form-control" id="userSearch" name="nome" placeholder="Nome a filtrar" value={{$nome}}>
        </div>
        <div class="col-4">
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">@</div>
              </div>
            <input type="text" class="form-control" id="mailSearch" name="email" placeholder="Email a filtrar" value={{$email}}>
            </div>
        </div>

       <!-- <select class="form-control col-1" id="searchAdmin" name="adm">
            <option value=NULL $adm ?? '' == NULL ? 'selected' : '' >Todos</option>
            <option value=0 $adm ?? '' == 0 ? 'selected' : '' >Normal</option>
            <option value=1 $adm ?? '' == 1 ? 'selected' : '' >Admin</option>
        </select>-->

        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="searchAdmin" name="adm" class="custom-control-input" value=3 {{$adm == 3 ? 'checked' : ''}}>
            <label class="custom-control-label" for="searchAdmin">Todos</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="searchAdmin1" name="adm" class="custom-control-input" value=1 {{$adm == 1 ? 'checked' : ''}}>
            <label class="custom-control-label" for="searchAdmin1">Admin</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="searchAdmin2" name="adm" class="custom-control-input" value=0 {{$adm == 0 ? 'checked' : ''}}>
            <label class="custom-control-label" for="searchAdmin2">Normal</label>
        </div>

        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="searchBlq" name="blq" class="custom-control-input" value=3 {{$blq == 3 ? 'checked' : ''}}>
            <label class="custom-control-label" for="searchBlq">Todos</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="searchBlq1" name="blq" class="custom-control-input" value=1 {{$blq == 1 ? 'checked' : ''}}>
            <label class="custom-control-label" for="searchBlq1">Sim</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="searchBlq2" name="blq" class="custom-control-input" value=0 {{$blq == 0 ? 'checked' : ''}}>
            <label class="custom-control-label" for="searchBlq2">Não</label>
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-primary" id="btn-filter">Filtrar</button>
        </div>
        <div class="col-auto">
            <a class="btn btn-primary" href="/admin">Clean</a>
        </div>
    </div>
</form>

@include('admin.partials.users_table', ['users' => $users])

@endsection
