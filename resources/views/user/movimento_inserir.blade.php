@extends('layout_admin')
@section('title', 'Inserir Movimento')

@section('content')

<form action={{route('movement.store', ['conta' => $conta])}} method="POST" enctype="multipart/form-data">
    @method('POST')
    @include('user.partials.movimento_dados',['dataMov' => $movimento->data, 'descricaoMov' => $movimento->descricao, 'tipoMov' => $movimento->tipo,
        'categoriaMov' => $movimento->categoriaMov, 'valorMov' => $movimento->valor])
    <div class="form-group col-2">
        <div class="custom-file">
        <input name="imagem_doc" type="file" class="custom-file-input" accept="image/*" value="{{$movimento->imagem_doc}}">
        <label class="custom-file-label">Escolha uma imagem</label>
        </div>
        @error('valor')
        <div class="text-danger">{{$message}}</div>
        @enderror
    </div>
    <a class="btn btn-secondary mt-4" href="{{route('conta.dados', ['conta' => $conta]) }}">Cancelar</a>
    <button type="submit" class="btn btn-primary mr-2 mt-4" id="btn-accept">Guardar</button>
</form>

@endsection
