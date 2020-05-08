@extends('layout_admin');
@section('title', 'Utilizadores');

@section('content')

<form class="user-search" action="#" method="GET">
    <div class="form-row align-items-center">
        <div class="col-3">
            <label for="userSearch">Nome:</label>
        </div>
        <div class="col-4">
            <label for="inlineFormInputGroup">Email:</label>
        </div>
    </div>
    <div class="form-row align-items-center">
        <div class="col-3">
            <input type="text" class="form-control" id="userSearch" name="nome" placeholder="Nome a filtrar">
        </div>
        <div class="col-4">
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">@</div>
              </div>
              <input type="email" class="form-control" id="mailSearch" name="email" placeholder="Email a filtrar">
            </div>
        </div>
        <div class="form-check form-check-inline">
            <input type="checkbox" class="form-check-input" id="searchAdmin" name="adm" value="1" {{$adm ?? '' == 1 ? 'checked' : ''}}>
            <label class="form-check-label" for="searchAdmin">Admin</label>
        </div>
        <div class="form-check form-check-inline">
            <input type="checkbox" class="form-check-input" id="searchBloqueado" name="blq" value="1" {{$blq ?? '' == 1 ? 'checked' : ''}}>
            <label class="form-check-label" for="searchBloqueado">Bloqueado</label>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary" id="btn-filter">Filtrar</button>
        </div>
    </div>
</form>

@include('admin.partials.users_table', ['users' => $users])

@endsection
