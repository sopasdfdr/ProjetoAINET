@extends('layout_admin')
@section('title', 'Mudar Password do Perfil')

@section('content')

<form action="{{route('user.pass.update')}}" method="post" class="form-group">
    @method('patch')
    @csrf
    <div class="form-group">
        <label for="inputOldPassword">Password Atual</label>
        <input type="password" class="form-control" name="oldPassword" id="inputOldPassword" required/>
    </div>
    @error('oldPassword')
    <span class="text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
    <div class="form-group">
        <label for="inputPassword">Password Nova</label>
        <input type="password" class="form-control" name="password" id="inputPassword" required/>
    </div>
    @error('password')
    <span class="text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
    <div class="form-group">
        <label for="inputPasswordConfirmation">Confirmar Password Nova</label>
        <input type="password" class="form-control" name="password_confirmation" id="inputPasswordConfirmation" required/>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-success" name="ok">Save</button>
        <a class="btn btn-secondary" href="{{route('user.edit')}}">Cancel</a>
    </div>
</form>

@endsection
